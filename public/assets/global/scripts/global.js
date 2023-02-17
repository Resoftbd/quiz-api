"use strict";

if (typeof Object.create !== 'function') {
    Object.create = function (obj) {
        function F() {
        }

        F.prototype = obj;
        return new F();
    }
}

window.nbUtility = (function (document, $) {
        var self = {}, $elementClicked = null, modalBoxSelector = '#mobile-valid-modal';

        self.checkAsInteger = function (id) {
            var regularRex = /[0-9]+/;
            return regularRex.test(id);
        };

        self.isObject = function (value) {
            return value != null && typeof value === 'object';
        };

        self.checkEmail = function (email) {
            var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
            return reg.test(email);
        };

        self.notEmpty = function (data) {
            return !(this.isUndefined(data)) && $.trim(data) != '';
        };

        self.trim = function (str) {
            return $.trim(str);
        };

        self.isDomExist = function (dom) {
            return dom.length;
        };

        self.isUndefined = function (str) {
            return typeof str === 'undefined';
        };

        self.convertThumb = function (src, path, defaultPath) {
            var imgInfo;
            if (typeof src == 'string') {
                imgInfo = src.split('.');
                return path + imgInfo[0] + '_thumb.' + imgInfo[1];
            } else if (this.isObject(src)) {
                if (src['image_url'] != '') {
                    path = path.replace('user_id', src.user_id);
                    imgInfo = src['image_url'].split('.');
                    return path + imgInfo[0] + '_thumb.' + imgInfo[1];
                } else {
                    if (src['gender'] == 1) {
                        return '/img/profile_image/male_default_profile.png'
                    } else {
                        return '/img/profile_image/female_default_profile.png'
                    }
                }
            }
            else {
                return defaultPath;
            }
        };

        self.convertProfilePicThumb = function (src, path, suffix) {
            if (this.isObject(src)) {
                src = $.extend({}, {image_source: ''}, src);
                if (src.image_source != '') {
                    path = path.replace('user_id', src.user_id);
                    var imgInfo = src.image_source.split('.');
                    return path + imgInfo[0] + '_' + suffix + '.' + imgInfo[1];
                } else {
                    if (src['gender'] == 1) {
                        return '/img/profile_image/male_default_' + suffix + '.png'
                    } else {
                        return '/img/profile_image/male_default_' + suffix + '.png'
                    }
                }
            } else {
                return '/img/profile_image/male_default_profile.png'
            }
        };

        self.convertOriginal = function (src, path, defaultPath) {
            if (src) {
                return path.replace('thumb', 'original') + src;
            } else {
                return defaultPath;
            }
        };


        self.count = function (array) {
            return Object.keys(array).length;
        };

        self.isFunction = function (value) {
            return typeof value === 'function';
        };

        self.getBooleanAsBinary = function (value) {
            return this.notEmpty(value) && !isNaN(value = parseInt(value)) ? value : 0;
        };

        self.getIntegerAfterReplacement = function (value, replacedBy) {
            return this.getBooleanAsBinary(value.replace(replacedBy, ''));
        };

        self.getUserFullName = function (obj) {
            obj = $.extend({}, {first_name: '', middle_name: '', last_name: '', nickname: ''}, obj);
            var name = '', nickname = obj.nickname;
            if (nbUtility.isUndefined(nickname) || nickname == null || nickname == '') {
                name = [obj.first_name, obj.middle_name, obj.last_name].join(' ');
            } else {
                name = obj.nickname;
            }
            return name;
        };

        self.redirect = function (url) {
            url = this.isUndefined(url) ? window.location.href : this.trim(url);
            window.location = this.trim(url);
        };

        self.convertReadableTime = function (totalSec) {
            var hours = parseInt(totalSec / 3600);
            var seconds_left = (totalSec % 3600);
            var minutes = parseInt(seconds_left / 60);
            var seconds = parseInt(seconds_left % 60);
            return (hours + 'h ' + minutes + 'm ' + seconds + 's');
        };

        self.getTimeForDate = function (time) {
            var from = new Date().getTime() / 1000;
            time = from - time;

            var secondsInPeriod = {
                'Years': 946080000,
                'Months': 2592000,
                'Days': 86400,
                'Hours': 3600,
                'Minutes': 60,
                'Seconds': 1
            };

            var count = 0, name = '';
            $.each(secondsInPeriod, function (period, second) {
                name = period;
                return ((count = Math.floor(time / second)) == 0);
            });

            return count + ' ' + name + '  ' + 'Ago';
        };

        self.convertNumFromBnToEn = function (bnNum) {
            bnNum = this.trim(bnNum).toString();
            var dst = {'০': 0, '১': 1, '২': 2, '৩': 3, '৪': 4, '৫': 5, '৬': 6, '৭': 7, '৮': 8, '৯': 9},
                enNum = '', i;
            for (i = 0; i < bnNum.length; i++) {
                enNum += dst[bnNum[i]];
            }

            return parseInt(enNum);
        };

        self.convertNumFromEnToBn = function (enNum) {
            enNum = this.trim(enNum).toString();
            var bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], bnNum = '', i;
            for (i = 0; i < enNum.length; i++) {
                bnNum += bengaliDigits[parseInt(enNum[i])];
            }
            return bnNum;
        };

        self.convertFloatNumFromBnToEn = function (bnNum) {
            bnNum = this.trim(bnNum).toString();
            var dst = {'০': 0, '১': 1, '২': 2, '৩': 3, '৪': 4, '৫': 5, '৬': 6, '৭': 7, '৮': 8, '৯': 9, '.': '.'},
                enNum = '', i;
            for (i = 0; i < bnNum.length; i++) {
                enNum += (bnNum[i] in dst ? dst[bnNum[i]] : bnNum[i]);
            }
            return this.notEmpty(enNum) && !isNaN(enNum = parseFloat(enNum)) ? enNum : 0;
        };

        self.convertFloatNumFromEnToBn = function (enNum) {
            enNum = this.trim(enNum).toString();
            var bengaliDigits = {
                    0: '০',
                    1: '১',
                    2: '২',
                    3: '৩',
                    4: '৪',
                    5: '৫',
                    6: '৬',
                    7: '৭',
                    8: '৮',
                    9: '৯',
                    '.': '.'
                },
                bnNum = '', i;
            for (i = 0; i < enNum.length; i++) {
                bnNum += (enNum[i] in bengaliDigits ? bengaliDigits[enNum[i]] : enNum[i]);
            }
            return bnNum;
        };

        self.blinkElement = function (element) {
            element.animate({opacity: 0}, 600, 'linear', function () {
                $(this).animate({opacity: 1}, 200);
            });
        };

        self.isHide = function (dom) {
            return (dom.css('display') == 'none');
        };

        self.initializeFlashMessageActivity = function () {
            $('div.alert-message').delay(2500).slideUp();

            $('div.alert-message a.close').on('click', function () {
                $(this).parent().slideUp(function () {
                    $(this).remove();
                });
                return false;
            });
        };

        self.showFlashMessage = function (message, status) {
            switch (status) {
                case 'success':
                    alert(message);
                    break;

                case 'error':
                    alert(message);
                    break;
            }
        };


        self.isUserLoggedIn = function () {
            var isUserLoggedIn = $('#isUserLoggedIn').val();
            isUserLoggedIn = this.notEmpty(isUserLoggedIn) && !isNaN(isUserLoggedIn = parseInt(isUserLoggedIn)) ? isUserLoggedIn : 0;
            return !!isUserLoggedIn;
        };

        self.generateUid = function (separator) {
            var delimiter = separator || '-';

            /** @return {string} */
            function S4() {
                return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
            }

            return (S4() + S4() + delimiter + S4() + delimiter + S4() + delimiter + S4() + delimiter + S4() + S4() + S4());
        };

        self.showLoginBox = function () {
            alert('You have to login first.');
        };

        self.ajaxErrorHandling = function (response, callBack, options) {

            if (this.isUndefined(response.status)) {
                alert('System Error: Undefined input.');

            } else {
                switch (response.status) {
                    case 'not-logged-in':
                        nbUtility.redirect();
                        break;

                    case 'no-package':
                        alert(response.html);
                        break;

                    case 'no-active-package':
                        alert(response.html);
                        break;

                    case "access-deney":
                        alert(response.html);
                        nbUtility.redirect();
                        break;

                    case 'already-logged-in':
                    case 'invalid':
                        alert(response.html);
                        break;

                    case 'error':
                        if (this.isUndefined(options) || !('errorCallback' in options)) {
                            alert(response.html);
                        } else {
                            var errorCallback = options.errorCallback;
                            this.isFunction(errorCallback) ? errorCallback() : null;
                        }
                        break;

                    case 'success':
                        this.isFunction(callBack) ? callBack(response, options) : null;
                        break;

                    default:
                        alert('Something went wrong. Please try again.');
                }
            }
        };

        function setModalConfig($loginModal) {
            $loginModal.modal('show').find('form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: 'Please enter your email address.',
                        email: 'Please enter a valid email address.'
                    },
                    password: {
                        required: 'Please provide a password.',
                        minlength: 'Your password must be at least 6 characters long.'
                    }
                },
                submitHandler: function (form) {
                    mySiteAjax({
                        url: $(form).attr('action'),
                        data: $(form).serialize(),
                        success: function (response) {
                            nbUtility.ajaxErrorHandling(response, function () {
                                $('#login-modal').on('hidden.bs.modal', function () {
                                    $(this).remove();
                                }).modal('hide');
                            }, {
                                errorCallback: function () {
                                    setModalConfig($loginModal.html($(response.html).html()));
                                }
                            });
                        }
                    });
                    return false;
                }
            });
        }

        return self;

    }(document, window.jQuery)) || window.nbUtility;

