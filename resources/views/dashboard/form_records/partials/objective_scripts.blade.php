{{-- Everything the objectives list does in the browser: the modals, the
     search, the pager, the status chips and the four row actions.

     Shared by the Objectives Tracker, the admin's copy and the dashboard card.

     $listUrl      where the search and the pager fetch from
     $containerId  the element the fetched list is poured back into
     $syncUrl      false on the dashboard, where paging a card must not rewrite
                   the address bar of the page around it --}}
<script>
@php $containerId = $containerId ?? 'amObjContainer'; @endphp
// Closing a modal: the close button, the backdrop, or Escape - the same
// handler every other page on this site uses.
document.addEventListener('click', function(e) {
    var close = e.target.closest('.am-modal-close');
    if (close) { var m = close.closest('.am-modal'); if (m) m.classList.remove('open'); return; }
    if (e.target.classList && e.target.classList.contains('am-modal')) e.target.classList.remove('open');
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') document.querySelectorAll('.am-modal.open').forEach(function(m){ m.classList.remove('open'); });
});
var amObjStatuses = @json(App\Objective::statuses());
// the same wording the dropdown uses, so the popup cannot word it differently
var amObjReviews  = @json(collect($reviews ?? [])->mapWithKeys(function ($r) {
    return [$r->id => $r->reviewLabel()];
}));

document.addEventListener('DOMContentLoaded', function () {
    var form   = document.getElementById('newObjForm');
    var toggle = document.getElementById('toggleObjForm');
    var cancel = document.getElementById('cancelObjForm');
    toggle && toggle.addEventListener('click', function () { form.classList.toggle('open'); });
    cancel && cancel.addEventListener('click', function () { form.classList.remove('open'); });
});

// search and paging without a full page load, as the other lists do
(function () {
    var containerId = @json($containerId);
    var input     = document.getElementById('amObjSearch');
    var form      = document.getElementById('amObjSearchForm');
    var container = document.getElementById(containerId);
    if (!container) return;
    var baseUrl     = @json($listUrl ?? url('/objectives_tracker'));
    var syncUrl     = @json($syncUrl ?? true);
    var status  = '{{ $status ?? '' }}';

    function debounce(fn, wait) { var t; return function () { var c = this, a = arguments; clearTimeout(t); t = setTimeout(function () { fn.apply(c, a); }, wait); }; }
    function fetchPage(page) {
        var q = input ? input.value.trim() : '';
        var url = baseUrl + '?q=' + encodeURIComponent(q) + '&status=' + encodeURIComponent(status) + '&page=' + page;
        container.style.opacity = '0.5';
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (r) { return r.text(); })
            .then(function (html) { container.innerHTML = html; container.style.opacity = ''; if (syncUrl) window.history.replaceState({}, '', url); })
            .catch(function () { container.style.opacity = ''; });
    }
    form && form.addEventListener('submit', function (e) { e.preventDefault(); fetchPage(1); });
    input && input.addEventListener('input', debounce(function () { fetchPage(1); }, 300));
    container.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-page]');
        if (!btn) return;
        e.preventDefault();
        var p = parseInt(btn.getAttribute('data-page'), 10);
        if (!isNaN(p) && p > 0) fetchPage(p);
    });
    container.addEventListener('click', function (e) {
        var chip = e.target.closest('[data-status-filter]');
        if (!chip) return;
        e.preventDefault();
        status = chip.getAttribute('data-status-filter');
        fetchPage(1);
    });
})();

