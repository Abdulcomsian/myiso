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
        $record->save();

        session()->flash('msg', 'Record saved successfully.');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $record = $this->findOwned($request->input('id'));
        $record->fill($this->validated($request));
        $this->applyDefaults($record);
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