window.mySiteAjax = (function ($) {
    var urlCalled = [];
    return function (params) {
        var settings = $.extend({
                url: '',
                spinner: $('.loadingIt'),
                loadSpinner: true,
                dataType: 'json',
                cache: false,
                type: 'post',
                simultaneousRequest: false,
                success: function () {
                },
                beforeSend: function () {
                },
                complete: function () {
                },
                errorMsg: 'Oops. Sorry about that.'
            }, params),
            retries = 0;

        function ajaxRequest() {
            return $.ajax({
                beforeSend: function () {
                    if (settings.loadSpinner) {
                        settings.spinner.show();
                    }
                    urlCalled[settings.url] = false;
                    nbUtility.isFunction(settings.beforeSend) ? settings.beforeSend() : null;
                },
                type: settings.type,
                url: settings.url,
                dataType: settings.dataType,
                success: settings.success,
                data: settings.data,
                complete: function () {
                    if (settings.loadSpinner) {
                        settings.spinner.hide();
                    }
                    urlCalled[settings.url] = true;
                    nbUtility.isFunction(settings.complete) ? settings.complete() : null;
                },
                error: function (xhr/*, tStatus, err*/) {
                    if (xhr.status === 401 || xhr.status === 403) {
                        //redirect action here
                    } else if (xhr.status === 504 && !retries++) {
                        //make our recursive request
                        return ajaxRequest();
                    } else {
                        /*$(document).trigger( 'ui-flash-message',
                         [{ message: settings.errorMsg }] );*/
                    }
                } // end error handler
            }); // end $.ajax()
        } // end ajaxRequest()
        if (settings.simultaneousRequest) {
            return ajaxRequest();
        } else if (nbUtility.isUndefined(urlCalled[settings.url]) || urlCalled[settings.url]) {
            return ajaxRequest();
        }
    };
})(jQuery);

