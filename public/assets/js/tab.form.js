$(function(){



    $(document).on('click','*[scroll-target]',function(event){
        event.preventDefault();
        var element = $(this);
        var scroll_target = element.attr('scroll-target');
        if(typeof scroll_target !== 'undefined' && $(scroll_target).length)
            pageScroll($(scroll_target).offset().top);
    });

    var tab_style_1 = $('.tab-style-1');
    var tab_style_1_fixed_offset = 0;
    tab_style_1.each(function(){
        var element = $(this);
        var tab_style_1 = element;

        var tab_content_preloader = tab_style_1.find('.tab-content-preloader').first();
        var tab_body = tab_style_1.find('.tab-body').first();
        var parent_ = tab_body;
        var elementChild = parent_.find('.nav-tabs li').length;
        var width_ = 100 / elementChild;
        parent_.find('.nav-tabs li').css({'width':width_+'%'});
        var elementNo;
        //var current_active_tab = parent_.find('.nav-tabs li.active');  //bootstrap 3
        var current_active_tab = parent_.find('.nav-tabs li a.active');   //bootstrap 4
        if(!current_active_tab.length){
            current_active_tab = parent_.find('.nav-tabs li:eq(0)');
        }
        elementNo = current_active_tab.index() + 1;
        var left_,right_;
        if(parent_.find('.nav-tabs').hasClass('from-right')){
            left_ = (elementNo - 1) * width_;
            right_ = 100 - left_ -width_;
        }
        else{
            right_ = (elementNo - 1) * width_;
            left_ = 100 - right_ -width_;
        }
        if(left_ < 0) left_ = 0; if(right_ < 0) right_ = 0;
        var left_underline = parent_.find('.tab-underline-left');
        var center_underline = parent_.find('.tab-underline-center');
        var tab_active_layer = parent_.find('.tab-active-layer');
        center_underline.css({'right':left_+'%','left':right_+'%'});
        tab_active_layer.css({'right':left_+'%','left':right_+'%'});
        var loader = false;
        if(current_active_tab.length){
            $(current_active_tab.find('a').attr('href')).addClass('in active');
            // current_active_tab.find('a').tab('show');
            loader = current_active_tab.find('a').attr('data-loader');
            if(typeof loader === 'undefined') loader = true;
            else if(loader == 'false') loader = false;
            else loader = true;

            var target = $(current_active_tab.find('a').attr('href'));
            var target_content = target.find('.tab-pane-section-content');
            var target_form = target.find('.tab-pane-section-form');
            if(target_content.length){
                if(target_form.hasClass('open')){
                    target_content.hide();
                    target_form.show().addClass('open');
                }
                else{
                    target_content.show().addClass('open');
                    target_form.hide();
                }
            }
        }

    });

    // var tab_content_preloader = tab_style_1.find('.tab-content-preloader').first();
    // if(!loader)
    //   tab_content_preloader.fadeOut(0);



    tab_style_1.find('.nav-tabs a').on('shown.bs.tab', function(event){
        var element = $(this);
        tab_style_1 = element.closest('.tab-style-1');
        var elementNo = element.parent().index() + 1;
        var parent_ = element.closest('.tab-body'); //element.closest('.tab-style-1>.tab-body');
        // console.log('parent_ '+parent_.length);
        var elementChild = parent_.find('.nav-tabs li').length;
        var width_ = 100 / elementChild;
        var left_,right_;
        if(parent_.find('.nav-tabs').hasClass('from-right')){
            left_ = (elementNo - 1) * width_;
            right_ = 100 - left_ -width_;
        }
        else{
            right_ = (elementNo - 1) * width_;
            left_ = 100 - right_ -width_;
        }
        if(left_ < 0) left_ = 0; if(right_ < 0) right_ = 0;
        var left_underline = parent_.find('.tab-underline-left');
        var center_underline = parent_.find('.tab-underline-center');
        var tab_active_layer = parent_.find('.tab-active-layer');
        center_underline.css({'right':left_+'%','left':right_+'%'});
        tab_active_layer.css({'right':left_+'%','left':right_+'%'});
        var target = $(element.attr('href'));
        var target_content = target.find('.tab-pane-section-content');
        var target_form = target.find('.tab-pane-section-form');
        if(target_content.length){
            target_content.show();
            target_form.hide();
        }

    });


    var tab_style_1_fixed = $('.tab-style-1.tab-fixed-allowed');
    if(tab_style_1_fixed.length == 1){
        function tab_scroll_fixed(tab,set){
            if(!set){
                tab.addClass('tab-fixed').removeClass('tab-fixed-apply');
                if(tab.hasClass('tab-style-1-type-2-alone'))
                    tab.css({'padding-top':'20px'});
                else
                    tab.css({'padding-top':'0px'});
            }
            else{
                var tab_style_1_menu_height = tab_style_1.find('.tab-body').first().outerHeight();
                tab.addClass('tab-fixed-apply').removeClass('tab-fixed');
                tab_style_1_menu_height = 0;
                tab.css({'padding-top':tab_style_1_menu_height+'px'});
            }
        }

        $(window).resize(function(){
            pageScroll($(window).scrollTop()-1,true);
        });


        var lastScrollTop = 0;
        var top_header = $('.top-banner>.part-1');
        var top_header_height = top_header.outerHeight();

        $(window).scroll(function(event){
            var st = $(this).scrollTop();
            st = top_header.outerHeight() + st;
            if (st > lastScrollTop){
                // downscroll
                if(tab_style_1_fixed.length){
                    tab_scroll_fixed(tab_style_1_fixed,false);
                }

            } else {
                // upscroll
                if(tab_style_1_fixed.length){
                    if(st > tab_style_1_fixed.offset().top+tab_style_1_fixed_offset && st < tab_style_1_fixed.outerHeight())
                        tab_scroll_fixed(tab_style_1_fixed,true);
                    else
                        tab_scroll_fixed(tab_style_1_fixed,false);
                }

            }
            lastScrollTop = st;
        });
    }


    var tab_content_preloader_timeout = 0;


});