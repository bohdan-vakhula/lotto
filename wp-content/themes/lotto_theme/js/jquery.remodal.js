!(function ($) {
    "use strict";
    var pluginName = "remodal", defaults = {hashTracking: true, closeOnConfirm: true, closeOnCancel: true, closeOnEscape: true, closeOnAnyClick: true}, current, scrollTop;
    function getTransitionDuration($elem) {
        var duration = $elem.css("transition-duration") || $elem.css("-webkit-transition-duration") || $elem.css("-moz-transition-duration") || $elem.css("-o-transition-duration") || $elem.css("-ms-transition-duration") || "0s", delay = $elem.css("transition-delay") || $elem.css("-webkit-transition-delay") || $elem.css("-moz-transition-delay") || $elem.css("-o-transition-delay") || $elem.css("-ms-transition-delay") || "0s", max, len, num, i;
        duration = duration.split(", ");
        delay = delay.split(", ");
        for (i = 0, len = duration.length, max = Number.NEGATIVE_INFINITY; i < len; i++) {
            num = parseFloat(duration[i]) + parseFloat(delay[i]);
            if (num > max) {
                max = num;
            }
        }
        return num * 1000;
    }
    function getScrollbarWidth() {
        if ($(document.body).height() <= $(window).height()) {
            return 0;
        }
        var outer = document.createElement("div"), inner = document.createElement("div"), widthNoScroll, widthWithScroll;
        outer.style.visibility = "hidden";
        outer.style.width = "100px";
        document.body.appendChild(outer);
        widthNoScroll = outer.offsetWidth;
        outer.style.overflow = "scroll";
        inner.style.width = "100%";
        outer.appendChild(inner);
        widthWithScroll = inner.offsetWidth;
        outer.parentNode.removeChild(outer);
        return widthNoScroll - widthWithScroll;
    }
    function lockScreen() {
//    var $body=$(document.body),
//            paddingRight=parseInt($body.css("padding-right"),10)+getScrollbarWidth();
//    $body.css("padding-right",paddingRight+"px");
        $("html, body").addClass(pluginName + "-is-locked");
    }

    function unlockScreen() {
//        var $body = $(document.body),
//                paddingRight = parseInt($body.css("padding-right"), 10) - getScrollbarWidth();
//        $body.css("padding-right", paddingRight + "px");
        $("html, body").removeClass(pluginName + "-is-locked");
    }
    function parseOptions(str) {
        var obj = {}, arr, len, val, i;
        str = str.replace(/\s*:\s*/g, ":").replace(/\s*,\s*/g, ",");
        arr = str.split(",");
        for (i = 0, len = arr.length; i < len; i++) {
            arr[i] = arr[i].split(":");
            val = arr[i][1];
            if (typeof val === "string" || val instanceof String) {
                val = val === "true" || (val === "false" ? false : val);
            }
            if (typeof val === "string" || val instanceof String) {
                val = !isNaN(val) ? +val : val;
            }
            obj[arr[i][0]] = val;
        }
        return obj;
    }
    function Remodal($modal, options) {
        var remodal = this, tdOverlay, tdModal, tdBg;
        remodal.settings = $.extend({}, defaults, options);
        remodal.$body = $(document.body);
        remodal.$overlay = $("." + pluginName + "-overlay");
        if (!remodal.$overlay.length) {
            remodal.$overlay = $("<div>").addClass(pluginName + "-overlay");
            remodal.$body.append(remodal.$overlay);
        }
        remodal.$bg = $("." + pluginName + "-bg");
        remodal.$closeButton = $("<a href='#'></a>").addClass(pluginName + "-close");
        remodal.$wrapper = $("<div>").addClass(pluginName + "-wrapper");
        remodal.$modal = $modal;
        remodal.$modal.addClass(pluginName);
        remodal.$modal.css("visibility", "visible");
        remodal.$modal.append(remodal.$closeButton);
        remodal.$wrapper.append(remodal.$modal);
        remodal.$body.append(remodal.$wrapper);
        remodal.$confirmButton = remodal.$modal.find("." + pluginName + "-confirm");
        remodal.$cancelButton = remodal.$modal.find("." + pluginName + "-cancel");
        tdOverlay = getTransitionDuration(remodal.$overlay);
        tdModal = getTransitionDuration(remodal.$modal);
        tdBg = getTransitionDuration(remodal.$bg);
        remodal.td = tdModal > tdOverlay ? tdModal : tdOverlay;
        remodal.td = tdBg > remodal.td ? tdBg : remodal.td;
        remodal.$closeButton.bind("click." + pluginName, function (e) {
            e.preventDefault();
            remodal.close();
        });
        remodal.$cancelButton.bind("click." + pluginName, function (e) {
            e.preventDefault();
            remodal.$modal.trigger("cancel");
            if (remodal.settings.closeOnCancel) {
                remodal.close();
            }
        });
        remodal.$confirmButton.bind("click." + pluginName, function (e) {
            e.preventDefault();
            remodal.$modal.trigger("confirm");
            if (remodal.settings.closeOnConfirm) {
                remodal.close();
            }
        });
        $(document).bind("keyup." + pluginName, function (e) {
            if (e.keyCode === 27 && remodal.settings.closeOnEscape) {
                remodal.close();
            }
        });
        remodal.$wrapper.bind("click." + pluginName, function (e) {
            var $target = $(e.target);
            if (!$target.hasClass(pluginName + "-wrapper")) {
                return;
            }
            if (remodal.settings.closeOnAnyClick) {
                remodal.close();
            }
        });
        remodal.index = $[pluginName].lookup.push(remodal) - 1;
        remodal.busy = false;
    }
    Remodal.prototype.open = function () {
        if (this.busy) {
            return;
        }
        
//        $(window).scrollTop(0);
        var remodal = this, id;
        remodal.busy = true;
        remodal.$modal.trigger("open");
        id = remodal.$modal.attr("data-" + pluginName + "-id");
        if (id && remodal.settings.hashTracking) {
//            scrollTop = $(window).scrollTop();
            location.hash = id;
        }
        if (current && current !== remodal) {
            current.$overlay.hide();
            current.$wrapper.hide();
            current.$body.removeClass(pluginName + "-is-active");
        }
        current = remodal;
        lockScreen();
        remodal.$overlay.show();
        remodal.$wrapper.show();
        setTimeout(function () {
            remodal.$body.addClass(pluginName + "-is-active");
            setTimeout(function () {
                remodal.busy = false;
                remodal.$modal.trigger("opened");
            }, remodal.td + 50);
        }, 25);
    };
    Remodal.prototype.close = function () {
        if (this.busy) {
            return;
        }
        this.busy = true;
        this.$modal.trigger("close");
        var remodal = this;
        if (remodal.settings.hashTracking && remodal.$modal.attr("data-" + pluginName + "-id") === location.hash.substr(1)) {
            location.hash = "";
//            $(window).scrollTop(scrollTop);
        }
        remodal.$body.removeClass(pluginName + "-is-active");
        setTimeout(function () {
            remodal.$overlay.hide();
            remodal.$wrapper.hide();
            unlockScreen();
            remodal.busy = false;
            remodal.$modal.trigger("closed");
        }, remodal.td + 50);
    };
    $[pluginName] = {lookup: []};
    $.fn[pluginName] = function (opts) {
        var instance, $elem;
        this.each(function (index, elem) {
            $elem = $(elem);
            if ($elem.data(pluginName) == null) {
                instance = new Remodal($elem, opts);
                $elem.data(pluginName, instance.index);
                if (instance.settings.hashTracking && $elem.attr("data-" + pluginName + "-id") === location.hash.substr(1)) {
                    instance.open();
                }
            }
        });
        return instance;
    };
    $(document).ready(function () {
        $(document).on("click", "[data-" + pluginName + "-target]", function (e) {
            e.preventDefault();
            var elem = e.currentTarget, id = elem.getAttribute("data-" + pluginName + "-target"), $target = $("[data-" + pluginName + "-id=" + id + "]");
            $[pluginName].lookup[$target.data(pluginName)].open();
        });
        $(document).find("." + pluginName).each(function (i, container) {
            var $container = $(container), options = $container.data(pluginName + "-options");
            if (!options) {
                options = {};
            } else if (typeof options === "string" || options instanceof String) {
                options = parseOptions(options);
            }
            $container[pluginName](options);
        });
    });
    function hashHandler(e, closeOnEmptyHash) {
        var id = location.hash.replace("#", ""), instance, $elem;
        if (typeof closeOnEmptyHash === "undefined") {
            closeOnEmptyHash = true;
        }
        if (!id) {
            if (closeOnEmptyHash) {
                if (current && !current.busy && current.settings.hashTracking) {
                    current.close();
                }
            }
        } else {
            try {
                $elem = $("[data-" + pluginName + "-id=" + id.replace(new RegExp("/", "g"), "\\/") + "]");
            } catch (err) {
            }
            if ($elem && $elem.length) {
                instance = $[pluginName].lookup[$elem.data(pluginName)];
                if (instance && instance.settings.hashTracking) {
                    instance.open();
                }
            }
        }
    }
    $(window).bind("hashchange." + pluginName, hashHandler);
})(window.jQuery || window.Zepto);