window.waitingDialog = (function ($) {

    // Creating modal dialog's DOM
    var $dialog = $(
        '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
        '<div id="waiting-modal" class="modal-dialog modal-m">' +
        '<div class="modal-content">' +
        '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
        '<div class="modal-body">' +
        '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
        '</div>' +
        '</div></div></div>');

    return {
        /**
         * Opens our dialog
         * @param message Custom message
         * @param options Custom options:
         *        options.dialogSize - bootstrap postfix for dialog size, e.g. 'sm', 'm';
         *        options.progressType - bootstrap postfix for progress bar type, e.g. 'success', 'warning'.
         */
        show: function (message, options) {
            (typeof message === 'undefined') ? message = 'Loading' : null;
            (typeof options === 'undefined') ? options = {} : null;

            // Assigning defaults
            var settings = $.extend({
                dialogSize: 'm',
                progressType: ''
            }, options);

            // Configuring dialog
            $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
            $dialog.find('.progress-bar').attr('class', 'progress-bar');
            if (settings.progressType) {
                $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
            }
            $dialog.find('h3').text(message);
            $dialog.css('z-index', '1500');
            $dialog.modal();
        },
        /**
         * Closes dialog
         */
        hide: function () {
            $dialog.modal('hide');
            $dialog.on('hidden.bs.modal', function () {
                $(this).remove();
            });
        }
    }

})(jQuery);


window.spinnerDialog = (function ($) {

    // Creating modal dialog's DOM
    var $dialog = $('<div class="modal fade fade-scale" id="small_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> ' +
        '<div class="modal-dialog noradius" role="document"> ' +
        '<div class="modal-content"> ' +
        '<div class="modal-header"> ' +
        '<div class="modal-title"> <span class="txt"></span>' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button> ' +
        '</div>' +
        '</div> ' +
        '<div class="modal-body text-center loading-modal"> ' + '</div> ' +
        '</div> ' +
        '</div> ' +
        '</div>');


    return {

        show: function (message, options) {
            (typeof message === 'undefined') ? message = '<span class="spin spin-d-thin spin-45x"></span>' : message;
            (typeof options === 'undefined') ? options = {} : null;

            var settings = $.extend({
                header: false,
                headerMsg: 'Offerali',
                backdrop: 'static',
                keyboard: false,
                classes: " xsmall level-2 sm keep-modal-open"
            }, options);

            if (settings.header) {
                $dialog.find('.txt').html(settings.headerMsg);
                $dialog.find('.modal-header').show();
            } else {
                $dialog.find('.modal-header').hide();
            }
            $dialog.find('.modal-body').html(message);
            $dialog.addClass(settings.classes);
            $dialog.modal(settings);
        },

        hide: function (addBodyClass) {
            var addBodyClass = addBodyClass || false;
            $dialog.modal('hide');
            $dialog.on('hidden.bs.modal', function () {
                $(this).remove();
                if (!addBodyClass)
                    $('body').addClass('modal-open');

            });
        }
    }


})(jQuery);

