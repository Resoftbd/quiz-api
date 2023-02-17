function _parseInt(num){
    num = parseInt(num);
    if(isNaN(num))
        num = 0;
    return num;
}

function _parseFloat(num,toFixed){
    toFixed = typeof toFixed === 'undefined' ? 0 : toFixed;
    num = parseFloat(num);
    if(isNaN(num))
        num = 0;
    if(toFixed)
        num = num.toFixed(toFixed);
    return num;
}

function block_ui() {

}
function unblock_ui() {

}


function globalAjaxErrorFn(){
    swal({
        title: 'Failed',
        text: 'Something wrong, Please try again',
        type: 'error',
    });
}
function globalAjaxSuccessFn(response){
    if(response['showMsg'] && response['swalActive']){
        swal({
            title: response['msgTitle']+'!',
            text: response['msg'],
            type: response['msgType']
        }).then( function () {
            if(response['reloadPage'])
                location.reload();
        },function (dismiss) {
            if(response['reloadPage'])
                location.reload();
        });
    }
}

$(function(){
    var landingPageCon = 'landingPageCon';
    var landingPages = 'landingPages';
    var qoutesEditable = 'qoutesEditable';

    var arrangeQoutes = function(element){
        var parent, grandParent;
        if(element.hasClass(landingPages))
            parent = element;
        else
            parent = element.closest('.'+landingPages);
        grandParent = element.closest('.'+landingPageCon);
        var postData = {
            landingPageCon: _parseInt(grandParent.attr('data-landing')),
            landingPages: _parseInt(parent.attr('data-page')),
            qoutes: [],
        };
        parent.find('.'+qoutesEditable).each(function(){
            var element = $(this);
            var route = element.attr('data-route');
            var text = element.html();
            if(typeof route != 'undefined')
                postData.qoutes.push([text,route]);
        });
        return postData;
    };

    var setQoutes = function(obj){
        obj = $.extend( {
            landingPageCon: 0,
            landingPages: 0,
            qoutes: [],
        },obj);
        var parent, grandParent, landingPageConClass, landingPagesClass;
        if(obj.landingPageCon && obj.landingPages && Object.keys(obj.qoutes).length){
            landingPageConClass = '.'+landingPageCon+'[data-landing="'+obj.landingPageCon+'"]';
            landingPagesClass = '.'+landingPages+'[data-page="'+obj.landingPages+'"]';
            grandParent = $(landingPageConClass);
            parent = grandParent.find(landingPagesClass);
            console.log(landingPageConClass,grandParent,landingPagesClass,parent);
            for(var x in obj.qoutes){
                parent.find('.'+qoutesEditable+'[data-route="'+x+'"]').html(obj.qoutes[x]);
            }
        }
    };

    var editMode = function(element,edit){
        var parentClass = landingPages;
        var parent;
        if(element.hasClass(parentClass))
            parent = element;
        else
            parent = element.closest('.'+parentClass);
        if(typeof edit === 'undefined' || edit) {
            parent.find('.'+qoutesEditable).attr('contenteditable','true');
            parent.addClass('editing');
            $( '.orderManagement' ).removeClass('hideDiv');
            var input = parent.find('.'+qoutesEditable).first();
            input.focus();

        }
        else {
            parent.find('.'+qoutesEditable).attr('contenteditable','false');
            parent.removeClass('editing');
            $('.orderManagement').addClass('hideDiv');
            $( '#socialDiv' ).addClass('fullSocialWidth');



        }
    };

    var save = function(element){
        var parentClass = landingPages;
        var parent;
        if(element.hasClass(parentClass))
            parent = element;
        else
            parent = element.closest('.'+parentClass);

        var postData = arrangeQoutes(element);

        if(postData.qoutes.length){
            block_ui();
            $.ajax({
                url: baseUrl+'user/funnel-page-update',
                type:'post',
                dataType:'json',
                data:postData,
                success: function(response){
                    globalAjaxSuccessFn(response);
                    if(response.status){
                        editMode(element,false);
                    }
                    unblock_ui();
                },
                error: function(response){
                    globalAjaxErrorFn();
                    unblock_ui();
                }
            });
        }
        else{
            swal({
                'title':'Information',
                'type':'info',
                'html':'Sorry, Nothing here to Save',
            });
        }

    };

    var reset = function(element){
        var parentClass = landingPages;
        var parent;
        if(element.hasClass(parentClass))
            parent = element;
        else
            parent = element.closest('.'+parentClass);

        var postData = arrangeQoutes(element);
        if(postData.qoutes.length){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, RESET!',
                cancelButtonText: 'No, Cancel!',
                confirmButtonClass: 'btn btn-success m-r-5',
                cancelButtonClass: 'btn btn-danger m-l-5',
                buttonsStyling: false
            }).then(function () {
                block_ui();
                $.ajax({
                    url : baseUrl+'user/funnel-page-reset',
                    type : 'post',
                    dataType : 'json',
                    data : postData,
                    success : function(response){
                        globalAjaxSuccessFn(response);
                        unblock_ui();
                        if(response.status){
                            editMode(element,false);
                            setQoutes(response.data);
                        }
                    },
                    error : function(){
                        globalAjaxErrorFn();
                        unblock_ui();
                    }
                });
            }, function (dismiss) {
                if (swal_dismiss(dismiss)) {
                    swal(
                        'Cancelled',
                        'Your imaginary Data is safe :)',
                        'error'
                    );
                    unblock_ui();
                }
            });
        }
        else{
            swal({
                'title':'Information',
                'type':'info',
                'html':'Sorry, Nothing here to Reset',
            });
        }

    };


    $('.landingPages .editBtn').click(function(event){
        event.preventDefault();
        var element = $(this);
        editMode(element);
    });

    $('.landingPages .cancelBtn').click(function(event){
        event.preventDefault();
        var element = $(this);
        editMode(element,false);
    });

    $('.landingPages .saveBtn').click(function(event){
        event.preventDefault();
        var element = $(this);
        save(element);
    });

    $('.landingPages .resetBtn').click(function(event){
        event.preventDefault();
        var element = $(this);
        reset(element);
    });



});