// "Agreed at" is either a Management Review or a date of its own; the date
// only appears once the meeting was not a review. Delegated, so it covers the
// add form and the edit popup whichever rendered first.
function amObjSyncAgreed(sel) {
    var box = sel.parentNode.querySelector('[data-obj-agreed-custom]');
    if (box) box.hidden = sel.value !== 'custom';
}
document.addEventListener('change', function (e) {
    var sel = e.target.closest('select[data-obj-agreed]');
    if (sel) amObjSyncAgreed(sel);
});
// The progress history, drawn the same way wherever it appears. The details
// popup used to end at Status, which says where an objective stands but not
// how it got there; it now carries the same timeline the progress popup does,
// and from this one function, so the two cannot drift apart.
function amObjHistory(box, history) {
    if (!box) return;
    box.innerHTML = '';
    if (!history || !history.length) {
        box.innerHTML = '<div style="font-size:13px;color:var(--am-text-muted);">No progress recorded yet.</div>';
        return;
    }
    history.forEach(function (h) {
        var st = amObjStatuses[h.status] || { chip: '', label: h.status };
        var row = document.createElement('div');
        row.style.cssText = 'display:grid;grid-template-columns:110px 120px minmax(0,1fr) minmax(0,150px);gap:12px;align-items:start;padding:10px 0;border-bottom:1px solid var(--am-border);font-size:13px;';
        row.innerHTML =
            '<div style="color:var(--am-text-muted);">' + (h.update_date ? new Date(h.update_date).toLocaleDateString() : '—') + '</div>' +
            '<div><span class="am-chip ' + st.chip + '">' + st.label + '</span></div>' +
            '<div style="min-width:0;overflow-wrap:anywhere;">' + (h.note ? String(h.note).replace(/[<>&]/g, function (c) { return { '<': '&lt;', '>': '&gt;', '&': '&amp;' }[c]; }) : '') + '</div>' +
            '<div style="min-width:0;overflow-wrap:anywhere;">' + (h.evidence
                ? '<a href="{{ asset('objective_evidence') }}/' + encodeURIComponent(h.evidence) + '" target="_blank">' + h.evidence + '</a>'
                : '—') + '</div>';
        box.appendChild(row);
    });
}

function amObjView(d, history) {
    document.getElementById('vobj-objective').textContent = d.objective || '—';
    document.getElementById('vobj-measured').textContent  = d.how_measured || '—';
    document.getElementById('vobj-start').textContent     = d.starting_point || '—';
    document.getElementById('vobj-target').textContent    = d.target || '—';
    document.getElementById('vobj-achieved').textContent  = d.how_achieved || '—';
    document.getElementById('vobj-person').textContent    = d.person_responsible || '—';
    document.getElementById('vobj-deadline').textContent  = d.deadline ? new Date(d.deadline).toLocaleDateString() : '—';
    var agreed = '—';
    if (d.agreed_at && amObjReviews[d.agreed_at]) agreed = amObjReviews[d.agreed_at];
    else if (d.agreed_on) agreed = new Date(d.agreed_on).toLocaleDateString();
    document.getElementById('vobj-agreed').textContent = agreed;
    var st = amObjStatuses[d.status];
    document.getElementById('vobj-status').innerHTML =
        '<span class="am-chip ' + (st ? st.chip : '') + '">' + (st ? st.label : (d.status || '—')) + '</span>';
    amObjHistory(document.getElementById('vobj-history'), history);
    document.getElementById('viewObjModal').classList.add('open');
}

function amObjEdit(d) {
    var m = document.getElementById('editObjModal');
    document.getElementById('eobj-id').value = d.id || '';
    ['objective', 'how_measured', 'starting_point', 'target', 'deadline'].forEach(function (k) {
        var el = m.querySelector("[name='" + k + "']");
        if (el) el.value = d[k] || '';
    });
    var ta = m.querySelector("[name='how_achieved']"); if (ta) ta.value = d.how_achieved || '';
    ['person_responsible', 'status'].forEach(function (k) {
        var el = m.querySelector("select[name='" + k + "']");
        if (el) el.value = d[k] || '';
    });
    // agreed_at empty with a date set means the date was typed by hand
    var sel = m.querySelector("select[name='agreed_at']");
    var dt  = m.querySelector("input[name='agreed_on']");
    if (sel) {
        if (!d.agreed_at && d.agreed_on) {
            sel.value = 'custom';
            if (dt) dt.value = d.agreed_on;
        } else {
            sel.value = d.agreed_at || '';
            if (dt) dt.value = '';
        }
        amObjSyncAgreed(sel);
    }
    m.classList.add('open');
}

// the history is rendered from the rows the server sent with the list
function amObjProgress(d, history) {
    document.getElementById('pobj-id').value = d.id || '';
    document.getElementById('pobj-title').textContent = d.objective || '';
    var sel = document.getElementById('pobj-status'); if (sel) sel.value = d.status || 'not_started';
    var dt = document.getElementById('pobj-date');
    if (dt && !dt.value) { dt.value = new Date().toISOString().slice(0, 10); }   // today, as a starting point

    amObjHistory(document.getElementById('pobj-history'), history);
    document.getElementById('progressObjModal').classList.add('open');
}

function amObjDelete(id) {
    document.getElementById('dobj-id').value = id;
    document.getElementById('amObjConfirmDelete').classList.add('open');
}
</script>