window.customPopup = (function ($) {
    var defaultBtn = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
    var $dialog = $(
        '<div id="custom-modal" class="modal fade fade-scale modal-dark login-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
        '<div class="modal-dialog modal-md">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h5 class="modal-title"></h5>'+
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> ' +
        '</div>' +
        '<div class="modal-body">' +
        '</div>' + '<div class="modal-footer"></div>'
        + '</div></div></div>');

    return {
        show: function (settings) {
            $dialog.addClass(settings.dialogClass);
            $dialog.addClass(settings.dialogSize);
            $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
            $dialog.find('.modal-body').html(settings.message);
            $dialog.find('.modal-header .modal-title').text(settings.header);
            if (settings.footer) {
                $dialog.find('.modal-footer').html(defaultBtn + settings.footer);
            } else if (settings.footer == 'default') {
                $dialog.find('.modal-footer').html(defaultBtn);
            } else {
                $dialog.find('.modal-footer').remove();
            }
            return $dialog.modal((typeof settings.options == 'undefined') ? {
                backdrop: 'static',
                keyboard: false
            } : settings.options);
        }
    }

})(jQuery);

window.notification = {
    open: function (options, settings) {
        if (typeof options == 'object' && options.html != 'undefined') {

            if (options.html != 'undefined') {
                this.options.message = options.html;
            }

            if (options.status != 'undefined') {
                switch (options.status) {
                    case 'error':
                        this.settings.type = 'danger';
                        break;

                    case 'warning':
                        this.settings.type = 'warning';
                        break;

                    case 'success':
                        this.settings.type = 'success';
                        break;

                    default:
                        this.settings.type = 'info';

                }
            }
        }

        $.notify($.extend(this.options, options), $.extend(this.settings, settings));
    },
    options: {
        icon: '',
        title: '',
        message: 'Turning standard Bootstrap alerts into "notify" like notifications',
        url: '',
        target: '_blank'
    },
    settings: {
        element: 'body',
        position: null,
        type: '',
        allow_dismiss: false,
        newest_on_top: false,
        placement: {
            from: 'top',
            align: 'right'
        },
        offset: 20,
        spacing: 10,
        z_index: 40000000,
        delay: 1000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>'
    }
};

window.generateErrorMessage = function ($form, mesages, errorDom) {

    for (var elm in mesages) {
        if (!mesages[elm][0])
            continue;

        var formElement = $($form.submitEvent.target).find('[name="' + elm + '"]');

        if (!formElement.length)
            continue;

        var fromGroup = formElement.closest('.form-group');

        var errorWarper = fromGroup.find((errorDom) ? errorDom : '.col-md-6');
        fromGroup.removeClass('has-success').addClass('has-error');
        errorWarper.find('.help-block').remove();
        var errorsWrapper = $('<span>').attr({
            class: 'help-block'
        }).append($('<span>').html(mesages[elm][0]))
        errorWarper.append(errorsWrapper);
    }

}


window.SweetAlert = {
    defaultSettings: {
        title: "Are you sure?",
        text: "You will not be able to recover this data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: true,
        closeOnCancel: true
    },
    confirm: function (settings, onSuccessCallback, onErrorCallback) {
        $.extend(true, this.defaultSettings, settings);

        return swal(this.defaultSettings, function (isConfirm) {
            if (isConfirm) {
                ($.isFunction(onSuccessCallback)) ? onSuccessCallback() : null;
            } else {
                ($.isFunction(onErrorCallback)) ? onErrorCallback() : null;
            }
        });
    },
    alert: function (message, status, title) {
        swal(
            (typeof title == 'undefined') ? '' : title,
            (typeof message == 'undefined') ? 'You clicked the button!' : message,
            (typeof status == 'undefined') ? 'success' : status
        )
    }
};


window.parsleySettings = (function (params) {
    var params = params || {};

    var settings = {
        successClass: 'has-success',
        inputs: 'input, textarea, select, password',
        errorClass: 'has-error',
        errorTemplate: '<span></span>',
        errorsWrapper: '<span class="help-block"></span>',
        classHandler: function (_el) {
            return _el.$element.closest('.form-group');
        }
    }

    return {
        settings: $.extend(settings, params)
    }
})();

window.buttonLoader = (function () {

    return function (elm) {
        var originalContent, elm = elm, loader = '<span class="fa fa-spin fa-circle-o-notch"></span>';

        return {
            open: function () {
                originalContent = (originalContent) ? originalContent : elm.html();
                elm.html(loader);
            },
            hide: function () {
                elm.html(originalContent);
            }
        }
    }


})();


