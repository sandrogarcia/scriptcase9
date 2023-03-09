/**
 * JQuery MultiDraggable Plugin
 *
 * Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 *
 * Written by Vinicius Muniz <vmunizm@gmail.com>
 *
 * MultiDraggable is a jQuery plugin which extends jQuery UI Draggable to add multi drag and live functionality.
 *
 **/
(function ($, undefined) {
    $.fn.multiDraggable = function (opts) {
        var initLeftOffset = []
            ,initTopOffset = [];
        var dropPosition = [];
        return this.each (function (){
            $(this).on("mouseover", function() {
                if (!$(this).data("init")) {
                    $(this).data("init", true).draggable(opts,{
                        start: function (event,ui) {
                            var pos = $(this).position();
                            if($(opts.group).length > 1) {
                                $(opts.group).each(function (key, value) {
                                    var elemPos = $(value).position();
                                    initLeftOffset[key] = elemPos.left - pos.left;
                                    initTopOffset[key] = elemPos.top - pos.top;
                                });
                            }
                            if(opts.droppable)
                            {
                                $(opts.droppable).each(function(key, value)
                                {
                                    dropPosition[key] = $(value).position();
                                })
                            }
                            opts.startNative ? opts.startNative(event,ui) : {};
                        },
                        drag: function(event,ui) {
                            var pos = $(this).offset();
                            if($(opts.group).length > 1) {
                                $(opts.group).each(function (key, value) {
                                    $(value).offset({
                                        left: pos.left + initLeftOffset[key],
                                        top: pos.top + initTopOffset[key]
                                    });
                                });
                            }
                            opts.dragNative ? opts.dragNative(event,ui) : {};
                        },
                        stop: function(event,ui) {
                            var pos = $(this).offset();
                            if($(opts.group).length > 1) {
                                $(opts.group).each(function (key, value) {
                                    $(value).offset({
                                        left: pos.left + initLeftOffset[key],
                                        top: pos.top + initTopOffset[key]
                                    });
                                });
                            }
                            opts.stopNative ? opts.stopNative(event,ui) : {};
                            initLeftOffset = [];
                            initTopOffset = [];
                        },
                    });
                }
            });
        });
    };
}(jQuery));