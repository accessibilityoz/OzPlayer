
/* add line-numbers to the code examples
 * http://www.sitepoint.com/best-practice-for-code-examples
*/
(function()
{

    if(typeof(window.getComputedStyle) == 'undefined')
    {
        return;
    }

    var pre = document.getElementsByTagName('pre');

    for(var len = pre.length, i = 0; i < len; i ++)
    {
        var code = pre[i].getElementsByTagName('code').item(0);
        if(!code)
        {
            code = pre[i].getElementsByTagName('samp').item(0);
            if(!code)
            {
                continue;
            }
        }

        var column = document.createElement('div');
        column.setAttribute('aria-hidden', 'true');

        for(var n = 0; n < code.innerHTML.split(/[\n\r]/g).length; n ++)
        {
            column.appendChild(document.createElement('span'));
        }

        pre[i].insertBefore(column, code);
        pre[i].className = 'line-numbers';
    }

})();

/* details element omnifill
 * http://www.sitepoint.com/fixing-the-details-element
*/
(function()
{

    if(typeof(document.createElement('span').getBoundingClientRect) == 'undefined') { return; }

    function addEvent(node, type, callback)
    {
        if(node.addEventListener)
        {
            node.addEventListener(type, function(e)
            {
                callback(e, e.target);

            }, false);
        }
        else if(node.attachEvent)
        {
            node.attachEvent('on' + type, function(e)
            {
                callback(e, e.srcElement);
            });
        }
    }

    function addClickEvent(node, callback)
    {
        var keydown = false;
        addEvent(node, 'keydown', function()
        {
            keydown = true;
        });
        addEvent(node, 'keyup', function(e, target)
        {
            keydown = false;
            if(e.keyCode == 13) { callback(e, target); }
        });
        addEvent(node, 'click', function(e, target)
        {
            if(!keydown) { callback(e, target); }
        });
    }

    function getAncestor(node, match)
    {
        do
        {
            if(!node || node.nodeName.toLowerCase() == match)
            {
                break;
            }
        }
        while(node = node.parentNode);

        return node;
    }

    var started = false;

    function addDetailsOmnifill(list)
    {
        if(started)
        {
            return;
        }
        started = true;

        if((list = document.getElementsByTagName('details')).length == 0)
        {
            return;
        }

        for(var n = list.length, i = 0; i < n; i ++)
        {
            var details = list[i];

            details.__native = typeof(details.open) == 'boolean';

            details.__summary = details.getElementsByTagName('summary').item(0);
            details.__content = details.getElementsByTagName('div').item(0);

            if(!details.__content) { return; }

            if(!details.__content.id)
            {
                details.__content.id = 'details-content-' + i;
            }

            details.__summary.setAttribute('aria-controls', details.__content.id);

            details.__summary.setAttribute('tabindex', '0');

            details.__content.setAttribute('aria-expanded', 'false');
            details.__content.style.display = 'none';
            details.removeAttribute('open');

            details.__summary.__details = details;

            if(!details.__native)
            {
                var twisty = document.createElement('span');
                twisty.className = 'twisty';
                twisty.setAttribute('aria-hidden', 'true');
                twisty.setAttribute('data-twisty', '\u25ba');

                details.__summary.__twisty = details.__summary.insertBefore(twisty, details.__summary.firstChild);
            }
        }

        function statechange(summary, expanded)
        {
            if(typeof(expanded) == 'undefined')
            {
                expanded = summary.__details.__content.getAttribute('aria-expanded') == 'true';
            }
            else if(expanded === false)
            {
                summary.__details.setAttribute('open', 'open');
            }
            else if(expanded === true)
            {
                summary.__details.removeAttribute('open');
            }

            summary.__details.__content.setAttribute('aria-expanded', (expanded ? 'false' : 'true'));
            summary.__details.__content.style.display = (expanded ? 'none' : 'block');

            if(summary.__twisty)
            {
                summary.__twisty.setAttribute('data-twisty', expanded ? '\u25ba' : '\u25bc');
            }

            return true;
        }

        addClickEvent(document, function(e, summary)
        {
            if(!(summary = getAncestor(summary, 'summary')))
            {
                return true;
            }
            return statechange(summary);
        });

        function autostate(target, expanded, ancestor)
        {
            if(typeof(ancestor) == 'undefined')
            {
                if(!(target = getAncestor(target, 'details')))
                {
                    return null;
                }
                ancestor = target;
            }
            else
            {
                if(!(ancestor = getAncestor(ancestor, 'details')))
                {
                    return target;
                }
            }

            statechange(ancestor.__summary, expanded);

            return autostate(target, expanded, ancestor.parentNode);
        }

        if(location.hash)
        {
            autostate(document.getElementById(location.hash.substr(1)), false);
        }

        addEvent(document, 'click', function(e, target)
        {
            do
            {
                if(target.href)
                {
                    break;
                }
            }
            while(target = target.parentNode);
            if(!target)
            {
                return true;
            }
            if((target = target.href.split('#')).length == 1)
            {
                return true;
            }
            if(document.location.href.split('#')[0] != target[0])
            {
                return true;
            }
            if(target = autostate(document.getElementById(target[1]), false))
            {
                window.scrollBy(0, target.getBoundingClientRect().top);
            }
            return true;
        });
    }

    addEvent(document, 'DOMContentLoaded', addDetailsOmnifill);
    addEvent(window, 'load', addDetailsOmnifill);

})();