window.cloud = (function () {

    var cloudUrl = "https://s3.ap-south-1.amazonaws.com/offerali.com/";

    return function (options) {
        var settings = $.extend({
            section: "merchant",
            type: "banner",
            size: "large",
            path: "1"
        }, options)
        return {
            path: function (file) {

                return $('<img>').attr({
                    class: settings.type + '-img'
                }).one("load", function () {
                    if (settings.path)
                        $(this).context.src = cloudUrl + settings.section + '/' + settings.path + "/" + settings.type + "/" + settings.size + "/" + file
                    else
                        $(this).context.src = cloudUrl + settings.section + "/" + settings.type + "/" + settings.size + "/" + file


                }).each(function () {
                    $(this).context.src = '/assets/global/img/loading-spinner-grey.gif';
                    $(this).css({width: 100});
                    if (this.complete) {
                        $(this).css({width: 100});
                        $(this).load();
                    }

                });
            },
            imageLargePath: function (file) {
                if (file.length)
                    return cloudUrl + settings.section + '/' + settings.path + "/" + settings.type + "/" + settings.size + "/" + file
                else
                    return baseUrl + "/assets/global/img/no-image.png";
            },
            avatar: function (file, userId, size) {
                if (file.length)
                    return cloudUrl + "user" + '/' + userId + "/" + "profile" + "/" + size + "/" + file;
                else
                    return baseUrl + "/assets/front/img/user-default.jpg";
            }
        }
    }


})();

$.fn.clearForm = function () {
    return this.each(function () {
        var type = this.type, tag = this.tagName.toLowerCase();
        if (tag == 'form')
            return $(':input', this).clearForm();
        if (type == 'text' || type == 'password' || tag == 'textarea')
            (this.value != "-1") ? this.value = '' : this.value = '-1';
        else if (type == 'checkbox') {

        }
        else if (type == 'radio') {
            this.checked = false;
        }
        else if (tag == 'select')
            this.selectedIndex = 0;
    });
};


/*$(function () {
    $('div.alert').delay(5000).slideUp(300);
});*/


window.AjaxListing = function (params) {

    this.loadMore = false;
    this.page = 1;

    this.defaultSettings = {
        container: $('body'),
        paginateContainer: $("#paginate"),
        contentSpinner: $('<div class="reactLoadingIt"><span class="spin right"></span></div>'),
        paginationSpinner: $('<span class="spin right"></span>'),
        page: 1,
        url: "",
        loadMoreCount : true,
        token: document.head.querySelector("[property=csrf-token]").content,
        template: "",
        notFoundText:"Sorry, No Data available!!"
    }

    this.generatePagination = function (total, perPage, page) {
        var total = parseInt(total) - parseInt(perPage * page);
        var that = this;
        if (total > 0) {
            this.settings.paginateContainer.on('click', function () {
                page++;
                that.load(true, page);
            }).show();
            if(this.params.loadMoreCount)
                this.settings.paginateContainer.find('#load-more-text').html("Load more (" + total + ")");
            else
                this.settings.paginateContainer.find('#load-more-text').html("Load more");


        } else {
            this.settings.paginateContainer.hide();
        }
    }

    this.settings = $.extend(this.defaultSettings, params);

    this.init = function (params, externalProcess, callback) {
        this.params = $.extend({
            _token: this.settings.token
        }, params);
        this.externalProcess = externalProcess;
        this.callback = callback;
        this.load(this.loadMore, this.page);
    }

    this.load = function (loadMore, page) {
        var container = (!loadMore) ? this.settings.container.empty() : this.settings.container;
        var paginate = this.settings.container.find('#paginate');

        mySiteAjax({
            url: this.settings.url + '?page=' + page,
            type: 'post',
            data: this.params,
            loadSpinner: true,
            beforeSend: function () {
                if (loadMore)
                    this.settings.paginateContainer.find('#load-more-text').append(this.settings.paginationSpinner);
                else {
                    this.settings.paginateContainer.hide();
                    container.html(this.settings.contentSpinner);
                }
            }.bind(this),
            success: function (response) {
                this.settings.contentSpinner.hide();

                if (response.html.data.length) {
                    for (var i = 0; i < response.html.data.length; i++) {
                        var result = $.extend(this.externalProcess, response.html.data[i]);
                        container.append(Mustache.to_html(this.settings.template, result));
                    }
                    if (typeof this.callback == 'function') {
                        this.callback();
                    }
                    this.generatePagination(response.html.total, response.html.per_page, page)
                } else {
                    container.html(this.settings.notFoundText);
                }
            }.bind(this)
        });
    }
}

window.AjaxListing.prototype.setParams = function (params) {
    this.params = $.extend(this.params, params);
    return this;
}


window.offerAliDefaults = {
    "language": {
        "search": "",
        // search: "_INPUT_",
        "searchPlaceholder": "Search",
        "sLengthMenu": "_MENU_",
        "lengthMenu": "_MENU_",
        "paginate": {
            "first": "<<",
            "previous": "Prev",
            "next": "Next",
            "last": ">>"
        },
        "info": "",
        "infoEmpty": "",
        "infoFiltered": "",
    }

};

