(function ($) {

    $.fn.getIframeSize = function (containerSelector) {
        // if (!containerSelector.jquery) {
        //     containerSelector = $(containerSelector);
        // }
        var iframe = this;
        iframe.load(function () {
            var listener = function (event) {
                // Ignore messages from other iframes or windows.
                if (event.data.id !== 'cashier') {
                    return;
                }
                // If we get an integer, that is a request to resize the window
                var intRegex = /^[0-9]+$/;
                if (intRegex.test(parseInt(event.data.height)) && intRegex.test(parseInt(event.data.width))) {
                    $(containerSelector).height(Math.round(event.data.height));
                    //iframe.width(Math.round(event.data.width));
                    iframe.height(Math.round(event.data.height));
                }
            }

            // Setup the listener.
            if (window.addEventListener) {
                addEventListener("message", listener, false);
            }
            else {
                attachEvent("onmessage", listener);
            }
        });

    }

}(jQuery));