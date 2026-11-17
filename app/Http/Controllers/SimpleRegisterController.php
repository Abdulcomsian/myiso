<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Shared list/add/edit/delete flow for simple per-user registers
 * (Environmental Impacts, Hazards, Incidents). Each subclass only
 * describes its model, fields and texts in module().
 *
 * Route names per module key: {key}, {key}.store, {key}.update, {key}.destroy, {key}.admin
 */
abstract class SimpleRegisterController extends Controller
{
    /** Paginate lists (EN pages use server-side search + pagination) */
    protected $paginate = true;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Eloquent model class */
    abstract protected function model();

    /** Module texts and field definitions */
    abstract protected function module();

    /**
     * The module as the page draws it: the register's own fields, with
     * the supporting-evidence field after them.
     *
     * The client's "Attach Supporting Evidence" document puts that field
     * on every form, these three included. It is added here rather than
     * written into each register so they stay in step, and so a register
     * added later gets it without being asked.
     *
     * Only the drawing goes through this. The validator, the defaults and
     * the search read module() as before: a file is not validated as text,
     * has no default, and the column holds a path rather than words.
     */
    protected function moduleForView()
    {
        $module = $this->module();
        $module['fields']['attach_evidence'] = [
            'label' => 'Attach Supporting Evidence',
            'type'  => 'file',
            'wide'  => true,
        ];
        return $module;
    }

    /**
     * The evidence the client attached, if any.
     *
     * Optional on every register: a record saved without one is normal,
     * and an edit sent with the box empty leaves whatever is already
     * there alone. When a new file does arrive the one it replaces is
     * deleted, so the uploads folder does not gain a copy on every edit.
     */
    protected function keepEvidence(Request $request, $record)
    {
        $file = $request->file('attach_evidence');
        if (!$file
            || !\Illuminate\Support\Facades\Schema::hasColumn($record->getTable(), 'attach_evidence')) {
            return;
        }
        // the old one goes, but only if there is one: public_path(null)
        // is the public folder itself, which exists
        if ($record->attach_evidence
            && \Illuminate\Support\Facades\File::exists(public_path($record->attach_evidence))) {
            \Illuminate\Support\Facades\File::delete(public_path($record->attach_evidence));
        }
        $record->attach_evidence = \App\Helpers\HelperFunctions::saveFile(
            '/uploads/user/attach_evidence/', $file);
    }

    public function index(Request $request)
    {
        return $this->listing($request, Auth::user()->id, false);
    }

    public function adminIndex(Request $request, $userid)
    {
        return $this->listing($request, (int) $userid, true);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $model = $this->model();
        $record = new $model();
        $record->fill($data);
        $this->applyDefaults($record);
        $record->user_id = Auth::user()->role_type == 'admin'
            ? intval($request->input('user_id'))
            : Auth::user()->id;
        $this->keepEvidence($request, $record);
        $record->save();

        session()->flash('msg', 'Record saved successfully.');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $record = $this->findOwned($request->input('id'));
        $record->fill($this->validated($request));
        $this->applyDefaults($record);
        $this->keepEvidence($request, $record);
        $record->save();

        session()->flash('msg', 'Record updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $this->findOwned($request->input('id'))->delete();

        session()->flash('msg', 'Record deleted successfully.');
        return redirect()->back();
    }

    protected function listing(Request $request, $ownerId, $isAdmin)
    {
        $module = $this->module();
        $model = $this->model();
        $search = trim($request->query('q', ''));

        $query = $model::where('user_id', $ownerId)->orderBy('id', 'DESC');
        if ($search !== '') {
            $query->where(function ($q) use ($search, $module) {
                foreach (array_keys($module['fields']) as $field) {
                    $q->orWhere($field, 'like', "%{$search}%");
                }
            });
        }
        $records = $this->paginate ? $query->paginate(10)->withQueryString() : $query->get();

        // the page also draws the evidence field; the search above does not
        // look in it, because that column holds a path and not words
        $module = $this->moduleForView();

        $data = compact('module', 'records', 'search', 'ownerId', 'isAdmin');
        if ($request->ajax()) {
            return view('dashboard.form_records.partials.register_table', $data);
        }
        return view($isAdmin ? 'admin.adminform_records.register' : 'dashboard.form_records.register', $data);
    }

    protected function validated(Request $request)
    {
        $rules = [];
        foreach ($this->module()['fields'] as $name => $field) {
            $rule = [empty($field['required']) ? 'nullable' : 'required'];
            switch ($field['type']) {
                case 'date':
                    $rule[] = 'date';
                    break;
                case 'select':
                    $rule[] = 'in:' . implode(',', array_keys($field['options']));
                    break;
                case 'textarea':
                    $rule[] = 'string';
                    $rule[] = 'max:5000';
                    break;
                default:
                    $rule[] = 'string';
                    $rule[] = 'max:255';
            }
            $rules[$name] = $rule;
        }
        return $request->validate($rules);
    }

    /** Optional fields left empty get their configured 'default' (e.g. incident status) */
    protected function applyDefaults($record)
    {
        foreach ($this->module()['fields'] as $name => $field) {
            if (array_key_exists('default', $field) && ($record->$name === null || $record->$name === '')) {
                $record->$name = $field['default'];
            }
        }
    }

    protected function findOwned($id)
    {
        $model = $this->model();
        $record = $model::findOrFail($id);
        if (Auth::user()->role_type != 'admin' && $record->user_id != Auth::user()->id) {
            abort(403);
        }
        return $record;
    }
}