function pageScroll(destination, header) {
    if (typeof header === 'undefined')
        header = false;
    if (!header)
        destination = destination - $('.top-banner>.part-1').outerHeight() - 20;

    $('body,html').animate({scrollTop: (destination) + 'px'}, 500);
}

window.MultiStepForm = (function (settings) {

    var that = this;

    that.settings = settings;

    that.mode = 'Add';

    that.dom = that.settings.dom;

    that.section = $(".form-section");


    that.sectionToggle = $('.section-toggle');


    that.currentIndex = 0;

    that.navigate = function (index) {
        that.section.removeClass('current').eq(index).addClass('current');

        that.dom.find('button[tab-navigate="prev"]').toggle(index > 0);

        var atTheEnd = (index == that.section.length - 1);


        that.dom.find('button[tab-navigate="next"]').toggle(!atTheEnd);

        that.dom.find('button.submit').toggle(atTheEnd);
    }

    that.tab = function (selection, direction) {
        var tab = $(selection).closest('.tab-holder')
            .children('.tab-body')
            .find('.nav-tabs')
            //.find('li.active'); //bootstrap 3
            .find('a.active').closest('li'); // bootstrap 4


        if (direction == 'next') {
            return tab.next('li');
        } else if (direction == 'prev') {
            return tab.prev('li');
        } else {
            return that.dom
                .children('.tab-body')
                .find('.nav-tabs li')
                .first();
        }

    }

    that.nextTab = function (e) {
        if (that.validate()) {
            that.navigate(that.getCurrentIndex() + 1);

            var next_tab = that.tab(this, 'next');

            if (next_tab.length) {
                next_tab.removeClass('disabled').find('a').tab('show');
            }
            if (typeof that.settings.next === 'function') {
                that.settings.next();
            }
            pageScroll(that.dom);
        }
    }

    that.validate = function () {
        return $('#new-post-form')
            .parsley({
                successClass: 'has-success',
                inputs: 'input, textarea, select, password',
                errorClass: 'has-error',
                errorTemplate: '<span></span>',
                errorsWrapper: '<span class="error-box"></span>',
                classHandler: function (_el) {
                    return _el.$element.closest('.form-group');
                }
            })
            .validate({group: 'block-' + that.getCurrentIndex()});
    }

    that.previousTab = function () {
        var prev_tab = that.tab(this, 'prev');

        if (prev_tab.length)
            prev_tab.find('a').tab('show');

        that.navigate(that.getCurrentIndex() - 1);

        if (typeof that.settings.previous === 'function') {
            that.settings.previous();
        }

        pageScroll(that.dom);
    }


    that.shown = function () {
        if (typeof that.settings.shown === 'function') {
            that.settings.shown(that);
        }
    }

    that.getCurrentIndex = function () {
        return that.section.index(that.section.filter('.current'));
    }

    that.submit = function () {
        if (typeof that.settings.submit === 'function') {
            if (that.validate()) {
                that.settings.submit(that);
            }
        }
    }

    that.modify = function () {
        if (typeof that.settings.modify === 'function') {
            if (that.validate()) {
                that.settings.modify(that);
            }
        }
    }

    that.openForm = function () {
        that.sectionToggle.find('.pane-section-content').removeClass('open').slideUp(100);
        that.sectionToggle.find('.pane-section-form').addClass('open').slideDown(100);
    }

    that.closeForm = function () {
        that.clearForm();
        that.sectionToggle.find('.pane-section-form').removeClass('open').slideUp(100);
        that.sectionToggle.find('.pane-section-content').addClass('open').slideDown(100);
    }

    that.clearForm = function () {
        that.sectionToggle.find('form').clearForm();
        that.dom.find('.nav-tabs li').each(function (index, li) {
            if (index) {
                $(li).addClass('disabled');
            }
        });

        that.navigate(0);

        var first_tab = that.tab(this, 'first');
        if (first_tab.length) {
            first_tab.removeClass('disabled').find('a');//.tab('show');
            first_tab.find('a').tab('show');
        }

        if ($("#fine-uploader-gallery").length > 0) {
            $("#fine-uploader-gallery").fineUploader('reset');
        }

        if ($(".deal-type-container").length > 0) {
            $(".deal-type-section").hide();
        }

        if($('.photo_row').length > 0){
            $('.photo_row').html('');
        }

        $('.dynamic-instruction').remove();

        $('.dynamic-rules').remove();
    }

    that.resetTab = function () {
        that.navigate(0);
        var first_tab = that.tab(this, 'first');
        if (first_tab.length) {
            first_tab.removeClass('disabled').find('a');//.tab('show');
            first_tab.find('a').tab('show');
        }
    }


    that.dom.find('.nav-tabs a').on('shown.bs.tab', function () {
        that.shown.call(this);
    });

    that.dom.find('.nav-tabs a').on('shown.bs.tab', function () {
        that.shown.call(this);
    });

    that.dom.find('.nav-tabs a').click(function (event) {
        event.preventDefault();
        var element = $(this).closest('ul').find('li').index($(this).closest('li'));
        that.navigate(element);
        return true;

    });


    that.dom.find('button[tab-navigate="prev"]').click(function (e) {
        that.previousTab.call(this, e);
    });

    that.dom.find('button[tab-navigate="next"]').click(function (e) {
        that.nextTab.call(this, e);
    });

    that.dom.find('button.submit').click(function () {
        if (that.mode == 'Add')
            that.submit.call(this);
        else if (that.mode == 'Modify') {
            that.modify.call(this);
        }
    });

    that.section.each(function (index, section) {
        $(section).find(':input').attr('data-parsley-group', 'block-' + index);
    });

    that.dom.find('.nav-tabs li').each(function (index, li) {
        if (index) {
            $(li).addClass('disabled');
        }
    });

    that.sectionToggle.find('button[data-role="open-section-form"]').click(function (event) {
        $("#hiddenTags").val('');
        $("#pre_tag_home").html('');

        that.openForm.call(this);
    });

    that.sectionToggle.find('button[data-role="open-section-content"]').click(function (event) {
        that.closeForm.call(this);
    });

    that.generateReport = function (form_obj, modal, callBack) {

        var count = 1;

        form_obj.find("input,select,textarea").each(function () {

            if ($(this).is("[type='checkbox']") || $(this).is("[type='radio']")) {
                if ($(this).is(':checked')) {
                    $(this).attr("checked", "checked");
                }
                else {
                    $(this).removeAttr("checked");
                }
            } else if ($(this).is("select")) {
                var old = $(this).find('option');
                var slectedVal = $(this).val();
                $(this).empty();
                var that = $(this);

                $.each(old, function (index, item) {
                    if ($(item).val() == slectedVal) {
                        that.append(
                            $('<option>', {
                                value: $(item).val(),
                                text: $(item).text(),
                                selected: 'selected'
                            }, '</option>'));
                    } else if($(item).val() == '') {
                        that.append(
                            $('<option>', {
                                value: $(item).val(),
                                text: $(item).text()
                            }, '</option>'));
                    }

                });


            } else if ($(this).is("textarea")) {
                $(this).html($(this).val());
            }
            else {
                $(this).attr("value", $(this).val());
            }
        });

        var report = $("<div/>", {
            class: "form-confirmation-section col no-padding"
        }).append(form_obj.find('.tab-panel-body').html());

        var cancleBtn = $('<button/>', {
            class: "btn btn-fit btn-danger",
            text: "Cancel",
            type: "button",
            "data-dismiss": "modal",
        });

        var submitBtn = $('<button/>', {
            class: "btn btn-fit btn-success pull-right",
            text: "Proceed",
            type: "button",
        });

        var form_btn = $("<div/>", {
            class: "row modal-footer-custom"
        }).append($("<div/>", {
            class: "col-6"
        }).append(cancleBtn)).append($("<div/>", {
            class: "col-6"
        }).append(submitBtn));

        modal.find('.modal-body').append($('<div/>', {
            class: 'row'
        }).append(report)).append(form_btn);

        submitBtn.on('click', function () {
            if (typeof callBack === 'function') {
                callBack(submitBtn);
            }
        });

    }


    that.populateForm = function (form_obj, params) {

        form_obj.append($("<input/>", {
            type: 'hidden',
            name: "id",
            value: params.id
        }));

        //START TAG BLOCK
        //Written By Snehasish

        $("#hiddenTags").val(''); // remove previous date
        $("#pre_tag_home").html('');

        var allTags = 0;

        for (var i = 0; i < params.promotion_tags.length; ++i) {
            allTags = allTags + ','+ params.promotion_tags[i].tag['id'];
            $( "#pre_tag_home" ).append( "<span class='pre_tag' id='pre_tag_"+params.promotion_tags[i].tag['id']+"'><span class='cross_tag' id='cross_tag_"+params.promotion_tags[i].tag['id']+"'> x </span>"+ params.promotion_tags[i].tag['name'] +"</span>" );
        }

        $("#hiddenTags").val(allTags);

        //END TAG BLOCK


        form_obj.find("input,select,textarea").each(function () {

            $(".not-editable").attr("readonly","true"); // added by snehasish

            if ($(this).is("[type='checkbox']")) {
                var name = $(this).attr('name');
                if (typeof name == 'undefined') {
                    return;
                }
                var postFixs = name.substr(parseInt(name.length) - 2);

                if (postFixs == "[]") {
                    name = name.replace(postFixs, '');
                    var that = this;

                    if (typeof params[name] == 'object') {
                        $.each(params[name], function (index, data) {
                            if (data.type == $(that).val()) {
                                $(that).prop("checked", true);
                                if (data.type_data != '-1') {
                                    $(that).closest('.drip-condition-block-item')
                                        .find('.condition-input').show();

                                    $(that).closest('.drip-condition-block-item')
                                        .find('.condition-input')
                                        .find('input[name="condition-value:' + data.type + '"]')
                                        .val(data.type_data);

                                }
                            }
                        });
                    }
                } else {
                    if (typeof params[$(this).attr("name")] != 'undefined') {
                        slectedVal = params[$(this).attr("name")];
                    }

                    if ($(this).val() == slectedVal) {
                        $(this).prop("checked", true);
                    }
                }
            }
            else if ($(this).is("[type='radio']")) {
                if (typeof params[$(this).attr("name")] != 'undefined') {
                    slectedVal = params[$(this).attr("name")];
                }

                if ($(this).val() == slectedVal) {
                    $(this).prop("checked", true);
                }
            }
            else if ($(this).is("select")) {
                var old = $(this).find('option');

                var slectedVal = '';

                if (typeof params[$(this).attr("name")] != 'undefined') {
                    slectedVal = params[$(this).attr("name")];
                }

                $(this).empty();

                var that = $(this);


                $.each(old, function (index, item) {
                    if ($(item).val() == slectedVal) {
                        that.append(
                            $('<option>', {
                                value: $(item).val(),
                                text: $(item).text(),
                                selected: 'selected'
                            }, '</option>'))
                    } else {
                        that.append(
                            $('<option>', {
                                value: $(item).val(),
                                text: $(item).text()
                            }, '</option>'));
                    }

                });


            } else if ($(this).is("textarea")) {

                if (typeof params[$(this).attr("name")] != 'undefined') {
                    $(this).val(params[$(this).attr("name")]);
                }

            }
            else {
                if (typeof params[$(this).attr("name")] != 'undefined') {
                    $(this).val(params[$(this).attr("name")]);
                }
            }

        });
    }

    that.navigate(that.currentIndex);
});

