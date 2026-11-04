{{-- The "Attach File / No file attached" control, applied to every file field
     on the page.

     A browser writes "No file chosen" beside a file input and no stylesheet
     can change that wording, so the control is built around the input rather
     than restyled. The input is never altered - same name, same accept, same
     required, same posting - it is only moved inside a label and taken out of
     sight by .am-file's own rule.

     Doing it here, once, rather than at each of the forty-odd fields is what
     keeps those forms out of reach: nothing that posts is touched, so no form
     can be broken by a styling change.

     A label is what opens the picker, so a file can still be chosen with no
     script at all; the script only writes the name back and re-runs for
     fields that arrive later, which the edit popups do.

     Opt out of one by giving it data-am-file="off". --}}
<script>
(function () {
    var WORDS = { pick: 'Attach File', none: 'No file attached' };

    function label(box) {
        var input = box.querySelector('input[type="file"]');
        var name  = box.querySelector('[data-am-file-name]');
        if (!input || !name) return;
        var files = input.files;
        if (files && files.length > 1) {
            name.textContent = files.length + ' files attached';
        } else if (files && files.length === 1) {
            name.textContent = files[0].name;
        } else {
            name.textContent = WORDS.none;
        }
        box.classList.toggle('has-file', !!(files && files.length));
    }

    function dress(input) {
        if (!input || input.getAttribute('data-am-file') === 'off') return;
        if (input.closest('.am-file')) return;              // already done

        var box = document.createElement('label');
        box.className = 'am-file';
        // beside Bootstrap-styled fields the border has to be theirs, not the
        // design system's - see .am-file--strong in the stylesheet
        if (input.classList.contains('form-control')) box.className += ' am-file--strong';

        input.parentNode.insertBefore(box, input);
        box.appendChild(input);

        var btn = document.createElement('span');
        btn.className = 'am-file__btn';
        btn.innerHTML = '<i class="fa fa-paperclip"></i>';
        btn.appendChild(document.createTextNode(' ' + WORDS.pick));

        var name = document.createElement('span');
        name.className = 'am-file__name';
        name.setAttribute('data-am-file-name', '');
        name.textContent = WORDS.none;

        box.appendChild(btn);
        box.appendChild(name);
        label(box);
    }

    function dressAll(root) {
        var inputs = (root || document).querySelectorAll('input[type="file"]');
        for (var i = 0; i < inputs.length; i++) dress(inputs[i]);
    }

    document.addEventListener('change', function (e) {
        var input = e.target.closest ? e.target.closest('input[type="file"]') : null;
        if (!input) return;
        var box = input.closest('.am-file');
        if (box) label(box);
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () { dressAll(); });
    } else {
        dressAll();
    }

    // the edit popups and the "add a row" buttons bring fields in later
    if (window.MutationObserver) {
        new MutationObserver(function (records) {
            for (var i = 0; i < records.length; i++) {
                var added = records[i].addedNodes;
                for (var j = 0; j < added.length; j++) {
                    var n = added[j];
                    if (n.nodeType !== 1) continue;
                    if (n.matches && n.matches('input[type="file"]')) dress(n);
                    else if (n.querySelectorAll) dressAll(n);
                }
            }
        }).observe(document.documentElement, { childList: true, subtree: true });
    }
})();
</script>
