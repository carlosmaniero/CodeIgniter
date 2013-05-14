// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }

    $(document).ready(function(){
        $('[data-mask]').each(function(){
            var data = $(this).attr('data-mask');
            if(data == 'phone'){
                $(this).mask('99 9999-9999?9');
            }else if(data == 'datetime'){
                $(this).mask('99/99/9999 99:99');
            }
            else if(data == 'date'){
                $(this).mask('99/99/9999');
            }else{
                $(this).mask(data);
            }
        });
    })
}());

// Place any jQuery/helper plugins in here.