window.AjaxContent = (function (settings) {

    var that = this
    that.settings = settings;

    that.loaderOpen = function () {
        that.settings.dom.find(".ajax-loader").show();
    }

    that.loaderClose = function () {
        that.settings.dom.find(".ajax-loader").hide();
    }


    that.panelClose = function () {
        that.settings.dom.hide();
    }


    that.panelOpen = function () {
        that.settings.dom.show();
        that.settings.others.hide();
    }

    that.addPanelContent = function (content, callBack) {
        that.settings.dom.find('.ajax-content').html(content);

        if (typeof callBack === 'function') {
            callBack(that);
        }
    }

    that.changePanelHeader = function (content) {
        that.settings.dom.find('.panel-title-content').html(content);
    }


    that.back = function () {
        that.settings.dom.hide();
        that.settings.others.show();
    }


});


window.ConvertOfferValidity = (function (validity) {

    var validity = parseInt(validity);

    return {
        offerDay: function () {
            var day = Math.floor(validity / (24 * 60));
            return day < 1 ? 0 : day;
        },
        offerHour: function () {
            var day = this.offerDay(validity);
            var hours = Math.floor((validity - (day * 24 * 60)) / (60));
            return hours < 1 ? null : hours;
        },
        offerMinute: function () {
            var day = this.offerDay(validity);
            var hour = this.offerHour(validity);
            var minutes = Math.floor(validity - (day * 24 * 60) - (hour * 60));

            return minutes < 1 ? null : minutes;
        },
    }
});



window.SingleForm = (function (settings) {

    var that = this;

    that.settings = settings;

    that.sectionToggle = $('.section-toggle');

    that.openForm = function () {
        that.sectionToggle.find('.pane-section-content').removeClass('open').slideUp(100);
        that.sectionToggle.find('.pane-section-form').addClass('open').slideDown(100);
    }

    that.closeForm = function () {
        that.sectionToggle.find('.pane-section-form').removeClass('open').slideUp(100);
        that.sectionToggle.find('.pane-section-content').addClass('open').slideDown(100);
    }


    that.sectionToggle.find('button[data-role="open-section-form"]').click(function (event) {
        that.openForm.call(this);
    });

    that.sectionToggle.find('button[data-role="open-section-content"]').click(function (event) {
        that.closeForm.call(this);
    });
});







window.customBlockUI = (function () {
    var settings = {
            overlayColor: '#000000',
            type: 'loader',
            state: 'success',
            message: 'Please wait...'
        };

    return function($dom, params){

        $.extend(settings, params);

        return {
            block: function(){
                mApp.block($dom,settings);
            },
            unBlock: function(){
                mApp.unblock($dom);
            }
        }
    }
})();
