(function ($) {

    /* default option */


    var defaultOptions = {

        hash: false,

        active: 1,

        afterShow: null

    };


    var methods = {

        init: function (options) {

            // option

            options = $.extend({}, defaultOptions, options);

            var elementA = this.find('a'),

                containerTab = this.next(),

                boxTab = this.closest('.tab-area').find('.tab-box'),

                hashWindow = window.location.hash && window.location.hash.replace('-tab', '');


            /* check hash after load */

            if (hashWindow && hashWindow.length && options.hash) {

                setActiveTabLoad('', elementA, boxTab, hashWindow)

            } else {

                /* set active tab */

                setActiveElement(options.active, elementA)

                setActiveBoxTab(options.active, boxTab)

            }


            /* event click on a*/

            eventHandler(elementA, boxTab, options.hash, options)

        }

    };


    function setActiveElement(active, elementA, id) {

        if (id) {

            $(elementA).removeClass('active');

            $('[href="' + id + '"]').addClass('active');

        } else {

            $(elementA).each(function (i, item) {

                $(item).removeClass('active')

                if ((i + 1) == active) {

                    $(item).addClass('active')

                }

            })

        }

    }


    function setActiveBoxTab(active, box, id) {

        if (id) {

            $(box).removeClass('active').hide();

            $(id).addClass('active').show();

        } else {

            $(box).each(function (i, item) {

                $(item).removeClass('active').hide();

                if ((i + 1) == active) {

                    $(item).addClass('active').show();

                }

            })

        }

    }


    function setActiveTabLoad(active, elementA, box, id) {

        setActiveElement('', elementA, id)

        setActiveBoxTab('', box, id)

    }


    function eventHandler(elementA, box, hash, settings) {

        elementA.on('click', function () {

            var activeTab = $(this).attr('href'),

                _this = this;

            if (hash) window.location.hash = activeTab + '-tab';

            elementA.removeClass('active');

            $(this).addClass('active');

            setActiveBoxTab('', box, activeTab);

            if (typeof settings.afterShow === "function") {

                settings.afterShow(_this, activeTab);

            }

            return false

        })

    }


    $.fn.tabArt = function (method) {


        if (methods[method]) {

            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));

        } else if (typeof method === 'object' || !method) {

            return methods.init.apply(this, arguments);

        } else {

            $.error('The ' + method + ' have not');

        }

    };


})(jQuery);