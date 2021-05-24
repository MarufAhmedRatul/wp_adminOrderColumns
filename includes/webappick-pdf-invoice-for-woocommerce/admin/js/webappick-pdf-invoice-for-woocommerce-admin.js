(function ( $ ) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     */

    // scroll add and remove class
    $(window).scroll(
        function () {
            if ($(this).scrollTop() + $(window).height() < $(document).height()-150) {
                $('.woo-invoice-save-changes-selector').addClass("woo-invoice-save-changes");
            }
            else{
                $('.woo-invoice-save-changes-selector').removeClass("woo-invoice-save-changes");
            }
        }
    );

    $(window).on(
        "mousewheel", function (e) {

            //if($(window).scrollTop() + $(window).height() > $(document).height()-100)  {

            //$(".woo-invoice-save-changes-selector").removeClass("woo-invoice-save-changes");
            // } else {
            //$(".woo-invoice-save-changes-selector").addClass("woo-invoice-save-changes");
            //}

            var initialContent = $(".woo-invoice-dashboard-content > li:eq(0)");
            $('.woo-invoice-dashboard-sidebar .woo-invoice-sidebar-navbar-light').height(initialContent.parent().height()-23);

        }
    );

    $(window).load(
        function () {

            $("input[name='wf_tabs']").on(
                'change',function () {
                    var selectedTab = $(this).val();
                    sessionStorage.setItem('active_tab', selectedTab);

                }
            );

            var  activeTab = sessionStorage.getItem('active_tab');

            if(activeTab === "settings") {
                $('#tab1').attr("checked", true);

            }else if(activeTab === 'seller&buyer') {
                $('#tab2').attr("checked", true);

            }else if(activeTab === "localization") {
                $('#tab3').attr("checked", true);

            }else if(activeTab === 'bulk_download') {
                $('#tab4').attr("checked", true);

            }
            // set active of Setting tab ended


            //Bulk input date validation
            var from_date;
            var to_date;
            var toCheck   = 0;
            var fromCheck = 0;

            $('#Date-from').on(
                'change',function () {
                    from_date = Date.parse($(this).val());
                    fromCheck = 1;
                    if(toCheck && fromCheck) {
                        if(to_date<from_date) {
                            alert("Input date should be less than or equal Date To");
                            $('#Date-from').val("");
                            fromCheck = 0;
                        }
                    }

                }
            );

            $('#Date-to').on(
                'change',function () {
                    to_date = Date.parse($(this).val());
                    toCheck = 1;
                    if(toCheck && fromCheck) {
                        if(to_date<from_date) {
                            alert("Input date should be greater than or equal Date From");
                            $('#Date-to').val("");
                            toCheck = 0;

                        }
                    }

                }
            );

            $(
                function () {

                    var tabs = $('.woo-invoice-sidebar-navbar-nav > li > a'); //grab tabs
                    var contents = $('.woo-invoice-dashboard-content > li'); //grab contents

                    if(sessionStorage.getItem('activeSidebarTab') != null ) {

                        var activeSidebarTab = sessionStorage.getItem('activeSidebarTab');
                        contents.hide(); //hide all contents
                        tabs.removeClass('active'); //remove 'current' classes
                        $(contents[activeSidebarTab]).show(); //show tab content that matches tab title index
                        var activeTabSelector = $(".woo-invoice-sidebar-navbar-nav > li:eq( "+activeSidebarTab+" ) > a");
                        activeTabSelector.addClass('active');
                        /*$(this).addClass('active'); //add current class on clicked tab title*/
                        $('.woo-invoice-dashboard-sidebar .woo-invoice-sidebar-navbar-light').height($(contents[activeSidebarTab]).parent().height()-23);
                    } else {

                        var initialContent = $(".woo-invoice-dashboard-content > li:eq(0)");
                        initialContent.css('display','block'); //show tab content that matches tab title index
                        var activeTabSelector = $(".woo-invoice-sidebar-navbar-nav > li:eq(0) > a");
                        activeTabSelector.addClass('active');
                        $('.woo-invoice-dashboard-sidebar .woo-invoice-sidebar-navbar-light').height(initialContent.parent().height()-23);
                    }

                    tabs.bind(
                        'click',function (e) {
                            e.preventDefault();
                            var tabIndex = $(this).parent().prevAll().length;
                            contents.hide(); //hide all contents
                            tabs.removeClass('active'); //remove 'current' classes
                            $(contents[tabIndex]).show(); //show tab content that matches tab title index
                            $(this).addClass('active'); //add current class on clicked tab title

                            var selectedSidebarTab = $(this).parent().prevAll().length;
                            sessionStorage.setItem('activeSidebarTab', selectedSidebarTab);
                            $('.woo-invoice-dashboard-sidebar .woo-invoice-sidebar-navbar-light').height(contents.parent().height()-23);
                        }
                    );
                }
            );


        }
    );



    $(document).on(
        'click', '.woo-invoice-template-selection', function (e) {
            e.preventDefault();
            let template = $(this).data('template');
            $('#winvoiceModalTemplates').modal('hide');
            $("body").removeClass(
                function (index, className) {
                    return (className.match(/\S+-modal-open(^|\s)/g) || []).join(' ');
                }
            );
            $('div[class*="-modal-backdrop"]').remove();
            $(this).find('img').removeClass('woo-invoice-template');
            $(this).find('img').removeClass('woo-invoice-disable-template');
            $(this).find('img').addClass('woo-invoice-slected-template');

            $(".woo-invoice-element-disable").find('img').addClass('woo-invoice-template');
            $(".woo-invoice-element-disable").find('img').removeClass('woo-invoice-disable-template');
            $(".woo-invoice-element-disable").css('z-index',"3333");
            $(".woo-invoice-element-disable").siblings("div").css('z-index',"1111");
            $(".woo-invoice-element-disable").siblings("a").css('z-index',"2222");

            $(this).parent().siblings().find('img').removeClass('woo-invoice-slected-template').addClass('woo-invoice-template');
            $.ajax(
                {
                    url: woo_invoice_ajax_obj.woo_invoice_ajax_url,
                    type: 'post',
                    data: {
                        _ajax_nonce: woo_invoice_ajax_obj.nonce,
                        action: "wpifw_save_pdf_template",
                        template: template
                    },
                    success: function (response) {
                        $('.woo-invoice-template-preview').attr('src',response.data.location+'/'+response.data.template_name+'.png');
                        $('.invoice_template_preiview_btn').attr('href',response.data.location+'/'+response.data.template_name+'.png');
                    }
                }
            );
        }
    );


    $(document).on(
        'click', ".woo-invoice-element-disable", function (e) {
            e.preventDefault();
            $(this).children('img').removeClass('woo-invoice-template');
            $(this).children('img').addClass('woo-invoice-disable-template');
            $(this).css('z-index',"1111");
            $(this).siblings("div").css('z-index',"2222");
            $(this).siblings("a").css('z-index',"3333");

        }
    );

    //Datepicker
    flatpickr(
        ".woo-invoice-datepicker", {
            "dateFormat":"n/j/Y",
            "allowInput":true,
            "onOpen": function (selectedDates, dateStr, instance) {
                instance.setDate(instance.input.value, false);
            }
        }
    );

    // Free vs premium slider
    $(window).load(
        function () {
            $('.woo-invoice-slider').slick(
                {
                    autoplay: true,
                    dots: true,
                    centerMode: true,
                    arrows: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    lazyLoad: 'progressive'
                }
            );
        }
    );
    // Invoice pro black friday promotion 2020.
    $(document).on('click', '.woo-invoice-campaign-close-button', function(event) {
        event.preventDefault();
        $(this).parent('.woo-invoice-promotion').hide();
        let condition = $(this).data('condition');

        if(1 === condition) {
            $.ajax(
                {
                    url: woo_invoice_ajax_obj.woo_invoice_ajax_url,
                    type: 'post',
                    data: {
                        _ajax_nonce: woo_invoice_ajax_obj.nonce,
                        action: "woo_invoice_hide_promotion",
                    },
                    success: function (response) {
                        console.log(response)
                    }
                }
            );
        }
    });

    $(window).load(function(){
        $("#wpfooter #footer-thankyou").html("If you like <strong><ins>Chalan</ins></strong> please leave us a <a target='_blank' style='color:#f9b918' href='https://wordpress.org/support/view/plugin-reviews/webappick-pdf-invoice-for-woocommerce?rate=5#postform'>★★★★★</a> rating. A huge thank you in advance!");
    });

})(jQuery);