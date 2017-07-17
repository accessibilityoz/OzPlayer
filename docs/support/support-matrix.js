
/* implement with/no-JS switch for the support tables
*/
(function()
{
    if(!(document.querySelector && document.addEventListener)) { return; }

    function toggleScripting(toggle)
    {
        var
        from = toggle.getAttribute('data-scripting-state'),
        to = from == 'true' ? 'false' : 'true';

        toggle.setAttribute('aria-checked', to);
        toggle.setAttribute('data-scripting-state', to);
        toggle.previousSibling.setAttribute('data-icon-state', to);

        toggle.firstChild.nodeValue = toggle.parentNode.parentNode.getAttribute('data-scripting-' + to);

        for(var rows = toggle.table.querySelector('tbody').querySelectorAll('tr'), rlen = rows.length, r = 0; r < rlen; r ++)
        {
            for(var cells = rows[r].querySelectorAll('td'), clen = cells.length, c = 0; c < clen; c ++)
            {
                rows[r].replaceChild(toggle.table.dataMatrix[r][to][c], cells[c]);
            }
        }
    }

    for(var tables = document.querySelectorAll('table.matrix'), tlen = tables.length, t = 0; t < tlen; t ++)
    {
        var table = tables[t];

        table.querySelector('thead').querySelector('td').removeAttribute('colspan');
        table.querySelector('tfoot').querySelector('td').removeAttribute('colspan');

        table.dataMatrix = [];

        for(var rows = table.querySelector('tbody').querySelectorAll('tr'), rlen = rows.length, r = 0; r < rlen; r ++)
        {
            var row = rows[r],

            rowhead = row.querySelector('th[rowspan="2"]');

            if(rowhead)
            {
                var celldata =
                {
                    'true'  : [],
                    'false' : []
                };

                for(var cells = row.querySelectorAll('td'), clen = cells.length, c = 0; c < clen; c ++)
                {
                    celldata['true'].push(cells[c].cloneNode(true));
                }

                rowhead.removeAttribute('rowspan');

                row.removeChild(row.querySelectorAll('th').item(1));
            }

            else
            {
                for(var cells = row.querySelectorAll('td'), clen = cells.length, c = 0; c < clen; c ++)
                {
                    celldata['false'].push(row.removeChild(cells[c]));
                }

                table.dataMatrix.push(celldata);

                row.parentNode.removeChild(row);
            }
        }


        var
        caption = table.querySelector('caption'),

        scripting = document.createElement('small'),
        icon = scripting.appendChild(document.createElement('span'));

        icon.setAttribute('aria-hidden', 'true');
        icon.setAttribute('data-icon-true', '\u2714');
        icon.setAttribute('data-icon-false', '\u2718');
        icon.setAttribute('data-icon-state', 'true');

        var toggle = scripting.appendChild(document.createElement('span'));
        toggle.appendChild(document.createTextNode(caption.getAttribute('data-scripting-true')));

        toggle.setAttribute('role', 'checkbox');
        toggle.setAttribute('aria-checked', 'true');
        toggle.setAttribute('tabindex', '0');

        toggle.setAttribute('data-scripting-state', 'true');

        caption.appendChild(scripting);


        toggle.table = table;

        toggle.addEventListener('mouseup', function(e)
        {
            toggleScripting(e.target);

        }, false);

        toggle.addEventListener('keydown', function(e)
        {
            if(e.keyCode == 13)
            {
                toggleScripting(e.target);
            }

        }, false);
    }


    var link = document.querySelector('link[href*="support-responsive.css"]');

    if(link && link.hasAttribute('media'))
    {
        link.setAttribute('media', 'only all and (max-width:50em)');
    }

})();
