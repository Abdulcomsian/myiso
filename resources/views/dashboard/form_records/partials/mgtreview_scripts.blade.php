{{-- Everything the Management Reviews page does in the browser. Shared by the
     user page and the admin page, so the two cannot behave differently.

     $listUrl   where the search and the pager fetch from
--}}
@php $mrWords = App\MgtReviewQuestions::labels(); @endphp
<script>
(function () {
    var listUrl = @json($listUrl ?? url('/add_management_review'));
    var remove  = @json($mrWords['remove']);

    /* ---- the "what to bring" panels, as on a QMS Audit question. Each one
           opens in place; the panel is found by walking up to the question
           rather than by id, because the form is rendered twice. ---- */
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.qms-guide-toggle');
        if (!btn) return;
        var card = btn.closest('[data-mr-q]');
        var pnl  = card && card.querySelector('.qms-guide');
        if (!pnl) return;
        var open = pnl.classList.toggle('is-open');
        btn.classList.toggle('is-open', open);
    });

    /* ---- the file widget shows what was picked. Only the Arabic site draws
           its own, so this does nothing where the browser's is used. ---- */
    var showPicked = function (input) {
        var wrap = input.closest('.custom-file-input-tag');
        if (!wrap) return;
        var text   = wrap.querySelector('.file-text');
        var chosen = wrap.querySelector('.file-chosen');
        if (!text || !chosen) return;
        var n = input.files.length;
        text.style.display   = n ? 'none' : '';
        chosen.style.display = n ? 'inline-block' : '';
        if (n) chosen.textContent = n === 1 ? input.files[0].name : n + ' / ' + input.files[0].name;
    };

    /* ---- the files picked for Part 3 D become tiles you can take off again.
           A FileList cannot be edited, so the input is given a fresh one each
           time: that keeps what is on screen and what will be sent the same. ---- */
    var pickedTiles = function (input) {
        var list = input.closest('.mr-attach').parentNode.querySelector('.mr-files--picked');
        if (!list) return;
        list.innerHTML = '';
        Array.prototype.forEach.call(input.files, function (f, i) {
            var chip = document.createElement('span');
            chip.className = 'mr-file-chip';
            var name = document.createElement('span');
            name.textContent = f.name;
            var drop = document.createElement('button');
            drop.type = 'button';
            drop.className = 'mr-file-chip__drop';
            drop.setAttribute('data-i', i);
            drop.setAttribute('title', remove);
            drop.innerHTML = '&times;';
            chip.appendChild(name);
            chip.appendChild(drop);
            list.appendChild(chip);
        });
        list.hidden = input.files.length === 0;
    };

    document.addEventListener('change', function (e) {
        var input = e.target.closest('input[type="file"]');
        if (!input) return;
        showPicked(input);
        if (input.multiple) pickedTiles(input);
    });

    document.addEventListener('click', function (e) {
        var drop = e.target.closest('.mr-file-chip__drop');
        if (!drop) return;
        e.preventDefault();
        var list  = drop.closest('.mr-files--picked');
        var box   = list.parentNode;
        var input = box.querySelector('input[type="file"][multiple]');
        if (!input) return;
        var skip = parseInt(drop.getAttribute('data-i'), 10);
        var dt   = new DataTransfer();
        Array.prototype.forEach.call(input.files, function (f, i) { if (i !== skip) dt.items.add(f); });
        input.files = dt.files;
        showPicked(input);
        pickedTiles(input);
    });

    /* ---- modals ---- */
    document.addEventListener('click', function (e) {
        var close = e.target.closest('.am-modal-close');
        if (close) { var m = close.closest('.am-modal'); if (m) m.classList.remove('open'); return; }
        if (e.target.classList && e.target.classList.contains('am-modal')) e.target.classList.remove('open');
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') document.querySelectorAll('.am-modal.open').forEach(function (m) { m.classList.remove('open'); });
    });

    /* ---- the add form opens and shuts. While a review is being edited the
           Cancel is a link back to the list, so it is left alone here. ---- */
    var toggle = document.getElementById('toggleMgtForm');
    var form   = document.getElementById('newMgtForm');
    var cancel = document.getElementById('cancelMgtForm');
    toggle && toggle.addEventListener('click', function () { form.classList.toggle('open'); });
    if (cancel && cancel.tagName === 'BUTTON') {
        cancel.addEventListener('click', function () { form.classList.remove('open'); });
    }

    /* ---- delete ---- */
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.am-confirm-delete');
        if (!btn) return;
        e.preventDefault();
        document.getElementById('amConfirmForm').setAttribute('action', btn.getAttribute('data-action') || '');
        document.getElementById('amConfirmId').value = btn.getAttribute('data-id') || '';
        document.getElementById('amConfirmType').textContent = btn.getAttribute('data-type') || 'Item';
        document.getElementById('amConfirmLabel').textContent = btn.getAttribute('data-label') || 'this item';
        document.getElementById('amConfirmDelete').classList.add('open');
    });

    /* ---- search and paging ---- */
    var input     = document.getElementById('amMgtSearch');
    var searchFrm = document.getElementById('amMgtSearchForm');
    var container = document.getElementById('amMgtContainer');
    if (container) {
        var debounce = function (fn, wait) {
            var t;
            return function () { var c = this, a = arguments; clearTimeout(t); t = setTimeout(function () { fn.apply(c, a); }, wait); };
        };
        var fetchPage = function (page) {
            var q = input ? input.value.trim() : '';
            container.style.opacity = '0.5'; container.style.pointerEvents = 'none';
            fetch(listUrl + '?q=' + encodeURIComponent(q) + '&page=' + page, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function (r) { return r.text(); })
                .then(function (html) { container.innerHTML = html; container.style.opacity = ''; container.style.pointerEvents = ''; })
                .catch(function () { container.style.opacity = ''; container.style.pointerEvents = ''; });
        };
        input && input.addEventListener('input', debounce(function () { fetchPage(1); }, 350));
        searchFrm && searchFrm.addEventListener('submit', function (e) { e.preventDefault(); fetchPage(1); });
        container.addEventListener('click', function (e) {
            var btn = e.target.closest('.am-page-link');
            if (!btn || btn.disabled) return;
            e.preventDefault();
            var p = parseInt(btn.getAttribute('data-page'), 10);
            if (!isNaN(p) && p > 0) fetchPage(p);
        });
    }

    /* ---- Part 3 C: add and remove an action row ---- */
    document.addEventListener('click', function (e) {
        var add = e.target.closest('.mr-add-action');
        if (add) {
            e.preventDefault();
            var table = document.getElementById(add.getAttribute('data-table'));
            if (!table) return;
            var body = table.querySelector('tbody');
            var i = body.querySelectorAll('tr').length;
            // keep counting past any row already removed, so two rows never share an index
            var used = body.querySelectorAll('input[name^="mract["]');
            if (used.length) {
                var max = -1;
                used.forEach(function (el) {
                    var m = el.name.match(/^mract\[(\d+)\]/);
                    if (m) max = Math.max(max, parseInt(m[1], 10));
                });
                i = max + 1;
            }
            var tr = document.createElement('tr');
            tr.innerHTML =
                '<td><input type="text" name="mract[' + i + '][action]"></td>' +
                '<td><input type="text" name="mract[' + i + '][who]"></td>' +
                '<td><input type="date" max="2999-12-31" name="mract[' + i + '][when]"></td>' +
                '<td style="text-align:center;">' +
                    '<input type="hidden" name="mract[' + i + '][done]" value="0">' +
                    '<input type="checkbox" class="mr-done" name="mract[' + i + '][done]" value="1">' +
                '</td>' +
                '<td style="text-align:center;"><button type="button" class="am-icon-btn danger mr-row-remove" title="Remove"><i class="fa fa-trash"></i></button></td>';
            body.appendChild(tr);
            var first = tr.querySelector('input');
            if (first) first.focus();
            return;
        }
        var rm = e.target.closest('.mr-row-remove');
        if (rm) { e.preventDefault(); var row = rm.closest('tr'); if (row) row.remove(); }
    });

    /* ---- Part 3 B: mark a box to go to the Objectives Tracker on save ---- */
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.mr-add-tracker');
        if (!btn) return;
        e.preventDefault();
        var box    = btn.closest('.mr-objective');
        var hidden = box.querySelector('input[type="hidden"]');
        var note   = box.querySelector('.mr-tracker-note');
        var on     = hidden.value !== '1';
        hidden.value = on ? '1' : '0';
        btn.classList.toggle('is-on', on);
        if (note) note.hidden = !on;
    });

    /* ---- the details popup ---- */
    var esc = function (s) {
        return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
        });
    };
    var date = function (s) { return s ? new Date(s).toLocaleDateString() : amMgtWords.none; };
    var block = function (label, value) {
        return '<div class="mr-view-block"><div class="mr-view-label">' + esc(label) + '</div>' +
               '<div class="mr-view-value">' + (value ? esc(value).replace(/\n/g, '<br>') : amMgtWords.none) + '</div></div>';
    };

    window.amMgtView = function (d) {
        var W = amMgtWords, h = '';

        h += '<div class="mr-view-meta">' +
             block(W.meta[0], d.reviewdate ? date(d.reviewdate) : '') +
             block(W.meta[1], d.chairedby) +
             block(W.meta[2], d.meetingatt) +
             block(W.meta[3], d.nextreviewdue ? date(d.nextreviewdue) : '') +
             '</div>';

        (d.questions || []).forEach(function (q) {
            var v = block(q.no + '. ' + q.title, q.answer);
            if (q.file) {
                v = v.replace('</div></div>', '</div><div class="mr-view-file"><a target="_blank" href="' + esc(q.file) + '">' +
                    '<i class="fa fa-external-link-alt"></i> ' + esc(W.evidence) + '</a></div></div>');
            }
            h += v;
        });

        h += block(W.decisions, d.decisions);

        (d.objectives || []).forEach(function (o) { h += block(o.label, o.value); });

        if ((d.actions || []).length) {
            h += '<div class="mr-view-block"><div class="mr-view-label">' + esc(W.actions) + '</div>' +
                 '<div class="am-table-wrap"><table class="am-table"><thead><tr>' +
                 W.cols.map(function (c) { return '<th>' + esc(c) + '</th>'; }).join('') +
                 '</tr></thead><tbody>' +
                 d.actions.map(function (a) {
                     return '<tr><td>' + esc(a.action) + '</td><td>' + esc(a.who || amMgtWords.none) + '</td>' +
                            '<td>' + (a.when ? date(a.when) : amMgtWords.none) + '</td>' +
                            '<td>' + (a.done ? '<i class="fa fa-check" style="color:#1a8a5c;"></i>' : '') + '</td></tr>';
                 }).join('') +
                 '</tbody></table></div></div>';
        }

        if ((d.files || []).length) {
            h += '<div class="mr-view-block"><div class="mr-view-label">' + esc(W.files) + '</div><div class="mr-files">' +
                 d.files.map(function (f) {
                     return '<span class="mr-file-chip"><a target="_blank" href="' + esc(f.url) + '">' + esc(f.name) + '</a></span>';
                 }).join('') + '</div></div>';
        }

        (d.legacy || []).forEach(function (l) { h += block(l.label, l.value); });

        document.getElementById('amMgtViewBody').innerHTML = h;
        document.getElementById('DetailModal').classList.add('open');
    };
})();
</script>
