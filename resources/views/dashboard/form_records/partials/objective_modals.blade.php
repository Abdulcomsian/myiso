{{-- The four things a row's buttons open: the details, the edit form, the
     progress note with its history, and the delete confirmation.

     Shared by the Objectives Tracker, the admin's copy of it and the dashboard
     card, so none of them can drift from the others.

     $ownerId      set by the admin, who is saving on somebody else's behalf;
                   it is what puts user_id on the three forms
     $evidenceId   the id of the progress-note file input, which has to be
                   unique per page

     The guards sit flush against the left margin on purpose: a Blade directive
     alone on a line emits nothing, but only when nothing precedes it. --}}
<div class="am-modal" id="viewObjModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:760px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Objective Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px 18px;">
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Objective</div><div id="vobj-objective">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">How it is measured</div><div id="vobj-measured">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Starting point</div><div id="vobj-start">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Target</div><div id="vobj-target">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">How will this be achieved</div><div id="vobj-achieved">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Person responsible</div><div id="vobj-person">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Deadline</div><div id="vobj-deadline">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Agreed at</div><div id="vobj-agreed">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Status</div><div id="vobj-status">—</div></div>
            </div>

            {{-- Status alone says where the objective stands, not how it got
                 there. The same timeline the progress popup shows, read-only. --}}
            <div style="border-top:1px solid var(--am-border);padding-top:14px;margin-top:18px;">
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:10px;">Progress history</div>
                <div id="vobj-history"></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editObjModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Objective</h4>
        </div>
        <form action="{{ route('objective.update') }}" method="POST" style="display:contents;">
            @csrf
@if (!empty($ownerId))
            <input type="hidden" name="user_id" value="{{ $ownerId }}">
@endif
            <input type="hidden" name="id" id="eobj-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-12"><label>Objective *</label><input type="text" class="form-control" name="objective" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4"><label>How it is measured *</label><input type="text" class="form-control" name="how_measured" required></div>
                    <div class="col-lg-4"><label>Starting point</label><input type="text" class="form-control" name="starting_point"></div>
                    <div class="col-lg-4"><label>Target *</label><input type="text" class="form-control" name="target" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>How will this be achieved</label><textarea class="form-control" name="how_achieved" rows="3"></textarea></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>Person responsible *</label>
                        <select class="form-control" name="person_responsible" required>
                            <option value="">Choose employee…</option>
                            @foreach ($employees as $emp)
                                <option value="{{ trim($emp->first_name . ' ' . $emp->surname) }}">{{ trim($emp->first_name . ' ' . $emp->surname) ?: $emp->empNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        @include('dashboard.form_records.partials.objective_agreed_field', ['uid' => 'edit', 'cls' => 'form-control'])
                    </div>
                    <div class="col-lg-3"><label>Deadline *</label><input type="date" max="2999-12-31" class="form-control" name="deadline" required></div>
                    <div class="col-lg-3">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            @foreach (App\Objective::statuses() as $key => $st)
                                <option value="{{ $key }}">{{ $st['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Update</button>
            </div>
        </form>
    </div>
</div>

{{-- Update progress --}}
<div class="am-modal" id="progressObjModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:860px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-chart-line"></i></span>
            <div>
                <h4 class="am-modal__title">Update Progress</h4>
                <div id="pobj-title" style="font-size:12.5px;color:var(--am-text-muted);"></div>
            </div>
        </div>
        <form action="{{ route('objective.progress') }}" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf
@if (!empty($ownerId))
            <input type="hidden" name="user_id" value="{{ $ownerId }}">
@endif
            <input type="hidden" name="objective_id" id="pobj-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-6"><label>Progress note *</label><input type="text" class="form-control" name="note" placeholder="Down 9% compared with the same period last year" required></div>
                    <div class="col-lg-3">
                        <label>Status *</label>
                        <select class="form-control" name="status" id="pobj-status" required>
                            @foreach (App\Objective::statuses() as $key => $st)
                                <option value="{{ $key }}">{{ $st['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3"><label>Date</label><input type="date" max="{{ date('Y-m-d') }}" class="form-control" name="update_date" id="pobj-date"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Evidence <span style="color:var(--am-text-soft);">PDF, JPEG, TXT, DOCX or PNG — a waste invoice, energy bill, complaints log or accident report</span></label>
                        <input type="file" class="form-control" name="evidence" accept=".pdf,.jpg,.jpeg,.txt,.doc,.docx,.png">
                    </div>
                </div>

                <div style="border-top:1px solid var(--am-border);padding-top:14px;margin-top:6px;">
                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:10px;">Progress history</div>
                    <div id="pobj-history"></div>
                </div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Save Update</button>
            </div>
        </form>
    </div>
</div>

{{-- Delete --}}
<div class="am-modal" id="amObjConfirmDelete" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:460px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:rgba(235,77,75,0.12);color:var(--am-danger);"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">Delete Objective</h4>
        </div>
        <div class="am-modal__body"><p style="margin:0;">This removes the objective and its whole progress history. This cannot be undone.</p></div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
            <form action="{{ route('objective.destroy') }}" method="POST" style="display:inline;">
                @csrf
@if (!empty($ownerId))
                <input type="hidden" name="user_id" value="{{ $ownerId }}">
@endif
                <input type="hidden" name="id" id="dobj-id">
                <button type="submit" class="am-btn am-btn-danger"><i class="fa fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
</div>
