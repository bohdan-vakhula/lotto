$ = jQuery;

var paginationQuery;
var MinimumAmountForWithdraw = 5;
var currency_symbol = CONFIG.siteCurrency;
var object_name = translationObject;

var num_of_draws_group_per_week              = new Array();
num_of_draws_group_per_week["POWERBALL"]     = 2;
num_of_draws_group_per_week["MEGAMILLIONS"]  = 2;
num_of_draws_group_per_week["LOTTO649"]      = 2;
num_of_draws_group_per_week["LAPRIMITIVA"]   = 2;
num_of_draws_group_per_week["EUROMILLIONS"]  = 2;
num_of_draws_group_per_week["EUROJACKPOT"]   = 1;
num_of_draws_group_per_week["ELGORDO"]       = 1;
num_of_draws_group_per_week["SUPERENALOTTO"] = 3;
num_of_draws_group_per_week["BONOLOTO"]      = 6;
num_of_draws_group_per_week["UKLOTTO"]       = 2;
num_of_draws_group_per_week["NEWYORKLOTTO"]  = 2;
num_of_draws_group_per_week["OZLOTTO"] = 1;

var discountByDraws       = new Array();
discountByDraws['single'] = new Array();
discountByDraws['group']  = new Array();

discountByDraws['single'][2]   = 2;
discountByDraws['single'][3]   = 3;
discountByDraws['single'][4]   = 4;
discountByDraws['single'][6]   = 12;
discountByDraws['single'][8]   = 15;
discountByDraws['single'][12]  = 16;
discountByDraws['single'][16]  = 16;
discountByDraws['single'][24]  = 16;
discountByDraws['single'][26]  = 22;
discountByDraws['single'][52]  = 25;
discountByDraws['single'][100] = 28;

discountByDraws['group'][12]  = 10;
discountByDraws['group'][16]  = 10;
discountByDraws['group'][24]  = 15;
discountByDraws['group'][26]  = 15;
discountByDraws['group'][52]  = 20;
discountByDraws['group'][100] = 25;

jQuery(document).ready(function($) {
	

    $('.mobile-trigger').on('click', function(e){
        e.preventDefault();

        var toggleClass = 'show-' + $(this).data('href');

        if ( !$('#header').is('.'+toggleClass) ){
            $('#header').addClass( toggleClass );
        }else{
            $('#header').removeClass( toggleClass );
        }
    });

    jQuery(".how1").click(function(event) {
        jQuery("#how-box2").hide();
        jQuery("#how-box3").hide();
        jQuery("#how-box1").show();
        jQuery("#how-box4").hide();
        jQuery(".how1").addClass("howactive");
        jQuery(".how2,.how3,.how4").removeClass("howactive");
    });
    jQuery(".how2").click(function(event) {
        jQuery("#how-box2").show();
        jQuery("#how-box3").hide();
        jQuery("#how-box1").hide();
        jQuery("#how-box4").hide();
        jQuery(".how2").addClass("howactive");
        jQuery(".how1,.how3,.how4").removeClass("howactive");
    });

    jQuery(".how3").click(function(event) {
        jQuery("#how-box2").hide();
        jQuery("#how-box3").show();
        jQuery("#how-box1").hide();
        jQuery("#how-box4").hide();
        jQuery(".how3").addClass("howactive");
        jQuery(".how1,.how2,.how4").removeClass("howactive");
    });

    jQuery(".how4").click(function(event) {
        jQuery("#how-box2").hide();
        jQuery("#how-box3").hide();
        jQuery("#how-box1").hide();
        jQuery("#how-box4").show();
        jQuery(".how4").addClass("howactive");
        jQuery(".how2,.how3,.how1").removeClass("howactive");
    });

    jQuery(".phoenix-slider").phoenix({
        fullscreen: false,
        height: '100%'
    });

    jQuery(".middle_scroller").show();

    jQuery("#owl-demo").owlCarousel({
        navigation: false,
    });
    /*
    TODO Del js in php file

    function callback(elem){
        jQuery(".owl-item").each(function( index ) {
            var el = jQuery(this).find( "#caro_clock_"+index)
            el.countdown(el.attr("data-time"), function (event) {
                jQuery(el).html(event.strftime("<strong>%D "+days+"</strong> %H:%M:%S"));
            });
        });
    }
    */
    // owl carousel end

    jQuery(".allbrands tr").on("click", function() {
        window.location = jQuery(this).find(".dd_play_button").attr("href");
    });

    jQuery(".allresult tr").on("click", function() {
        window.location = jQuery(this).find("a").attr("href");
    });

    jQuery(".infocontent tr").on("click", function() {
        window.location = jQuery(this).find("a").attr("href");
    });

    jQuery(document).on('mouseenter', '.nav-item', function() {
        jQuery(this).find(".ddsubmenustyle").css("top", "29px");
        jQuery(this).find(".ddsubmenustyle").show();
    }).on('mouseleave', '.nav-item', function() {
        jQuery(this).find(".ddsubmenustyle").hide();
    });

    jQuery("#scroller").simplyScroll({
        customClass: 'vert',
        orientation: 'vertical',
        auto: true,
        manualMode: 'loop',
        speed: 1,
        pauseOnTouch: true
    });

     /* ------------------------------------------------------------ *\
       FAQ Page
    \* ------------------------------------------------------------ */
    if (".faq-main".length) {
        $('.faq-nav li').click(function (e) {
            var questionNumber = $(this).data("question");
            $('.faq-nav li').removeClass("current-question");
            $('.faq-main li').removeClass('open-answer');
            $(this).addClass("current-question");

            $('.faq-main li').each(function( index ) {
                if ($(this).data("question-content") === questionNumber) {
                    $(this).addClass('open-answer');
                };
            });
        });

        $('.faq-main li h3').click(function (e) {
            var questionNumber = $(this).parent().data("question-content");
            $('.faq-main li').removeClass('open-answer');
            $(this).parent().addClass('open-answer');

            $('.faq-nav li').each(function( index ) {
                $(this).removeClass('current-question');
                if ($(this).data("question") === questionNumber) {
                    $(this).addClass('current-question');
                };
            });
        });
    }

    /* ------------------------------------------------------------ *\
       Testimonials Slider JS
    \* ------------------------------------------------------------ */
    var slideCount = $('#box-testimonials ul li').length;
    var slideWidth = $('#box-testimonials ul li').width();
    var slideHeight = $('#box-testimonials ul li').height();
    var sliderUlWidth = slideCount * slideWidth;
    $('#box-testimonials').css({ width: slideWidth, height: slideHeight });
    $('#box-testimonials ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
    $('#box-testimonials ul li:last-child').prependTo('#box-testimonials ul');
    function moveLeft() {
        $('#box-testimonials ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#box-testimonials ul li:last-child').prependTo('#box-testimonials ul');
            $('#box-testimonials ul').css('left', '');
        });
    };

    function moveRight() {
        $('#box-testimonials ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#box-testimonials ul li:first-child').appendTo('#box-testimonials ul');
            $('#box-testimonials ul').css('left', '');
        });
    };
    $('a.lotto_control_prev').click(function (e) {
        e.preventDefault()
        moveLeft();
    });
    $('a.lotto_control_next').click(function (e) {
        e.preventDefault()
        moveRight();
    });


    $('.top-menu li').mouseover(function(){
        if (! $(this).hasClass('show-dd')) {
            $('.nav_dropdown').hide();
        };
    });

    $(".playlottary ul li").on("click", function() {
        window.location = $(this).find(".dd_play_button").attr("href");
    });

    $('.lottary-play').mouseover(function(){
        $('.result_info').hide();
        $('.result_info .dropdown-menu').hide();
        $('.playlottary').show();
        $('.playlottary .dropdown-menu').show();
    });

    $('#menu-container').mouseleave(function(){
        $('.playlottary').hide();
    });

    $('.lottary-info').mouseover(function(){
        $('.playlottary').hide();
        $('.playlottary .dropdown-menu').hide();
        $('.result_info').show();
        $('.result_info .dropdown-menu').show();
    });

    $('#menu-container').mouseleave(function(){
        $('.result_info').hide();
    });
    $('.menu-item').prepend("<div class='menu-arrow'></div>")

    // Single number selection
    function selectSameExtraNumbers(id) {
        var divs = jQuery("#single").find(".select_num_col.selected");
        for (i = 0; i < divs.length; i++) {
            jQuery(divs[i]).find(".line").removeClass("extra_active");
            jQuery(divs[i]).find(".line").parent().find('#' + id).addClass("extra_active");
        }
    }

    // mobile autoclose on all numbers selected
    function triggerLineClose(numberContext, mainselected, extraselected) {
        var r = numbersSelectionRange();
        if (parseInt(mainselected) == r.m && parseInt(extraselected) == r.e) {
            var btn = $(numberContext).parent().parent().parent().parent().find('a.quickpic_close');
            setTimeout(function() {
                btn.click();
            }, 300);
        }
    }

    function numbersSelectionRange() {
        return {
            m: jQuery("#m1").val(),
            e: jQuery("#e1").val()
        };
    }

    function mainNumbersCheckForAutoclose(numberContext, rangeFunc) {
        var mainselected = jQuery(numberContext).parent().children(".main_active").length;
        var extraselected = jQuery(numberContext).parents(".select_num_col").find(".select_num_part_wrapper").find(".extra_active").length;
        triggerLineClose(numberContext, mainselected, extraselected);
    }

    function extraNumbersCheckForAutoclose(numberContext, rangeFunc) {
        var mainselected = jQuery(numberContext).parents(".select_num_col_part").find(".lt_numbers_wrapper").children(".main_active").length;
        var extraselected = jQuery(numberContext).parent().children(".extra_active").length;
        triggerLineClose(numberContext, mainselected, extraselected);
    }
 
    jQuery(document).on("click", ".lt_numbers_wrapper > span", function() {

        //needed in the mobile version
        if (jQuery(this).parent().hasClass('edit-lock')) {
            jQuery(this).parent().removeClass('edit-lock');
            // remove lock on extra numbers
            if (jQuery(this).parent().parent().parent().find('.select_num_part_wrapper').hasClass('edit-lock')) {
                jQuery(this).parent().parent().parent().find('.select_num_part_wrapper').removeClass('edit-lock');
            }
            //triger edit mode
            jQuery(this).parent().trigger('click');
        } else {

            var m1 = jQuery("#m1").val();
            var e1 = jQuery("#e1").val();

            var mainselected = jQuery(this).parent().children(".main_active").length;
            var extraselected = jQuery(this).parents(".select_num_col").find(".select_num_part_wrapper").find(".extra_active").length;


            if (parseInt(mainselected + 1) == m1 && parseInt(extraselected) == e1) {
                jQuery(this).parents(".select_num_col").addClass("selected");
                totalForSingle();
            }

            if (mainselected < m1) {
                if (jQuery(this).hasClass("main_active")) {
                    jQuery(this).removeClass("main_active");
                    jQuery(this).parents(".select_num_col").removeClass("selected");
                    totalForSingle();

                } else {
                    jQuery(this).addClass("main_active");
                }
            } else if (jQuery(this).hasClass("main_active")) {
                jQuery(this).removeClass("main_active");
                jQuery(this).parents(".select_num_col").removeClass("selected");
                totalForSingle();

            } else {
                return false;
            }

            if (isMobile) {
                mainNumbersCheckForAutoclose(this);
            }
        }
    });

    jQuery(document).on("click", ".select_num_part_wrapper > span", function() {

        //needed in the mobile version
        if (jQuery(this).parent().hasClass('edit-lock')) {
            jQuery(this).parent().removeClass('edit-lock');
            // remove lock on main numbers
            if (jQuery(this).parent().parent().parent().find('.lt_numbers_wrapper').hasClass('edit-lock')) {
                jQuery(this).parent().parent().parent().find('.lt_numbers_wrapper').removeClass('edit-lock');
            }

            //triger edit mode
            jQuery(this).parent().parent().parent().find('.all_num_part').trigger('click');

        } else {
            var m1 = jQuery("#m1").val();
            var e1 = jQuery("#e1").val();

            var mainselected = jQuery(this).parents(".select_num_col_part").find(".lt_numbers_wrapper").children(".main_active").length;
            var extraselected = jQuery(this).parent().children(".extra_active").length;

            var id = jQuery(this).attr("id");


            if (mainselected == m1 && parseInt(extraselected + 1) == e1) {
                jQuery(this).parents(".select_num_col").addClass("selected");
                totalForSingle();
            }

            if (extraselected < e1) {
                if (jQuery(this).hasClass("extra_active")) {
                    jQuery(this).removeClass("extra_active");
                    jQuery(this).parents(".select_num_col").removeClass("selected");
                    totalForSingle();

                } else {
                    jQuery(this).addClass("extra_active");
                    var lottery = jQuery("#otherdata").val().split('|');
                    if (lottery[1].toUpperCase() == "ELGORDO") {
                        selectSameExtraNumbers(id);
                    }

                }
            } else if (jQuery(this).hasClass("extra_active")) {
                jQuery(this).removeClass("extra_active");
                jQuery(this).parents(".select_num_col").removeClass("selected");
                totalForSingle();
            } else {
                return false;
            }

            if (isMobile) {
                extraNumbersCheckForAutoclose(this);
            }
        }
    });

    var picbtntrigger = 1;
    /* Select Random numbers */
    jQuery(document).on('click', '.quickpic_text', function() {

        jQuery(this).parents(".select_num_col").addClass("selected");
        jQuery(this).parents(".select_num_col_part").find(".lt_numbers_wrapper").children("span").removeAttr('class');
        jQuery(this).parents(".select_num_col_part").find(".select_num_part_wrapper").children("span").removeClass('extra_active');

        var m = jQuery("#m").val();
        var m1 = jQuery("#m1").val();
        var num = getRandomInt(m1, m);
        for (var i = 1; i <= num.length; i++) {
            var randomID = num[i];
            jQuery(this).parent().parent().find(".lt_numbers_wrapper").children("#" + randomID).addClass("main_active");
        }

        var e = jQuery("#e").val();
        var e1 = jQuery("#e1").val();

        var num1 = getRandomInt(e1, e);
        for (var i = 1; i <= num1.length; i++) {
            var megaball = num1[i];
            jQuery(this).parent().parent().find(".select_num_part_wrapper").children("#" + megaball).addClass("extra_active");
        }
        var lottery = jQuery("#otherdata").val().split('|');
        if (lottery[1].toUpperCase() == "ELGORDO") {
            selectSameExtraNumbers(num1[1]);
        }

        totalForSingle();

        //show/hide wattermark
        jQuery(".select_num_col").trigger("click");        
    });

    // Remove Selected numbers
    jQuery(document).on('click', '.quickpic_delete', function($) {

        //deletes the line in the mobile version
        if (jQuery(this).parent().parent().find('.lt_numbers_wrapper').hasClass('edit-lock')) {

                var deleteLine = jQuery('#lines').val() - 1;
                var minLines = jQuery('#minl').val()
                if ( deleteLine >= minLines) {

                    jQuery(this).parent().parent().parent('.select_num_col').remove();
                    jQuery(this).remove();

                    totalForSingle();
                    totalLineDelete();

                    jQuery('#lines').val(deleteLine);

                    linesNum = jQuery('#lines').val();
                        if (linesNum < 10) {
                            jQuery('.addline-more').show();
                        }
                    }
        } else {
            jQuery(this).parents(".select_num_col").removeClass("selected");

            jQuery(this).parents(".select_num_col_part").find(".lt_numbers_wrapper").children("span").removeAttr('class');
            jQuery(this).parents(".select_num_col_part").find(".select_num_part_wrapper").children("span").removeClass('extra_active');

            // Calculating total.
            totalForSingle();
            // end
        }
    });

    jQuery(".removelines").on('click', function() {
        var total_lines = jQuery("#totallines").val();

        jQuery("#totallines").val((parseInt(total_lines) - 1));
        jQuery(this).attr("id", (parseInt(total_lines) - 1));

        if (jQuery("#totallines").val() === '1') {
            jQuery(this).addClass('hide').removeAttr("id");
            jQuery(".addlines").show();
        }

        if (jQuery("#totallines").val() < 2) {
            jQuery(".addlines").show();
        }

        var row = jQuery(this).parents().find("#row_" + total_lines);
        // Remove element containing the option

        row.remove();

        // Calculating total.
        totalLineDelete();
        //end
    });

    // regular add line
    jQuery('.addlines').on('click', function() {

        var total_lines = 2;

        jQuery("#totallines").val(total_lines);

        if (jQuery("#totallines").val() == 2) {
            var template = jQuery('#removecardrow');
            template.clone()
                .removeClass('hide')
                .attr('id', "row_" + total_lines)
                .insertBefore(template)
                .addClass("cardline");
            jQuery('.addlines').hide();
            jQuery(".removelines").attr("id", total_lines).removeClass("hide");

        } else {
            var template = jQuery('#removecardrow');
            template.clone()
                .removeClass('hide')
                .attr('id', "row_" + total_lines)
                .insertBefore(template)
                .addClass("cardline");

            jQuery(".removelines").removeClass("hide").attr("id", (parseInt(total_lines) + 1));
        }
    });

    // adds five lines in mobile
    jQuery('.addline-more').on('click', function() {

        linesNum = jQuery('#lines').val();

        if (linesNum <= 10) {
            var total_lines = parseInt(jQuery("#totallines").val()) + 1;
            jQuery("#totallines").val(total_lines);



            var template = jQuery('#removecardrow');
            template.clone()
            .removeClass('hide')
            .attr('id', "row_" + total_lines)
            .insertBefore(template)
            .addClass("cardline");

            jQuery('#row_' + total_lines).find('.select_num_col').find('.select_num_col_part').find('.quickpic-mobile').find('.quickpic_text').trigger('click');
            linesNum = parseInt(linesNum) + 5;
            jQuery('#lines').val(linesNum);
        };

        if (linesNum >= 11) {
            nthElement = parseInt(linesNum) - 10;

            //deletes the lines more then 10
            do {

                jQuery('#row_' + total_lines).find('.select_num_col:nth-of-type('+ nthElement +')').find('.select_num_col_part').find('.quickpic-mobile').find('.quickpic_delete').trigger('click');
                nthElement = parseInt(nthElement) - 1;
            }
            while (nthElement > 0);

            }

        // hides the yellow button on too many lines
        if (linesNum >= 10) {
            jQuery('.addline-more').hide();
        }
    });

    // add one line in mobile
    jQuery('.addline-single').on('click', function() {

        //check lines number
        var linesNum = jQuery('#lines').val();
        console.log(linesNum + ' lines number now');

        if (linesNum <= 9) {
            //increment line numbers
            var newLinesNum = parseInt(linesNum) + 1;
            jQuery('#lines').val(newLinesNum);

            if (linesNum == 5) {

                var total_lines = 2;
                jQuery("#totallines").val(total_lines);

                if (jQuery("#totallines").val() == 2) {
                    var template = jQuery('#removecardrow');
                    template.clone()
                        .removeClass('hide')
                        .attr('id', "row_" + total_lines)
                        .insertBefore(template)
                        .addClass("cardline");

                    jQuery('#row_2').find('.select_num_col:nth-child(1)').find('.select_num_col_part').find('.quickpic-mobile').find('.quickpic_text').trigger('click');
                    console.log('5th');

                } else {
                    var template = jQuery('#removecardrow');
                    template.clone()
                        .removeClass('hide')
                        .attr('id', "row_" + total_lines)
                        .insertBefore(template)
                        .addClass("cardline");
                }
            }

            if (linesNum == 6) {
                jQuery('#row_2').find('.select_num_col:nth-child(2)').find('.select_num_col_part').find('.quickpic-mobile').find('.quickpic_text').trigger('click');
                console.log('6th');
                totalForSingle();
                getDataFromPaymentPage();
            }

            if (linesNum == 7) {
                jQuery('#row_2').find('.select_num_col:nth-child(3)').find('.select_num_col_part').find('.quickpic-mobile').find('.quickpic_text').trigger('click');
                console.log('7th');
                totalForSingle();
                getDataFromPaymentPage();
            }

            if (linesNum == 8) {
                jQuery('#row_2').find('.select_num_col:nth-child(4)').find('.select_num_col_part').find('.quickpic-mobile').find('.quickpic_text').trigger('click');
                console.log('8th');
                totalForSingle();
                getDataFromPaymentPage();
            }

            if (linesNum == 9) {
                jQuery('#row_2').find('.select_num_col:nth-child(5)').find('.select_num_col_part').find('.quickpic-mobile').find('.quickpic_text').trigger('click');
                console.log('9th');
                totalForSingle();
                getDataFromPaymentPage();
            }

        } else {
            $(this).hide();
        }
    });

    /*--------------------------------Quick pick all code start--------------*/

    jQuery(document).on('click', '.picall_btn', function() {
        var m = jQuery("#m").val();
        var m1 = jQuery("#m1").val();
        var e = jQuery("#e").val();
        var e1 = jQuery("#e1").val();
        var even = jQuery("#even").val();
        var minl = jQuery("#minl").val();
        var openLines = jQuery('.cardline').find(".select_num_col").length;

        var linesToAdd = minl;
        if(openLines == 10 && picbtntrigger <= 1){
            linesToAdd = 10;
        }

        if (minl > 5 && openLines < 10) {
            jQuery(".addlines ").trigger("click");
        }

        for (var i = 0; i < 4; i++) {
            setTimeout(function() {
                if(even > 0){
                    var index = 0;
                    jQuery('.cardline').find(".select_num_col").each(function (){
                        if(index < linesToAdd){
                            jQuery(this).addClass("selected");
                            jQuery(this).find(".lt_numbers_wrapper").children("span").removeAttr('class');
                            jQuery(this).find(".select_num_part_wrapper").children("span").removeClass('extra_active');
                            setNumbers(jQuery(this))
                        }
                        index++;
                    });
                } else {
                    jQuery('.cardline').find(".select_num_col").addClass("selected");
                    jQuery('.cardline').find(".select_num_col").each(function() {
                        jQuery(this).find(".lt_numbers_wrapper").children("span").removeAttr('class');
                        jQuery(this).find(".select_num_part_wrapper").children("span").removeClass('extra_active');
                        setNumbers(jQuery(this))
                    });
                }
            }, 150 * i);
        }
        function setNumbers(target){
            var num = getRandomInt(m1, m);
            for (var i = 1; i <= num.length; i++) {
                var randomID = num[i];

                target.find(".lt_numbers_wrapper").children("#" + randomID).addClass("main_active");
            }

            var num1 = getRandomInt(e1, e);
            for (var i = 1; i <= num1.length; i++) {
                var megaball = num1[i];

                target.find(".select_num_part_wrapper").children("#" + megaball).addClass("extra_active");
            }
            var lottery = jQuery("#otherdata").val().split('|');
            if (lottery[1].toUpperCase() == "ELGORDO") {
                selectSameExtraNumbers(num1[1]);
            }

            // Calculating total.
            totalForSingle();
        }
    });

    // Remove Selected numbers
    jQuery(document).on('click', '.clearall_btn', function() {
        clearTotal();

    });
    /*--------------------------------Quick pick all code End--------------*/

    /*--------------------------------tab js start------------------------*/
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }

    jQuery('#main-nav > li > a').click(function(event) {

        event.preventDefault(); //stop browser to take action for clicked anchor

        //get displaying tab content jQuery selector
        var active_tab_selector = jQuery('#main-nav > li.current > a').attr('href');
        var active_tab_selector_single = jQuery('#main-nav > li.home > a').attr('href');
        var currentVal = parseInt(jQuery("#group").find('input[name=quantity]').val());

        //find actived navigation and remove 'active' css
        var actived_nav = jQuery('#main-nav > li.home');
        actived_nav.removeClass('active_li');
        //refactored by Georgi D.
        jQuery('#choosenTab').val(this.hash);

        sessionStorage.setItem('choosenTab', this.hash);
        var actived_nav_single = jQuery('#main-nav > li.current');
        actived_nav_single.removeClass('active_li');

        //add 'active' css into clicked navigation
        jQuery(this).parents('li').addClass('active_li');

        //hide displaying tab content
        jQuery(active_tab_selector_single).removeClass('active');
        jQuery(active_tab_selector_single).addClass('hide');

        jQuery(active_tab_selector).removeClass('active');
        jQuery(active_tab_selector).addClass('hide');

        //show target tab content
        var target_tab_selector = $(this).attr('href');

        jQuery(target_tab_selector).removeClass('hide');
        jQuery(target_tab_selector).addClass('active');
        totalForGroup(currentVal);

    });
    /*--------------------------------tab js end------------------------*/

    /*--------------------------------For Qty increase Start------------------
     * This button will increment the value
     * */
    jQuery('.qtyplus').click(function(e) {

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = jQuery(this).attr('field');

        var inputObj = jQuery('input[name=' + fieldName + ']');
        // Get its current value
        var currentVal = parseInt(jQuery('input[name=' + fieldName + ']').val());

        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            currentVal = currentVal + 1;
            if (currentVal > 150) {
                currentVal = 150;
            }
            inputObj.val(currentVal);
        } else {
            // Otherwise put a 0 there
            currentVal = 1;
            inputObj.val(1);
        }
        totalForGroup(currentVal);
    });

    /* This button will decrement the value upto 1 */
    jQuery(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = jQuery(this).attr('field');
        // Get its current value
        var currentVal = parseInt(jQuery('input[name=' + fieldName + ']').val());

        var inputObj = jQuery('input[name=' + fieldName + ']');

        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one
            currentVal = currentVal - 1;
            //inputObj.attr("value", currentVal);
            inputObj.val(currentVal);
        } else {
            // Otherwise put a 0 there
            currentVal = 1;
            inputObj.val(1);
        }

        totalForGroup(currentVal);
    });

    jQuery("input[name=quantity]").on("keyup", function() {
        this.value = this.value.replace(/[^0-9]/g, '');

        if( this.value.charAt( 0 ) === '0' ) {
            this.value = this.value.slice( 1 );
        }

        if (this.value == 0) {
            this.value = 1;
        }
        if (this.value > 150) {
            this.value = 150;
        }
        if (this.value >= 1) {
            totalForGroup(this.value);
        }
    });
    /*--------------------------------For Qty increase End------------------*/

    // Draw Option Check.
    jQuery("#single").find(".radGroup1").click(function() {
        jQuery("#single").find("input[name=single_drawop]").removeAttr("checked");
        var id = jQuery(this).attr("for");
        jQuery("#single").find("#" + id).attr("checked", "checked");

        var stp = jQuery("#stp").val();

        var totalcard = jQuery('.cardline').find(".selected").length;

        var stp1 = parseFloat(stp * totalcard).toFixed(2);

        CalculateRadioButonsChangesSingle(stp1, id, totalcard);

    });

    jQuery("#group").find(".radGroup1").click(function() {
        var lottery = jQuery("#otherdata").val().split("|");
        jQuery("#group").find("input[name=group_drawop]").removeAttr("checked");
        var id = jQuery(this).attr("for");
        jQuery("#group").find("#" + id).attr("checked", "checked");

        var currentVal = parseInt(jQuery("#group").find('input[name=quantity]').val());
        var gtp = jQuery("#gtp").val();
        var gtp1 = parseFloat(gtp * currentVal).toFixed(2);

        jQuery("#group").find(".shares").html(currentVal + " Shares");

        if (id === 'grpradio1') {
            jQuery("#group").find(".draws").html(object_name.one_draws);
            jQuery("#group").find(".subtotal").html(gtp1);
            jQuery("#group").find(".bonusmoney").html(gtp1);
            jQuery("#group").find(".totalprice").html(gtp1);
            DiscountCounter(1, gtp1, 1, "group");

        }

        if (id === 'grpradio2') {
            var draws = jQuery("#group").find(".group_totaldraw option:selected").val();
            jQuery("#group").find(".draws").html(draws + " " + object_name.draws);
            jQuery("#group").find(".subtotal").html(parseFloat(gtp1 * draws).toFixed(2));
            DiscountCounter(draws, gtp1, 1, "group");

        }

        if (id === 'grpradio3') {
            var draws = num_of_draws_group_per_week[lottery[1].toUpperCase()];
            var weeks = jQuery("#group").find(".group_subs option:selected").val();
            jQuery("#group").find(".draws").html(parseInt(draws * weeks) + " " + object_name.draws);
            jQuery("#group").find(".subtotal").html(parseFloat(gtp1 * draws * weeks).toFixed(2));
            DiscountCounter(draws, gtp1, weeks, "group");
        }
    });

    // Single MultiDraw.
    jQuery("#single").find(".single_totaldraw").on("change", function() {
        jQuery("#single").find("input[name=single_drawop]").removeAttr("checked");
        jQuery(this).parents(".col3").find(".radGroup1").trigger("click");


        var stp = jQuery("#stp").val();
        var totalcard = jQuery('.cardline').find(".selected").length;
        var stp1 = parseFloat(stp * totalcard).toFixed(2);
        var draws = jQuery(this).val();
        jQuery("#single").find(".subtotal").html(parseFloat(draws * stp1).toFixed(2));
        jQuery("#single").find(".draws").html(draws + " " + object_name.draws);
        DiscountCounter(draws, stp1, 1, "single");
    });

    // Single Subscription
    jQuery("#single").find(".single_subs").on("change", function() {
        jQuery("#single").find("input[name=single_drawop]").removeAttr("checked");
        jQuery(this).parents(".col3").find(".radGroup1").trigger("click");
        jQuery(this).children().removeAttr('class');
        jQuery(this.selectedOptions).addClass('selected');
        // changing minl according to lottery.
        var lottery = jQuery("#otherdata").val().split("|");

        if (jQuery("#minl").attr('data-old') != undefined) {
            jQuery("#minl").val(jQuery("#minl").attr('data-old'));
        }

        var stp = jQuery("#stp").val();
        var totalcard = jQuery('.cardline').find(".selected").length;
        var stp1 = parseFloat(stp * totalcard).toFixed(2);

        var draws = num_of_draws_group_per_week[lottery[1].toUpperCase()];
        var weeks = jQuery(this).val();

        jQuery("#single").find(".subtotal").html(parseFloat(draws * weeks * stp1).toFixed(2));

        jQuery("#single").find(".draws").html(parseInt(draws * weeks) + " " + object_name.draws);
        DiscountCounter(draws, stp1, weeks, "single");
    });

    // Group MultiDraw.
    jQuery("#group").find(".group_totaldraw").on("change", function() {
        jQuery("#group").find("input[name=group_drawop]").removeAttr("checked");
        jQuery(this).parents(".col3").find(".radGroup1").trigger("click");

        var currentVal = parseInt(jQuery("#group").find('input[name=quantity]').val());
        var lottery = jQuery("#otherdata").val().split("|");
        var gtp = jQuery("#gtp").val();
        var gtp1 = parseFloat(gtp * currentVal).toFixed(2);
        var draws = jQuery(this).val();
        jQuery("#group").find(".draws").html(draws + " " + object_name.draws);
        jQuery("#group").find(".subtotal").html(parseFloat(gtp1 * draws).toFixed(2));
        DiscountCounter(draws, gtp1, 1, "group");
    });

    // Group Subscription
    jQuery("#group").find(".group_subs").on("change", function() {
        var lottery = jQuery("#otherdata").val().split("|");
        jQuery("#group").find("input[name=group_drawop]").removeAttr("checked");
        jQuery(this).parents(".col3").find(".radGroup1").trigger("click");
        jQuery(this.selectedOptions).addClass('selected');
        var currentVal = parseInt(jQuery("#group").find('input[name=quantity]').val());

        var gtp = jQuery("#gtp").val();
        var gtp1 = parseFloat(gtp * currentVal).toFixed(2);
        var lottery = jQuery("#otherdata").val().split("|");
        var draws = num_of_draws_group_per_week[lottery[1].toUpperCase()];
        var weeks = jQuery(this).val();

        jQuery("#group").find(".shares").html(currentVal + " Shares");
        jQuery("#group").find(".draws").html(parseInt(draws * weeks) + " " + object_name.draws);
        jQuery("#group").find(".subtotal").html(parseFloat(gtp1 * draws * weeks).toFixed(2));
        DiscountCounter(draws, gtp1, weeks, "group");
    });

    // Forgot password
    jQuery(".forgotpass").click(function() {
        $('.signin_error').empty();
        if (jQuery(".forgotemaildisp").hasClass("open")) {
            jQuery(".forgotemaildisp").removeClass("open");
            jQuery(".forgotemaildisp").addClass("close");
            jQuery(".forgot_submit").hide();
            jQuery(".signin_submit").show();
            jQuery("#signin").find("input[name=email]").focus();

        } else {
            jQuery(".forgotemaildisp").removeClass("close");
            jQuery(".forgotemaildisp").addClass("open");
            jQuery(".forgotemaildisp").children(".email_field").focus();
            jQuery(".forgot_submit").show();
            jQuery(".signin_submit").hide();
        }

        jQuery(".forgotemaildisp").toggle();
    });

    jQuery(".forgot_submit").click(function() {
        var email = jQuery("#signin").find("input[name=forgotemail]");
        email.val(email.val().trim());


        var checkresp = validateForgotPassword();
        if (checkresp) {
            $(".hidesigninloader").show();

            var datastring = "action=lottery_data&m=userinfo/get-personal-details-by-email&email=" + email.val();

            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                dataType: 'json',
                success: function(data) {
                    $(".hidesigninloader").hide();

                    var resp;

                    if (data.error_msg != undefined) {
                        resp = lottoMsgTranslate(data.error_msg);
                    } else if(data.msg != undefined){
                        resp = lottoMsgTranslate(data.msg)
                    }

                    //$('.signin_error').empty();
                    jQuery("#signin").find(".signup_error").html(resp);
                }
            });
        }
    });
    //    Signup
    jQuery(".signup_submit").click(function() {
        //debugger;
        var error = jQuery("#signup").find(".signup_error");
        var checkresp = validateSignup();
        var fullName = jQuery("#signup-fullname").val();

        if (fullName.length) {
            var fullnameSplited = fullName.split(" ");
            var firstname = (fullnameSplited[0] != undefined) ? fullnameSplited[0] : '';
            var lastname = (fullnameSplited[1] != undefined) ? fullnameSplited[1] : '';
        }
        $("input[name=firstname]").val(firstname);
        $("input[name=lastname]").val(lastname);

        var email = jQuery("#signup-email");
        email.val(email.val().trim());

        var formdata = jQuery("#signup").serialize();
        var datastring = "action=lottery_data&m=userinfo/signup&" + formdata;

        if (checkresp) {
            jQuery(".hidesignuploader").show();
            error.html("");
            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                dataType: 'json',
                success: function(data) {
                    //debugger;
                    jQuery(".hidesignuploader").hide();
                    var resp;

                    if (data.error_msg != undefined) {
                        resp = lottoMsgTranslate(data.error_msg);
                        error.html(resp)
                        return false;
                    } else if(data.msg != undefined){
                        resp = lottoMsgTranslate(data.msg)
                    }

                    if (data.MemberId !== "") {
                        error.html(object_name.youve_successfully_registered)

                        activateFirePixel(resp);

                        setTimeout(function() {
                         if ($('.p_signin').length) {
                             if (jQuery("#productid").val() == 15 || jQuery("#productid").val() == 24 || jQuery("#productid").val() == 26) {
                                 insertNavidadNumbers(jQuery("#selno").val(), jQuery("#productid").val());
                             } else {
                                 if (jQuery("#cardselection").val() === 'card') {
                                     cardProduct();
                                 }

                                 if (jQuery("#cardselection").val() === 'share') {
                                     groupProduct();
                                 }
                             }
                         } else {
                             window.location.reload(true);
                         }
                     }, 500);
                    }
                }
            });
        }
    });

/*    jQuery(".update_submit").click(function() {

        var fullname = $("#update-personal-details").find('input[name="full_name"]').val();
        var phone = $("#update-personal-details").find('input[name="phone"]').val();

        var error = jQuery("#update-personal-details").find(".signup_error");
        var checkresp = validateSignupStep2();

        if (checkresp) {

            if (fullname.length) {
                var fullnameSplited = fullname.split(" ");
                var firstname = (fullnameSplited[0] != undefined) ? fullnameSplited[0] : '';
                var lastname = (fullnameSplited[1] != undefined) ? fullnameSplited[1] : '';
            }

            var formdata   = $("#update-personal-details").serialize();
            var datastring = "action=lottery_data&m=userinfo/update-personal-details&first_name="+firstname+"&last_name="+lastname+"&"+formdata;

            jQuery(".hidesignuploader").show();
            error.html("");
            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                dataType: 'json',
                success: function(data) {
                    var resp;

                    if (data.error_msg != undefined) {
                        resp = lottoMsgTranslate(data.error_msg);
                    } else if(data.msg != undefined){
                        resp = lottoMsgTranslate(data.msg)
                    }

                    jQuery(".hidesignuploader").hide();
                    error.html(resp);
                    window.location.reload(true);
                }
            });
        }
    });*/

    // refresh balance
    jQuery(document).on("refresh_balance", function() {
        getUserBalance(function() {
            //window.location.reload(true); console.log("trigger");
        });
    });

    // sets src on iframe
    setFirePixel();

    function setFirePixel() {
        if (sessionStorage && sessionStorage.firePixel && sessionStorage.firePixel !== "") {
            jQuery("#dynamic_fire_pixel").prop('src', sessionStorage.firePixel);
            //console.log(sessionStorage.firePixel);
            sessionStorage.firePixel = "";
        }
    }

    function activateFirePixel(signupResponse) {
        if (signupResponse && signupResponse.MemberId && signupResponse.MemberId !== "") {
            var pixel_url = "https://go.lotterymaster.com/dynamicpixels/LeadRegistered/?userId=" + signupResponse.MemberId + "&IsoCountry=" + signupResponse.CountryCode;
            if (sessionStorage) {
                sessionStorage.firePixel = pixel_url;
            }
        }
    }

    function getUserBalance(callback) {
        var datastring = "action=lottery_data&m=userinfo/get-member-money-balance";
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            success: function(data) {
                if (callback && typeof callback === "function") {
                    callback();
                }
            }
        });
    }

    // Signin
    jQuery(".signin_submit").click(function() {
        console.log("Form Submited");
        var email = jQuery("#signin").find("input[name=email]");
        email.val(email.val().trim());

        var formdata = jQuery("#signin").serialize();
        var datastring = "action=lottery_data&m=userinfo/login&" + formdata;
        var error = jQuery("#signin").find(".signin_error");
        var checkresp = validateLogin();

        if (checkresp) {
            jQuery(".hidesigninloader").show();
            error.html("");
            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                dataType: 'json',
                success: function(data) {
                    jQuery(".hidesigninloader").hide();
                    var resp;

                    if (data.error_msg != undefined) {
                        if (data.error_msg == "Login failed") {
                            resp = lottoMsgTranslate(object_name.email_and_password_miss_match_or_does_not_exists);
                            error.html(resp)
                            return false;
                        } else {
                            resp = lottoMsgTranslate(data.error_msg);
                            error.html(resp)
                            return false;
                        }
                    } else if(data.msg != undefined){
                        resp = lottoMsgTranslate(data.msg)
                    }

                    if (data.MemberId != "") {
                        error.html(object_name.youve_successfully_logged_in);
                        setTimeout(function() {
                            if ($('.p_signin').length) {
                                if (jQuery("#productid").val() == 15 || jQuery("#productid").val() == 24 || jQuery("#productid").val() == 26) {
                                    insertNavidadNumbers(jQuery("#selno").val(), jQuery("#productid").val());
                                } else {
                                    if (jQuery("#cardselection").val() === 'card') {
                                        cardProduct();
                                    }

                                    if (jQuery("#cardselection").val() === 'share') {
                                        groupProduct();
                                    }
                                }
                            } else {
                                window.location.reload(true);
                            }
                        }, 500);
                    }
                }
            });
        }
    });

    // Payment Signin
    jQuery(".p_signin").click(function() {
        var email = jQuery("#signinform").find("input[name=email]");
        email.val(email.val().trim());

        var formdata = jQuery("#signinform").serialize();
        var datastring = "action=lottery_data&m=userinfo/login&" + formdata;
        var error = jQuery("#signinform").find(".signin_error");
        var checkresp = validatepLogin();

        if (checkresp) {
            jQuery(".hidesigninloader").show();
            error.html("");
            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                dataType: 'json',
                success: function(data) {
                    jQuery(".hidesigninloader").hide();
                    var resp;

                    if (data.error_msg != undefined) {
                        if (data.error_msg == "Login failed") {
                            resp = lottoMsgTranslate(object_name.email_and_password_miss_match_or_does_not_exists);
                            error.html(resp)
                            return false;
                        } else if(data.error_msg == "'Email' is not a valid email address.") {
                            error.html(object_name.email_address_is_not_valid);
                            return false;
                        } else {
                            resp = lottoMsgTranslate(data.error_msg);
                            error.html(resp)
                            return false;
                        }
                    } else if(data.msg != undefined){
                        resp = lottoMsgTranslate(data.msg)
                    }

                    if (data.MemberId !== "") {
                        error.html(object_name.youve_successfully_logged_in);

                        //getUserBalance();

                        setTimeout(function() {
                            if ($('.p_signin').length) {
                                if (jQuery("#productid").val() == 15 || jQuery("#productid").val() == 24 || jQuery("#productid").val() == 26) {
                                    insertNavidadNumbers(jQuery("#selno").val(), jQuery("#productid").val());
                                } else {
                                    if (jQuery("#cardselection").val() === 'card') {
                                        cardProduct();
                                    }

                                    if (jQuery("#cardselection").val() === 'share') {
                                        groupProduct();
                                    }
                                }
                            } else {
                                window.location.reload(true);
                            }
                        }, 500);
                    }
                }
            });
        }
    });
 jQuery("#sigininformForgetPassword").click(function() {
        //first part

        var email = jQuery("#signinform").find("input[name=forgotemail]").show().focus();
        var signInbuttin = jQuery("#signinform").find("input[name=singIn]").hide();
        var submitButton = jQuery("#signinform").find("input[name=submitForgotPass]").show();

        submitButton.click(function() {
            var email = jQuery("#signinform").find("input[name=forgotemail]");
            email.val(email.val().trim());
            var error = jQuery("#signinform").find(".signin_error");

            var checkresp = validateForgotPasswordWithObj(email.val(), error);

            if (checkresp) {
                var datastring = "action=lottery_data&m=userinfo/get-personal-details-by-email&email=" + email.val();

                jQuery.ajax({
                    type: "POST",
                    url: CONFIG.adminURL,
                    data: datastring,
                    dataType: 'json',
                    success: function(data) {
                        var resp;

                        if (data.error_msg != undefined) {
                            resp = lottoMsgTranslate(data.error_msg);
                        } else if(data.msg != undefined){
                            resp = lottoMsgTranslate(data.msg)
                        }

                        error.html(resp)
                    }
                });
            }
        });
    });
    jQuery(".p_signup").click(function() {
        var email = jQuery("#signupform").find('input[name=email]')
        email.val(email.val().trim());

        var formdata = jQuery("#signupform").serialize();
        var datastring = "action=lottery_data&m=userinfo/signup&" + formdata;
        var error = jQuery("#signupform").find(".signup_error");
        var checkresp = validatepSignup();

        if (checkresp) {
            jQuery(".hidesignuploader").show();
            error.html("");
            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                dataType: 'json',
                success: function(data) {
                    jQuery(".hidesignuploader").hide();
                    var resp;

                    if (data.error_msg != undefined) {
                        resp = lottoMsgTranslate(data.error_msg);
                        error.html(resp)
                        return false;
                    } else if(data.msg != undefined){
                        resp = lottoMsgTranslate(data.msg)
                    }

                    if (data.MemberId !== "") {
                        error.html(object_name.youve_successfully_logged_in);
                        //getUserBalance();
                        setTimeout(function() {
                            //debugger;
                            if (jQuery("#productid").val() == 15 || jQuery("#productid").val() == 24 || jQuery("#productid").val() == 26) {
                                insertNavidadNumbers(jQuery("#selno").val(), jQuery("#productid").val());
                            } else {
                                if (jQuery("#cardselection").val() === 'card') {
                                    cardProduct();
                                }

                                if (jQuery("#cardselection").val() === 'share') {
                                    groupProduct();
                                }
                            }
                        }, 500);
                    }
                }
            });
        }
    });
    /* registration*/

    jQuery(".register_button").click(function() {
        var email = jQuery("#registeration").find('input[name=email]')
        email.val(email.val().trim());

        var formdata = jQuery("#registeration").serialize();
        var datastring = "action=lottery_data&m=userinfo/signup&" + formdata;
        var error = jQuery("#registeration").find(".registeration_error");
        var checkresp = validateRegistration();

        if (checkresp) {
            jQuery(".hidesignuploader").show();
            error.html("");
            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                dataType: 'json',
                success: function(data) {
                    jQuery(".hidesignuploader").hide();

                    var resp;

                    if (data.error_msg != undefined) {
                        resp = lottoMsgTranslate(data.error_msg);
                        error.html(resp)
                        return false;
                    } else if(data.msg != undefined){
                        resp = lottoMsgTranslate(data.msg)
                    }

                    if (resp.MemberId !== "") {
                        error.html(object_name.youve_successfully_registered_please_check_your_mail);
                        activateFirePixel(resp);
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 500);
                    }
                }
            });
        }
    });

    // FB Login
    jQuery(".fblogin").click(function() {
        FBLogin();
    });

    // Single Continue
    /*jQuery("#single_continue").click(function() {
        var lines = jQuery(".cardline").find(".selected").length;
        var minl = jQuery("#minl").val();
        var maxl = jQuery("#maxl").val();
        var even = jQuery("#even").val();

        if (lines === 0 || lines < minl) {

            if (minl > 5) {

                var divs = jQuery("#row_1").find(".select_num_col");
                for (var i = 0; i < divs.length; i++) {
                    jQuery(divs[i]).find(".quickpic_text").trigger("click");
                }

                var leftline = parseInt(minl) - parseInt(jQuery(".cardline").find(".selected").length);

                jQuery(".addlines").trigger("click");

                var divs1 = jQuery("#row_2").find(".select_num_col");
                for (var j = 0; j < leftline; j++) {
                    jQuery(divs1[j]).find(".quickpic_text").trigger("click");
                }

            } else {
                var divs = jQuery("#row_1").find(".select_num_col").not(".selected");


                for (var i = 0; i < parseInt(minl) - lines; i++) {
                    jQuery(divs[i]).find(".quickpic_text").trigger("click");
                }
            }

            var lines = jQuery(".cardline").find(".selected").length;
        } else if (even > 0 && lines % 2 !== 0 && lines > minl) {
            jQuery(".cardline").find(".selected").last().find('.quickpic_delete').trigger('click');
            lines--;
        }


        if (lines >= minl && lines <= maxl) {
            var singbm = jQuery("#single").find(".bonusmoney").html();
            var singsubtp = jQuery("#single").find(".subtotal").html();
            var singtp = jQuery("#single").find(".totalprice").html();

            var selno = "";
            var newarr = "";
            jQuery(".cardline").find(".selected").each(function() {
                var row = jQuery(this).parents(".cardline").attr("id");
                var cardnum = jQuery(this).index();
                var option_all = jQuery(this).find(".main_active").map(function() {
                    return jQuery(this).text();
                }).get().join();

                var option_all1 = jQuery(this).find(".extra_active").map(function() {
                    return jQuery(this).text();
                }).get().join();

                if (option_all1.length > 0) {
                    selno += option_all + "#" + option_all1 + "|";
                    newarr += row + "-" + cardnum + "=>" + option_all + "#" + option_all1 + "|";
                } else {
                    selno += option_all + "#|";
                    newarr += row + "-" + cardnum + "=>" + option_all + "#|";
                }

            });

            jQuery("#storeselected").val(newarr);
            jQuery("#lines").val(lines);
            jQuery("#selno").val(selno);
            jQuery("#singbm").val(singbm);
            jQuery("#singsubtp").val(singsubtp);
            jQuery("#singtp").val(singtp);

            var otherdata = jQuery("#otherdata").val();
            var formdata = jQuery("#singledata").serialize();
            var datastring = "action=lottery_data&m=playlottery/insert-members-products-with-draws&" + formdata;

            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                dataType: "JSON",
                success: function(resp) {
                    if (resp.ProductManagementCounter > 0) {
                        var otherDataArray = otherdata.split('|');
                        otherdata = otherDataArray[0] + '|' + otherDataArray[1] + '|0|' + resp.ProductManagementCounter + '|false';
                        jQuery("#otherdata").val(otherdata);
                    }
                    setTimeout(function() {
                        document.forms['singledata'].submit();
                    }, 200);
                },
                error: function() {
                    // it's error if you are not logged in, but you have to be redirected -> form must be sent to payment
                    setTimeout(function() {
                        document.forms['singledata'].submit();
                    }, 200);
                }
            });
        } else {

            //adds 5 more lines
            jQuery('.addline-more').trigger('click');

            //triggers submit btn
            jQuery('#single_continue').trigger('click');
        }
    });*/


    jQuery(".error-close").click(function() {
        jQuery(this).parent().addClass("hide");
        jQuery("#errorbox").html("");
    });

    jQuery("#group_continue").click(function() {
        var grpbm = jQuery("#group").find(".bonusmoney").html();
        var grpsubtp = jQuery("#group").find(".subtotal").html();
        var grptp = jQuery("#group").find(".totalprice").html();

        jQuery("#grpbm").val(grpbm);
        jQuery("#grpsubtp").val(grpsubtp);
        jQuery("#grptp").val(grptp);
        var otherdata = jQuery("#groupdata").find("#otherdata").val();

        var formdata = jQuery("#groupdata").serialize();

        var datastring = "action=lottery_data&m=playlottery/insert-members-groups&" + formdata;

        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            dataType: "JSON",
            success: function(resp) {
                //console.log(resp);
                if (resp.ProductManagementCounter > 0) {
                    var otherDataArray = otherdata.split('|');
                    //debugger;
                    otherdata = otherDataArray[0] + '|' + otherDataArray[1] + '|0|' + resp.ProductManagementCounter + '|true';
                    jQuery("#groupdata").find("#otherdata").val(otherdata);
                }

                setTimeout(function() {
                    document.forms['groupdata'].submit();
                }, 200);
            }
        });
    });

    /*--------------------------------Myaccount Page Change password--------------*/
    jQuery(".u_changepassword").click(function() {
        jQuery(".change_pass").toggle("blind");
    });

    jQuery('#horizontalTab').responsiveTabs({
        rotate: false,
        startCollapsed: 'accordion',
        collapsible: 'accordion',
        setHash: true,
        activate: function(e, tab) {
            jQuery('.info').html(object_name.tab + ' <strong>' + tab.id + '</strong> ' + object_name.activated);
        },
        activateState: function(e, state) {
            //console.log(state);
            jQuery('.info').html(object_name.switched_from + ' <strong>' + state.oldState + '</strong> ' + object_name.state_to + ' <strong>' + state.newState + '</strong> ' + object_name.state);
        }
    });

    jQuery('#start-rotation').on('click', function() {
        jQuery('#horizontalTab').responsiveTabs('startRotation', 1000);
        jQuery('#horizontalTab').responsiveTabs('active');
    });
    jQuery('#stop-rotation').on('click', function() {
        jQuery('#horizontalTab').responsiveTabs('stopRotation');
    });
    jQuery('.select-tab').on('click', function() {
        jQuery('#horizontalTab').responsiveTabs('activate', jQuery(this).val());
    });

    /*******************************************
    *
    * My Account JS
    *
    *******************************************/
    jQuery(".macloader").hide();

    jQuery("#myaccount_update").click(function() {
        var email = jQuery("#myaccount_detail").find('input[name=email]')
        email.val(email.val().trim());

        var formdata = jQuery("#myaccount_detail").serialize();
        //console.log(formdata);

        var datastring = "action=lottery_data&m=userinfo/update-personal-details&" + formdata;
        var error = jQuery("#signup").find(".signup_error");

        if (error) {
            jQuery("html, body").animate({
                scrollTop: 0
            }, "slow");
        }

        var checkresp = validateMyaccount();
        if (checkresp) {

            error.html("");
            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                dataType: 'json',
                success: function(data) {
                    var resp;

                    if (data.error_msg != undefined) {
                        resp = lottoMsgTranslate(data.error_msg);
                        jQuery('.myaccount_detail_error').html(resp)
                        return false;
                    } else if(data.Result != undefined){
                        resp = lottoMsgTranslate(data.Result)
                        jQuery('.myaccount_detail_error').html(resp);
                        window.location.reload(true);
                    }
                }
            });
        }
    });

    function validateMyaccount() {
        var email = jQuery("#myaccount_detail").find("input[name=email]");
        var first_name = jQuery("#myaccount_detail").find("input[name=first_name]");
        var last_name = jQuery("#myaccount_detail").find("input[name=last_name]");
        var country = jQuery("#myaccount_detail").find("input[name=country]");
        var city = jQuery("#myaccount_detail").find("input[name=city]");
        var address = jQuery("#myaccount_detail").find("input[name=address]");
        var zipcode = jQuery("#myaccount_detail").find("input[name=zipcode]");
        //            var state = jQuery("#myaccount_detail").find("input[name=state]");
        var phone = jQuery("#myaccount_detail").find("input[name=phone]");
        var mobno = jQuery("#myaccount_detail").find("input[name=mobno]");
        var error = jQuery("#myaccount_detail").find(".myaccount_detail_error");

        var emailReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        var numericReg = /^([0-9]{6,14})+$/;
        var numeric = /^([0-9])+$/;
        var phoneReg = /^\+?[0-9 \-()]{6,25}$/;
        var nameReg  = /^[-'a-zA-Z]+$/;
        //var numericReg = /^\+(?:[0-9] ?){6,14}[0-9]$/;

        if (jQuery.trim(first_name.val()) === '') {
            error.html(object_name.first_name_should_not_be_empty + " ");
            return false;
        } else if (!nameReg.test(jQuery.trim(first_name.val()))) {
            error.html(object_name.first_name_is_invalid);
            return false;
        } else if (jQuery.trim(last_name.val()) != '' && !nameReg.test(jQuery.trim(last_name.val()))) {
            error.html(object_name.last_name_is_invalid);
            return false;
        } else if (jQuery.trim(email.val()) === '') {
            error.html(object_name.email_should_not_be_empty);
            return false;
        // } else if (jQuery.trim(phone.val()) === '') {
            // error.html(object_name.phone_number_should_not_be_empty);
            // return false;
        } else if (jQuery.trim(email.val()) !== "" && !emailReg.test(jQuery.trim(email.val()))) {
            error.html(object_name.email_address_is_not_valid);
            return false;
        } else if (jQuery.trim(zipcode.val()) !== "" && !numeric.test(jQuery.trim(zipcode.val()))) {
            error.html(object_name.zipcode_should_contain_only_digits);
            return false;
        } else if (jQuery.trim(phone.val()) !== "" && !phoneReg.test(jQuery.trim(phone.val()))) {
            error.html(object_name.phone_one_is_invalid);
            return false;
        } else if (jQuery.trim(mobno.val()) !== "" && !phoneReg.test(jQuery.trim(mobno.val()))) {
            error.html(object_name.phone_two_is_invalid);
            return false;
        } else {
            return true;
        }
    }
    /*---------------------------------------validation for password-------------------*/
    jQuery("#change_password").click(function() {
        var checkpassword = validatepassword();
        var email = jQuery("#email");
        email.val(email.val().trim());

        var password = jQuery("#newpassword").val();
        var oldpassword = jQuery("#oldpassword").val();
        var datastring = "action=lottery_data&m=userinfo/update-password&email=" + email.val() + "&password=" + password + "&oldpassword=" + oldpassword;

        if (checkpassword) {

            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                dataType: "json",
                success: function(data) {

                    var message = data.Result;
                    if (message === undefined) {
                        message = data;
                    }
                    jQuery("#myaccount_detail").find(".myaccount_detail_error").html(message);
                }
            });
        }

        function validatepassword() {

            var oldpassword = jQuery("#myaccount_detail").find("input[name=oldpassword]");
            var newpassword = jQuery("#myaccount_detail").find("input[name=newpassword]");
            var retypepassword = jQuery("#myaccount_detail").find("input[name=retypepassword]");
            var error = jQuery("#myaccount_detail").find(".myaccount_detail_error");

            if (error) {
                jQuery("html, body").animate({
                    scrollTop: 0
                }, "slow");

            }

            if (jQuery.trim(oldpassword.val()) === '' && jQuery.trim(newpassword.val()) === '' && jQuery.trim(retypepassword.val()) === '') {
                error.html(object_name.all_password_fields_are_mandatory);
                return false;
            } else if (jQuery.trim(oldpassword.val()) === '') {
                error.html(object_name.old_password_should_not_be_empty);
                return false;
            } else if (jQuery.trim(newpassword.val()) === '') {
                error.html(object_name.new_password_should_not_be_empty);
                return false;
            } else if (jQuery.trim(retypepassword.val()) === '') {
                error.html(object_name.retype_password_should_not_be_empty);
                return false;
            } else if (jQuery.trim(newpassword.val().length) < 7 || jQuery.trim(newpassword.val().length) > 20) {
                error.html(object_name.new_password_must_be_between_number_and_number_characters);
                return false;
            } else if (jQuery.trim(retypepassword.val().length) < 7 || jQuery.trim(retypepassword.val().length) > 20) {
                error.html(object_name.retype_password_must_be_between_number_and_number_characters);
                return false;
            } else if (jQuery.trim(newpassword.val()) != jQuery.trim(retypepassword.val())) {
                error.html(object_name.new_password_and_retype_password_does_not_match);
                return false;
            } else {
                return true;
            }
        }
    });
    jQuery(".meter > span").each(function () {
        jQuery(this).data("origWidth", perc)
        .width(0)
        .animate({
            width: jQuery(this).data("origWidth")
        }, 1200);
    });

    $('#horizontalTab ul li a').click(function(e){
        e.preventDefault();
        $('.r_tabs').hide();
        var current_tab = $(this).attr("data");
        $('#'+current_tab).show();
    });

    jQuery("#my_payments_detail").click(function() {
        var datastring = "action=lottery_data&m=userinfo/get-credit-card-methods-by-memberid";
        jQuery(".macloader").show();
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            success: function(data) {

                jQuery(".macloader").hide();
                jQuery("#mypayment_method").html('');
                jQuery("#mypayment_method").html(data);
            }
        });
    });

    // My Transaction
    jQuery("#mytransactions").click(function() {
        paginationQuery = "action=lottery_data&m=userinfo/get-transactions-by-memberid&PageSize=10";
        pagination('tabs-3');
    });

    // My Product
    jQuery("#my_products").click(function() {
        paginationQuery = "action=lottery_data&m=playlottery/get-products-by-memberid";
        pagination('tabs-5');
    });

    // My Tickets
    jQuery("#my_tickets").click(function() {
        paginationQuery = 'action=lottery_data&m=playlottery/get-draws-tickets-by-memberid';
        pagination('tabs-4');
    });

    jQuery(document.body).on('click', '.drawer-header', function(e) {
        $(this).next(".drawer-content").slideToggle("slow").siblings(".drawer-content:visible").slideUp("slow");
        $(this).toggleClass("current");
        $(this).siblings(".drawer-header").removeClass("current");
    });

    jQuery(".ico-close").click(function (e) {
        e.preventDefault();
        $('.payment_cart_detail').hide();
        $('#sign-in-form').hide();
        $('#sign-up-form').hide();
    });

    var btns = '.show-sign-in';
    if (CONFIG.isLogin) {
        btns += ',.nav-item-my-account';
    }

    $('.blur').hide();

    $(btns).click(function (e) {
        //e.preventDefault();
        $('.popup-form').hide();
        $('#sign-in-form').show();
        $('.blur').show();
    });

    $('.show-sign-up').click(function (e) {
        e.preventDefault();
        $('.popup-form').hide();
        $( "#sign-up-form" ).show();
        $('.blur').show();
    });

    $(".user-head").on('',function() {
        $('.user-short-info').toggle();
    });

    $('.user-head').mouseover(function(){
        $('.user-short-info').show();
    });
    $('.popup-user-box').mouseleave(function(){
        $('.user-short-info').hide();
    });

    jQuery(document).keyup(function(e) {
        if(e.keyCode == 27) {
            $('.popup-form').hide();
        }
    });

    jQuery(document).keypress(function(e) {
        if (e.keyCode == 13) {
            if (jQuery(".popup-form").attr("style") === "display: block;") {
                if (jQuery(".forgotemaildisp").hasClass("open")) {
                    jQuery(".forgot_submit").click();
                } else {
                    jQuery(".signin_submit").click();
                }
            }
        }
    });

    $(document).mouseup(function (e) {
        var container = $(".popup-form");
        if (!container.is(e.target) && container.has(e.target).length === 0 || $(e.target).hasClass("popup-close")) {
            container.hide();
            $('.blur').hide();
        }
    });

    jQuery(".card_option i").click(function() {
        $('input.'+$(this).attr('id')).attr('checked', 'checked');
    });

    jQuery("#addmethod").click(function() {

        jQuery(".cardupdatemsg").html("");
        $('.payment_cart_detail').show();

        jQuery("#cardid").val("0");
        //jQuery("#cardtype").val("");
        jQuery("#updatecard").find("input[name=card]").removeAttr('disabled');
        jQuery("#updatecard").find("input[name=card_num]").removeAttr('disabled');
        jQuery("#updatecard").find("input[name=card_num]").attr('placeholder', '');
        jQuery("#updatecard").trigger("reset");
    });

    if(document.referrer.indexOf("deposit") >= 0) {
        if ($('#my_payments_detail').length) {
            $('#my_payments_detail').trigger('click');
            $('.r_tabs').hide();
            $('#tabs-2').show();
            $('#addmethod').trigger('click');
        }
    }

    // Datewise result
    jQuery(document).on("change", ".datewiseresult", function() {
        jQuery(".loader").show();
        jQuery(".breakdown").html("");
        var id = jQuery(this).val();

        jQuery(".winning_number_count > ul").find("li").addClass('hide');
        jQuery(".winning_number_count > ul").find("." + id).removeClass("hide");

        var selecteddate = jQuery('option:selected', this).attr("data-date");
        jQuery("#replace-date").html(selecteddate);
        
        var drid = jQuery('option:selected', this).attr("data-id");
        var datastring = "action=lottery_data&m=globalinfo/get-lotteries-last-results-prizes&drid=" + drid;
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            success: function(resp) {
                jQuery(".loader").hide();
                jQuery(".breakdown").html(resp);
            }
        });
    });

    jQuery("#btn_withdraw").click(function() {
        var amount = jQuery("input[name=amt]");
        var error = jQuery(".myaccount_detail_error");
        if (amount.val() == "") {
            error.html("Please enter amount to withdraw");
        } else if (amount.val() < MinimumAmountForWithdraw) {
            error.html("Minimum withdraw amount is " + currency_symbol + MinimumAmountForWithdraw);
        } else {
            var datastring = "action=lottery_data&m=withdraw&amt=" + jQuery("input[name=amt]").val();
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: CONFIG.adminURL,
                data: datastring,
                success: function(resp) {
                    if (resp.IsSuccess) {
                        error.html(object_name.your_request_has_been_sent_to_our_support_we_will_get_back_to_you_shortly);
                    } else {
                        if (resp.error_msg != undefined) {
                            resp = lottoMsgTranslate(resp.error_msg);
                        } else if(resp.msg != undefined){
                            resp = lottoMsgTranslate(resp.msg)
                        }
                        error.html(resp);
                    }
                }
            });
        }
    });
});

var qs = (function(a) {
    if (a == "") return {};
    var b = {};
    for (var i = 0; i < a.length; ++i) {
        var p = a[i].split('=', 2);
        if (p.length == 1)
            b[p[0]] = "";
        else
            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
    }
    return b;
})(window.location.search.substr(1).split('&'));

function DiscountCounter(draws, stp1, weeks, type) {
    //Type is- is it "group" or "single" and it is string, when it is single you have to call the function with 1 week
    draws = draws * weeks;

    if (discountByDraws[type][draws] != undefined) {
        var discount = parseFloat((draws * stp1) / 100) * discountByDraws[type][draws];
        var dis = parseFloat(parseFloat(draws * stp1) - discount).toFixed(2);
        jQuery("#" + type).find(".bonusmoney").html(dis);
        jQuery("#" + type).find(".totalprice").html(dis);
        $('#disc_' + type).css("display", "block");
        $('#disc_' + type).text(object_name.discount + discount.toFixed(2));
    } else {
        $('#disc_' + type).css("display", "none");
        jQuery("#" + type).find(".bonusmoney").html(parseFloat(draws * stp1).toFixed(2));
        jQuery("#" + type).find(".totalprice").html(parseFloat(draws * stp1).toFixed(2));
    }
}

function getDataFromPaymentPage() {
    //get personal or group
    var objtoSession = {};

    var lottery = window.location.pathname.substring(1, window.location.pathname.lastIndexOf('-'));

    var currentTab = jQuery('#choosenTab').val();
    var currentTabFromSession = sessionStorage.getItem('choosenTab');

    if (typeof currentTabFromSession !== 'undefined' && currentTabFromSession !== null) {
        currentTab = currentTabFromSession;
        sessionStorage.removeItem('choosenTab');
    } else {
        if (sessionStorage.getItem(lottery.toLowerCase())) {
            var _data = sessionStorage.getItem(lottery.toLowerCase());
            var parsedData = JSON.parse(_data);
            var ticketType = parsedData['ticketType'];
            currentTab = "#" + ticketType;
        }
    }

    if (currentTab === "#single") {

        objtoSession['ticketType'] = 'single';
        var stp = jQuery("#stp").val();
        var singbm = jQuery("#single").find(".bonusmoney").html();
        var singsubtp = jQuery("#single").find(".subtotal").html();
        var singtp = jQuery("#single").find(".totalprice").html();

        var selno = "";
        var newarr = "";
        jQuery(".cardline").find(".selected").each(function() {
            var row = jQuery(this).parents(".cardline").attr("id");

            var cardnum = jQuery(this).index();

            var option_all = jQuery(this).find(".main_active").map(function() {
                return jQuery(this).text();
            }).get().join();

            var option_all1 = jQuery(this).find(".extra_active").map(function() {
                return jQuery(this).text();
            }).get().join();

            if (option_all1.length > 0) {
                selno += option_all + "#" + option_all1 + "|";
                newarr += row + "-" + cardnum + "=>" + option_all + "#" + option_all1 + "|";
            } else {
                selno += option_all + "#|";
                newarr += row + "-" + cardnum + "=>" + option_all + "#|";
            }

        });
        var lines = jQuery(".cardline").find(".selected").length;


        if (jQuery("#single").find("input[name=single_drawop]:checked").attr("id") === "radio1") {
            var oneTimeEntry = jQuery("#single").find(".draws").html("1 Draws").val();
            objtoSession['radio1'] = 1;
        }

        if (jQuery("#single").find("input[name=single_drawop]:checked").attr("id") === "radio2") {
            var draws = jQuery("#single").find(".single_totaldraw option:selected").val();
            objtoSession['radio2'] = draws;
        }

        if (jQuery("#single").find("input[name=single_drawop]:checked").attr("id") === "radio3") {

            var weeks = jQuery("#single").find(".single_subs option:selected").val();
            objtoSession['radio3'] = weeks;
        }

        //save to session
        objtoSession['stp'] = stp;
        objtoSession['storeselected'] = newarr;
        objtoSession['lines'] = lines;
        objtoSession['selno'] = selno;
        objtoSession['singbm'] = singbm;
        objtoSession['singsubtp'] = singsubtp;
        objtoSession['singtp'] = singtp;
    } else {
        //here is group

        var grpbm = jQuery("#group").find(".bonusmoney").html();
        var grpsubtp = jQuery("#group").find(".subtotal").html();
        var grptp = jQuery("#group").find(".totalprice").html();
        var shares = parseInt(jQuery("#group").find('input[name=quantity]').val());

        if (jQuery("#group").find("input[name=group_drawop]:checked").attr("id") === "grpradio1") {
            objtoSession['grpradio1'] = 1;

        }
        if (jQuery("#group").find("input[name=group_drawop]:checked").attr("id") === "grpradio2") {
            var draws = jQuery("#group").find(".group_totaldraw option:selected").val();
            objtoSession['grpradio2'] = draws;
        }

        if (jQuery("#group").find("input[name=group_drawop]:checked").attr("id") === "grpradio3") {
            var weeks = jQuery("#group").find(".group_subs option:selected").val();
            objtoSession['grpradio3'] = weeks;
        }

        objtoSession['ticketType'] = 'group';
        objtoSession['grpbm'] = grpbm;
        objtoSession['grpsubtp'] = grpsubtp;
        objtoSession['grptp'] = grptp;
        objtoSession['quantity'] = shares;
    }

    sessionStorage.setItem(lottery.toLowerCase(), JSON.stringify(objtoSession));
}

function CalculateRadioButonsChangesSingle(stp1, id, totalcard) {


    if (id === 'radio1') {
        jQuery("#single").find(".lines").html(totalcard + " " + object_name.lines);
        jQuery("#single").find(".draws").html(object_name.one_draws);
        jQuery("#single").find(".subtotal").html(stp1);
        jQuery("#single").find(".bonusmoney").html(stp1);
        jQuery("#single").find(".totalprice").html(stp1);
        DiscountCounter(1, stp1, 1, "single");

        if (jQuery("#minl").attr('data-old') != undefined) {
            jQuery("#minl").val(jQuery("#minl").attr('data-old'));
        }
    } else if (id === 'radio2') {
        var draws = jQuery("#single").find(".single_totaldraw option:selected").val();
        jQuery("#single").find(".draws").html(draws + " " + object_name.draws);
        jQuery("#single").find(".subtotal").html(parseFloat(draws * stp1).toFixed(2));

        DiscountCounter(draws, stp1, 1, "single");
        if (jQuery("#minl").attr('data-old') != undefined) {
            jQuery("#minl").val(jQuery("#minl").attr('data-old'));
        }

    } else if (id === 'radio3') {

        // changing minl according to lottery.
        var lottery = jQuery("#otherdata").val().split("|");

        if (jQuery("#minl").attr('data-old') != undefined) {
            jQuery("#minl").val(jQuery("#minl").attr('data-old'));
        }
        var draws = num_of_draws_group_per_week[lottery[1].toUpperCase()];
        var weeks = jQuery("#single").find(".single_subs option:selected").val();

        jQuery("#single").find(".subtotal").html(parseFloat(draws * weeks * stp1).toFixed(2));
        jQuery("#single").find(".draws").html(parseInt(draws * weeks) + " " + object_name.draws);
        DiscountCounter(draws, stp1, weeks, "single");
    }
}

// Validate new payment method
function validateNewMethod() {
    //var cardtype = jQuery("#updatecard").find("input[name=card]:checked").val();
    var cardnumber = jQuery("#updatecard").find("input[name=card_num]").val();
    //    var date = jQuery("#updatecard").find("input[name=expdate]").val();
    var cvv = jQuery("#updatecard").find("input[name=cvv]").val();
    var name = jQuery("#updatecard").find("input[name=fullname]").val();

    //    console.log(jQuery("#updatecard").serialize());
    //    return true;
    // if (jQuery.trim(cardtype) == "") {
        // jQuery(".cardupdatemsg").html(object_name.at_least_one_card_should_be_selected);
        // return false;
    if (jQuery.trim(cardnumber) == "") {
        jQuery(".cardupdatemsg").html(object_name.card_number_should_not_be_empty);
        return false;
    } else if (jQuery.trim(cardnumber).length < 16) {
        jQuery(".cardupdatemsg").html(object_name.card_number_is_not_a_valid_number);
        return false;
    }
    else if (jQuery.trim(cvv) == "") {
        jQuery(".cardupdatemsg").html(object_name.cvv_should_not_be_empty);
        return false;
    } else if (jQuery.trim(cvv).length < 3) {
        jQuery(".cardupdatemsg").html(object_name.cvv_must_contain_number_to_number_digits);
        return false;
    } else if (jQuery.trim(name) == "") {
        jQuery(".cardupdatemsg").html(object_name.card_holder_name_should_not_be_empty);
        return false;
    } else if (jQuery.trim(name).length < 2) {
        jQuery(".cardupdatemsg").html(object_name.card_holder_name_must_between_number_and_number_characters);
        return false;
    } else {
        jQuery(".cardupdatemsg").html("");
        return true;
    }
}

function getRandomInt(sel, max) {
    var arr = [];
    while (arr.length <= sel) {
        var randomnumber = Math.ceil(Math.random() * max);
        var found = false;
        for (var i = 0; i < arr.length; i++) {
            if (arr[i] == randomnumber) {
                found = true;
                break;
            }
        }
        if (!found)
            arr[arr.length] = randomnumber;
    }
    return arr;
}

function validateLogin() {
    var email = jQuery("#signin").find("input[name=email]");
    var password = jQuery("#signin").find("input[name=password]");
    var error = jQuery("#signin").find(".signin_error");
    var emailReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

    if (jQuery.trim(email.val()) === '' && jQuery.trim(password.val()) === '') {
        error.html(object_name.email_and_password_should_not_be_empty);
        return false;
    } else if (jQuery.trim(email.val()) === '' && jQuery.trim(password.val()) !== "") {
        error.html(object_name.email_should_not_be_empty);
        return false;
    } else if (jQuery.trim(email.val()) !== "" && !emailReg.test(jQuery.trim(email.val()))) {
        error.html(object_name.email_address_is_not_valid);
        return false;
    } else if (jQuery.trim(password.val()) === '' && jQuery.trim(email.val()) !== "") {
        error.html(object_name.password_should_not_be_empty);
        return false;
    }
    else {
        return true;
    }

}

// Payment login
function validatepLogin() {
    var email = jQuery("#signinform").find("input[name=email]");
    var password = jQuery("#signinform").find("input[name=password]");

    var error = jQuery("#signinform").find(".signin_error");

    var emailReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

    if (jQuery.trim(email.val()) === '' && jQuery.trim(password.val()) === '') {
        error.html(object_name.email_and_password_should_not_be_empty);
        return false;
    } else if (jQuery.trim(email.val()) === '' && jQuery.trim(password.val()) !== "") {
        error.html(object_name.email_should_not_be_empty);
        return false;
    } else if (jQuery.trim(email.val()) !== "" && !emailReg.test(jQuery.trim(email.val()))) {
        error.html(object_name.email_address_is_not_valid);
        return false;
    } else if (jQuery.trim(password.val()) === '' && jQuery.trim(email.val()) !== "") {
        error.html(object_name.password_should_not_be_empty);
        return false;
    } else {
        return true;
    }

}

function validateForgotPassword() {
    var email = jQuery("#signin").find("input[name=forgotemail]");
    var error = jQuery("#signin").find(".signin_error");

    var emailReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

    if (jQuery.trim(email.val()) === '') {
        error.html(object_name.email_should_not_be_empty);
        return false;
    } else if (jQuery.trim(email.val()) !== "" && !emailReg.test(jQuery.trim(email.val()))) {
        error.html(object_name.email_address_is_not_valid);
        return false;
    } else {
        return true;
    }
}

function validateForgotPasswordWithObj(email, error) {
    var emailReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

    if (jQuery.trim(email) === '') {
        error.html("Email should not be empty");
        return false;
    } else if (jQuery.trim(email) !== "" && !emailReg.test(jQuery.trim(email))) {
        error.html("Email address is not valid");
        return false;
    } else {
        return true;
    }
}

// navidad insert
function insertNavidadNumbers(selectedIds) {
    var datastring = "action=lottery_data&m=playlottery/insert-navidad-numbers&lt=" + selectedIds;
    //debugger;
    jQuery.ajax({
        type: "POST",
        url: CONFIG.adminURL,
        data: datastring,
        dataType: 'json',
        success: function(res) {
            var otherdata = jQuery("#otherdata").val();
            if (res.ProductManagementCounter > 0) {
                otherdata += '0|' + res.ProductManagementCounter + '|false';
                jQuery("#otherdata").val(otherdata);
            }

            setTimeout(function() {
                document.forms['selectedData'].submit();
            }, 200);
        },
        error: function(res) {
            insertNavidadNumbers(selectedIds, callback);
        }
    });
}
// Payment login
function validatepForgotPassword() {
    var email = jQuery("#signinform").find("input[name=forgotemail]");
    var error = jQuery("#signinform").find(".signinerror");

    var emailReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

    if (jQuery.trim(email.val()) === '') {
        error.html(object_name.email_should_not_be_empty);
        return false;
    } else if (jQuery.trim(email.val()) !== "" && !emailReg.test(jQuery.trim(email.val()))) {
        error.html(object_name.email_address_is_not_valid);
        return false;
    } else {
        return true;
    }
}

function validateRegistration() {
    var email = jQuery("#registeration").find("input[name=email]");
    var fname = jQuery("#registeration").find("input[name=fname]");
    var lname = jQuery("#registeration").find("input[name=lname]");
    var phone = jQuery("#registeration").find("input[name=phone]");
    var terms = jQuery("#registeration").find("input[name=terms]:checked");
    var error = jQuery("#registeration").find(".registeration_error");



    var numericReg = /^([0-9]{6,14})+$/;
    var numeric = /^([0-9])+$/;
    var phoneReg = /^\+?[0-9 \-()]{6,25}$/;
    var emailReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

    if (jQuery.trim(email.val()) === '' && jQuery.trim(fname.val()) === '' && jQuery.trim(lname.val()) === '' && jQuery.trim(terms.val()) === '') {
        error.html(object_name.email_first_name_Last_Name_and_t_and_c_checkbox_should_not_be_empty);
        return false;
    } else if (jQuery.trim(email.val()) === '' && jQuery.trim(fname.val()) === '' && jQuery.trim(lname.val()) === '' && jQuery.trim(terms.val()) === '') {
        error.html(object_name.email_first_name_Last_Name_phone_and_t_and_c_checkbox_should_not_be_empty);
        return false;
    } else if (jQuery.trim(fname.val()) === "") {
        error.html(object_name.first_name_should_not_be_empty);
        return false;
    } else if (jQuery.trim(lname.val()) === "") {
        error.html(object_name.last_name_should_not_be_empty);
        return false;
    } else if (jQuery.trim(email.val()) === '') {
        error.html(object_name.email_should_not_be_empty);
        return false;
    } else if (jQuery.trim(terms.val()) === '') {
        error.html(object_name.you_must_agree_with_our_terms_and_conditions);
        return false;
    } else if (jQuery.trim(email.val()) !== "" && !emailReg.test(jQuery.trim(email.val()))) {
        error.html(object_name.email_address_is_not_valid);
        return false;
    // } else if (jQuery.trim(phone.val()) === "") {
        // error.html(object_name.phone_should_not_be_empty);
        // return false;
    } else if (jQuery.trim(phone.val()) !== "" && !phoneReg.test(jQuery.trim(phone.val()))) {
        error.html(object_name.phone_number_must_contain_between_number_and_number_digits);
        return false;
    } else {
        return true;
    }
}

function validateSignup() {
    var email = jQuery("#signup-email").val();

	var password = jQuery("#signup-password").val();
    var error = jQuery("#signup").find(".signup_error");
    var emailReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    var fullName = jQuery("#signup-fullname");
    var phone = jQuery("#signup-phone");
    var terms = jQuery("#signup-terms");
    var error = jQuery("#signup").find(".signup_error");

    var numericReg = /^([0-9])+$/;
    var phoneReg = /^\+?[0-9 \-()]{6,25}$/;
    var nameReg  = /^[- 'a-zA-Z]+$/;

    var serialized = ""

    if (jQuery.trim(email).length == 0) {
        error.html(object_name.email_should_not_be_empty);
        return false;
    } else if (!emailReg.test(jQuery.trim(email))) {
        error.html(object_name.email_address_is_not_valid);
        return false;
    } else if (jQuery.trim(password) === '') {
        error.html(object_name.password_should_not_be_empty);
        return false;
    } else if (jQuery.trim(password).length < 7 || jQuery.trim(password).length > 20) {
        error.html(object_name.password_length_should_be_between_number_and_number_characters);
        return false;
    } else  if (jQuery.trim(fullName.val()) === "") {
        error.html(object_name.full_name_should_not_be_empty);
        return false;
    } else if (!nameReg.test(jQuery.trim(fullName.val()))) {
        error.html(object_name.full_name_is_invalid);
        return false;
    // } else if (jQuery.trim(phone.val()) === "") {
        // error.html(object_name.phone_should_not_be_empty);
        // return false;
    } else if (jQuery.trim(phone.val()) !== "" && !numericReg.test(jQuery.trim(phone.val()))) {
        error.html(object_name.phone_number_is_not_valid);
        return false;
    } else if (jQuery.trim(phone.val()) !== "" && jQuery.trim(phone.val()).length < 6 || jQuery.trim(phone.val()).length > 25) {
        error.html(object_name.phone_number_must_contain_between_number_and_number_digits);
        return false;
    } else if (jQuery.trim(terms.val()) === '') {
        error.html(object_name.you_must_agree_with_our_terms_and_conditions);
        return false;
    } else {
        //email=asd%40asd.asd&password=1q2w3e4r5t&firstName=asd&lastName=asd&phone=123123123&terms=on

        return true;
    }
}

/*function validateSignupStep2() {

    var fullName = jQuery("#update-personal-details").find("input[name=full_name]");
    var phone = jQuery("#update-personal-details").find("input[name=phone]");
    var terms = jQuery("#update-personal-details").find("input[name=terms]:checked");
    var error = jQuery("#update-personal-details").find(".signup_error");

    var phoneReg = /^\+?[0-9 \-()]{6,25}$/;
    var nameReg  = /^[- 'a-zA-Z]+$/;

    if (jQuery.trim(fullName.val()) === "") {
        error.html(object_name.full_name_should_not_be_empty);
        return false;
    } else if (!nameReg.test(jQuery.trim(fullName.val()))) {
        error.html(object_name.full_name_is_invalid);
        return false;
    }else if (jQuery.trim(phone.val()) === "") {
        error.html(object_name.phone_should_not_be_empty);
        return false;
    } else if (jQuery.trim(phone.val()) !== "" && !phoneReg.test(jQuery.trim(phone.val()))) {
        error.html(object_name.phone_number_must_contain_between_number_and_number_digits);
        return false;
    } else if (phone.val().length < 6 || phone.val().length > 25) {
        error.html(object_name.phone_number_must_contain_between_number_and_number_digits);
        return false;
    } else if (jQuery.trim(terms.val()) === '') {
        error.html(object_name.you_must_agree_with_our_terms_and_conditions);
        return false;
    } else {
        return true;
    }
}*/

// Payment Signup
function validatepSignup() {
    var email = jQuery("#signupform").find("input[name=email]");
    var fname = jQuery("#signupform").find("input[name=firstname]");
    var lname = jQuery("#signupform").find("input[name=lastname]");
    var phone = jQuery("#signupform").find("input[name=phone]");
    var terms = jQuery("#signupform").find("input[name=terms]:checked");
    var error = jQuery("#signupform").find(".signup_error");

    var numericReg = /^([0-9])+$/;
    var numeric    = /^([0-9])+$/;
    var phoneReg   = /^\+?[0-9 \-()]{6,25}$/;
    var emailReg   = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    var nameReg    = /^[-'a-zA-Z]+$/;

    if (jQuery.trim(email.val()) === '' && jQuery.trim(fname.val()) === '' && jQuery.trim(lname.val()) === '' && jQuery.trim(terms.val()) === '') {
        error.html(object_name.email_first_name_Last_Name_phone_and_t_and_c_checkbox_should_not_be_empty);
        return false;
    } else if (jQuery.trim(email.val()) === '' && jQuery.trim(fname.val()) === '' && jQuery.trim(lname.val()) === '' && jQuery.trim(terms.val()) === '') {
        error.html(object_name.email_first_name_Last_Name_and_t_and_c_checkbox_should_not_be_empty);
        return false;
    } else if (jQuery.trim(fname.val()) === "") {
        error.html(object_name.first_name_should_not_be_empty);
        return false;
    } else if (!nameReg.test(jQuery.trim(fname.val()))) {
        error.html(object_name.first_name_is_invalid);
        return false;
    } else if (jQuery.trim(lname.val()) === "") {
        error.html(object_name.last_name_should_not_be_empty);
        return false;
    }  else if (!nameReg.test(jQuery.trim(lname.val()))) {
        error.html(object_name.last_name_is_invalid);
        return false;
    // } else if (jQuery.trim(phone.val()) === "") {
        // error.html(object_name.phone_should_not_be_empty);
        // return false;
    } else if (jQuery.trim(phone.val()) !== "" && !numericReg.test(jQuery.trim(phone.val()))) {
        error.html(object_name.phone_number_is_not_valid);
        return false;
    } else if (jQuery.trim(phone.val()) !== "" && jQuery.trim(phone.val()).length < 6 || jQuery.trim(phone.val()).length > 25) {
        error.html(object_name.phone_number_must_contain_between_number_and_number_digits);
        return false;
    }  else if (jQuery.trim(email.val()) === '') {
        error.html(object_name.email_should_not_be_empty);
        return false;
    } else if (!emailReg.test(jQuery.trim(email.val()))) {
        error.html(object_name.email_address_is_not_valid);
        return false;
    } else if (jQuery.trim(terms.val()) === '') {
        error.html(object_name.you_must_agree_with_our_terms_and_conditions);
        return false;
    } else {
        return true;
    }
}

// refactor this shit later
function validateResetPasswordForm() {
    var pass = jQuery("#resetform").find("input[name=password]");
    var confirm_pass = jQuery("#resetform").find("input[name=confirm_password]");
    var error = jQuery("#resetform").find(".reset_error");
    var pass_val = jQuery.trim(pass.val());
    var confirm_pass_val = jQuery.trim(confirm_pass.val());
    if (pass_val === '') {
        error.html(object_name.password_should_not_be_empty);
        return false;
    } else if (pass_val.length < 7 || pass_val.length > 20) {
        error.html(object_name.password_length_should_be_between_number_and_number_characters);
        return false;
    } else if (pass_val !== confirm_pass_val) {
        error.html(object_name.passwords_are_not_the_same);
        return false;
    } else {
        return true;
    }
}

function deleteMethod(id) {

    if (confirm(object_name.are_you_sure_you_want_to_delete_this_card)) {
        var datastring = "action=lottery_data&m=userinfo/delete-credit-card&id=" + id;
        var cardUpdateMsg = jQuery(".cardupdatemsg");
        jQuery(".macloader").show();
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            success: function(data) {

                jQuery("#my_payments_detail").trigger("click");
            }
        });
    }
}

function editMethod(id) {

    $(".cardupdatemsg").html("");
    $('.payment_cart_detail').show();

    var datastring = "action=lottery_data&m=userinfo/get-credit-card-methods-by-memberid&detail=1&id=" + id;

    // jQuery("#Visa").attr('disabled', 'disabled');
    // jQuery("#MasterCard").attr('disabled', 'disabled');
    // jQuery("#AmiricanExp").attr('disabled', 'disabled');
    // jQuery("#DinersClub").attr('disabled', 'disabled');
    jQuery(".card_num").attr('disabled', 'disabled');

    $('.month option').removeAttr("selected");
    $('.year option').removeAttr("selected");

    setTimeout(function() {
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            dataType: 'json',
            success: function(data) {

                // if (data.CardType === 'Visa') {
                    // document.getElementById("Visa").checked = true;
                    // document.getElementById("MasterCard").checked = false;
                // }

                // if (data.CardType === 'MasterCard') {
                    // document.getElementById("Visa").checked = false;
                    // document.getElementById("MasterCard").checked = true;
                // }

                jQuery(".card_num").attr("placeholder", "***********" + data.CreditCardNumber);
                jQuery("#cardnumber").val(data.CreditCardNumber);
                jQuery(".cvv").val(data.Cvv);
                jQuery("#cardid").val(data.Id);
                jQuery(".fullname").val(data.CardHolderName);

                $('.month option[value=' + data.month + ']').attr('selected', 'selected');
                $('.year option[value=' + data.year + ']').attr('selected', 'selected');

                //                jQuery("#expdate").val(resp.month + "/" + resp.day + "/" + resp.year);
                //jQuery("#cardtype").val(data.CardType);

            }
        });
    }, 100);
}

function updateMethod() {
    debugger;
    var cardupdate = false;
    if (jQuery("#cardid").val() === "0") {
        cardupdate = validateNewMethod();
    } else {
        cardupdate = validateUpdateCard();
    }


    if (cardupdate) {
        var data = jQuery("#updatecard").serialize();
        var datastring = "action=lottery_data&m=userinfo/add-update-credit-card&" + data;
        jQuery(".cardupdatemsg").html("");
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            dataType: 'json',
            success: function(data) {
                debugger;
                var resp;

                if (data.Result !== undefined) {
                    resp = lottoMsgTranslate(data.Result)
                    jQuery(".cardupdatemsg").html('<span class="success">' + resp + '</span>');

                    if (data.Result === "Credit card updated" || data.Result === "Credit card added") {
                        $('input,textarea').attr('autocomplete', 'off');
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 500);
                    }
                } else {
                    resp = lottoMsgTranslate(data.error_msg);
                    jQuery(".cardupdatemsg").html(resp);
                }
            }
        });
    }
}

function validateUpdateCard() {
    var cvv = jQuery("#updatecard").find("input[name=cvv]").val();
    var name = jQuery("#updatecard").find("input[name=fullname]").val();

    if (jQuery.trim(cvv) === "") {
        jQuery(".cardupdatemsg").html(object_name.cvv_should_not_be_empty);
        return false;
    } else if (jQuery.trim(cvv).length < 3) {
        jQuery(".cardupdatemsg").html(object_name.cvv_must_contain_number_to_number_digits);
        return false;
    } else if (jQuery.trim(name) == "") {
        jQuery(".cardupdatemsg").html(object_name.card_holder_name_should_not_be_empty);
        return false;
    } else if (jQuery.trim(name).length < 2) {
        jQuery(".cardupdatemsg").html(object_name.card_holder_name_must_between_number_and_number_characters);
        return false;
    } else {
        jQuery(".cardupdatemsg").html("");
        return true;
    }
}

function cardProduct() {
    var formdata = jQuery("#selectedData").serialize();

    var datastring = "action=lottery_data&m=playlottery/insert-members-products-with-draws&" + formdata;

    jQuery.ajax({
        type: "POST",
        url: CONFIG.adminURL,
        data: datastring,
        dataType: "JSON",
        success: function(resp) {

            var otherdata = jQuery("#otherdata").val();

            if (resp.ProductManagementCounter > 0) {
                otherdata += '|' + resp.ProductManagementCounter + '|false';
                jQuery("#otherdata").val(otherdata);
            }

            setTimeout(function() {
                document.forms['selectedData'].submit();
            }, 200);
        }
    });
}

function groupProduct() {
    var formdata = jQuery("#selectedData").serialize();

    var datastring = "action=lottery_data&m=playlottery/insert-members-groups&" + formdata;

    jQuery.ajax({
        type: "POST",
        url: CONFIG.adminURL,
        data: datastring,
        dataType: "JSON",
        success: function(resp) {

            var otherdata = jQuery("#otherdata").val();

            if (resp.ProductManagementCounter > 0) {
                otherdata += '|' + resp.ProductManagementCounter + '|true';
                jQuery("#otherdata").val(otherdata);
            }

            setTimeout(function() {
                document.forms['selectedData'].submit();
            }, 200);
        }
    });
}

// Allows to enter only numeric.
function isNumberKey(evt) {

    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode !== 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

// Allows to enter only numeric/+ and ().
function isNumberAddBrackets(evt) {
    //43   +
    //40 (
    //41 )
    //32 space
    //45 -
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode === 43 || charCode === 40 || charCode === 41 || charCode === 32 || charCode === 45) {
        return true;
    }
    if (charCode !== 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

// Allows to enter only alphabet with space.
function isAlphaKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode !== 46 && charCode > 32 && ((charCode < 65 || charCode > 97) && (charCode < 97 || charCode > 123)))
        return false;
    return true;
}

// Allows only characters that could be contained in a name
function isNameValid(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    //39 '
    //45 -
    if (charCode === 45 || charCode === 39) {
        return true;
    }

    if (charCode !== 46 && charCode > 32 && ((charCode < 65 || charCode > 97) && (charCode < 97 || charCode > 123)))
        return false;

    return true;
}

// Calculate total in single.
function totalForSingle() {

    // total price
    var lottery = jQuery("#otherdata").val().split("|");
    var stp = jQuery("#stp").val();

    var totalcard = 0;
    jQuery('.cardline').find(".select_num_col").each(function() {
        if (jQuery(this).hasClass("selected")) {
            totalcard = parseInt(totalcard + 1);
        }
    });

    var stp1 = parseFloat(stp * totalcard).toFixed(2);
    jQuery("#single").find(".lines").html(totalcard + " " + object_name.lines);
    jQuery("#single").find(".subtotal").html(stp1);
    jQuery("#single").find(".bonusmoney").html(stp1);
    jQuery("#single").find(".totalprice").html(stp1);

    if (jQuery("#single").find("input[name=single_drawop]:checked").attr("id") === "radio1") {
        jQuery("#single").find(".draws").html(object_name.one_draws);
    }

    if (jQuery("#single").find("input[name=single_drawop]:checked").attr("id") === "radio2") {
        var draws = jQuery("#single").find(".single_totaldraw option:selected").val();
        jQuery("#single").find(".subtotal").html(parseFloat(draws * stp1).toFixed(2));
        jQuery("#single").find(".draws").html(draws + " " + object_name.draws);
        DiscountCounter(draws, stp1, 1, "single");
    }

    if (jQuery("#single").find("input[name=single_drawop]:checked").attr("id") === "radio3") {

        var draws = num_of_draws_group_per_week[lottery[1].toUpperCase()];
        var weeks = jQuery("#single").find(".single_subs option:selected").val();

        jQuery("#single").find(".subtotal").html(parseFloat(draws * weeks * stp1).toFixed(2));
        jQuery("#single").find(".draws").html(parseInt(draws * weeks) + " " + object_name.draws);

        DiscountCounter(draws, stp1, weeks, "single");
    }
}

// Calculate total in group
function totalForGroup(currentVal) {
    var lottery = jQuery("#otherdata").val().split("|");
    var gtp = jQuery("#gtp").val();
    var gtp1 = parseFloat(gtp * currentVal).toFixed(2);
    jQuery("#group").find(".shares").html(currentVal + " Shares");
    jQuery("#group").find(".subtotal").html(gtp1);
    DiscountCounter(1, gtp1, 1, "group");

    if (jQuery("#group").find("input[name=group_drawop]:checked").attr("id") === "grpradio1") {
        jQuery("#group").find(".draws").html(object_name.one_draws);
    }
    if (jQuery("#group").find("input[name=group_drawop]:checked").attr("id") === "grpradio2") {
        var draws = jQuery("#group").find(".group_totaldraw option:selected").val();
        jQuery("#group").find(".draws").html(draws + " " + object_name.draws);
        jQuery("#group").find(".subtotal").html(parseFloat(gtp1 * draws).toFixed(2));

        DiscountCounter(draws, gtp1, 1, "group");

    }

    if (jQuery("#group").find("input[name=group_drawop]:checked").attr("id") === "grpradio3") {
        var draws = num_of_draws_group_per_week[lottery[1].toUpperCase()];
        var weeks = jQuery("#group").find(".group_subs option:selected").val();

        jQuery("#group").find(".draws").html(parseInt(draws * weeks) + " " + object_name.draws);

        jQuery("#group").find(".subtotal").html(parseFloat(gtp1 * draws * weeks).toFixed(2));
        DiscountCounter(draws, gtp1, weeks, "group");
    }
}

// Calculate total on line delete.
function totalLineDelete() {
    var stp = jQuery("#stp").val();
    var totalcard = jQuery('.cardline').find(".selected").length;

    var stp1 = parseFloat(stp * totalcard).toFixed(2);
    jQuery("#single").find(".lines").html(totalcard + " " + object_name.lines);
    jQuery("#single").find(".subtotal").html(stp1);
    var id = jQuery("#single").find("input[name=single_drawop]:checked").attr("id");
    CalculateRadioButonsChangesSingle(stp1, id, totalcard);

}

function clearTotal() {
    jQuery('.cardline').find(".select_num_col").removeClass("selected");
    jQuery('.cardline').find(".select_num_col").find(".lt_numbers_wrapper").children("span").removeAttr('class');
    jQuery('.cardline').find(".select_num_col").find(".select_num_part_wrapper").children("span").removeClass('extra_active');

    jQuery("#single").find(".lines").html(object_name.zero_lines);
    jQuery("#single").find(".subtotal").html(object_name.zero_zero);
    jQuery("#single").find(".bonusmoney").html(object_name.zero_zero);
    jQuery("#single").find(".totalprice").html(object_name.zero_zero);
}
// Function for pagination in My Account Tabs.
var current_page = 1;

function pagination(div) {
    var innerdiv = "";
    current_page = 1; // start from page 1 for new tab

    if (div === 'tabs-3') {
        innerdiv = "#mytransaction";
    } else if (div === 'tabs-4') {
        innerdiv = "#my_tickets_data";
    } else if (div === 'tabs-5') {
        innerdiv = "#myproduct";
    } else {
        return false;
    }

    go_to_page(1, div, innerdiv);
}

function previous(div, innerdiv) {
    if (current_page >= 2) {
        go_to_page(current_page - 1, div, innerdiv);
        current_page--;
    }
}

function next(div, innerdiv) {
    go_to_page(current_page + 1, div, innerdiv);
}

function go_to_page(page_num, div, innerdiv) {
    var datastring = paginationQuery + "&PageNumber=" + page_num;
    jQuery(".macloader").show();
    jQuery.ajax({
        type: "POST",
        url: CONFIG.adminURL,
        data: datastring,
        success: function(data) {
            jQuery(".macloader").hide();

            if (data != '') {
                if (page_num > current_page) {
                    current_page++;
                }

                jQuery(innerdiv).html(data);

                // navigation
                var navigation_html = '<div class="pagingleft"><a class="previous_link" href="javascript:previous(\'' + div + '\',\'' + innerdiv + '\');">' + object_name.prev + '</a></div>';

                navigation_html += '<div class="paging"><ul>';
                navigation_html += '<li><a class="page_link active_page" href="javascript:void(0)">' + current_page + '</a></li>';
                navigation_html += '</ul></div>';
                navigation_html += '<div class="pagingright"><a class="next_link" href="javascript:next(\'' + div + '\',\'' + innerdiv + '\');">' + object_name.next_next + '</a></div>';

                $("#" + div).children('.paging_part').html(navigation_html);
            }
        }
    });
}

(function($) {

    "use strict";

    // No jQuery? No reborn.
    if (!$)
        return;

    var Phoenix = function() {

        var _ = this;

        this.setup = function(element, options) {

            this.element = $(element);
            this.options = options;
            this.interval = null;


            this.ashes = this.element.children("div");
            this.total = this.ashes.length;
            this._static = this.ashes.length == 1;
            this.current = this.ashes.length - 1;

            this.elevation = null;

            this._defaults = {
                delay: 10000,
                speed: 400,
                height: null,
                fullscreen: true,
                dots: true,
                keys: true,
                complete: function(index, currentElement, prevElement) {}
            };

            this.init();
        };

        this.init = function() {

            // Store a reference to the original remove method.
            var originalMethod = jQuery.fn.transition || jQuery.fn.animate;

            // Define overriding method.
            jQuery.fn.spitFire = function() {
                // Execute the original method.
                return originalMethod.apply(this, arguments);
            }

            this._defaults = $.extend(this._defaults, this.options);

            var ash, pic;

            $(window).on('resize', function() {
                _.resize();
            }).trigger('resize');

            // Show Dots
            this._defaults.dots && !_._static && this.dots();

            //  Custom keyboard support
            this._defaults.keys && !_._static && $(document).keydown(this.keys);

            this.ashes.each(function(index) {

                ash = $(this);

                pic = ash.children("img");

                ash.css({
                    'background-image': 'url(' + pic.attr('src') + ')',
                    // 'filter': "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + pic.attr('src') + "', sizingMethod='scale')",
                    // '-ms-filter': "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + pic.attr('src') + "', sizingMethod='scale')",
                });

                if (index == 0)
                    ash.css('z-index', 99999);

                pic.remove();
            });

            // Adding Touch Support with jQueryMobile
            !_._static && $().swiperight && $().swipeleft && _.element.swipeleft(_.next) && _.element.swiperight(_.prev);

            this.next();
            !_._static && this.play();
        };

        this.resize = function() {

            this.computeTallness();

            this.element.css({
                'height': (this._defaults.fullscreen === true ? $(window).height() : _.elevation) + 'px'
            });
        };

        this.computeTallness = function() {
            if (this._defaults.fullscreen === true) {

                _.elevation = $(window).height();

            } else {
                if ((typeof _._defaults.height).toLowerCase() === 'string') {
                    if (_._defaults.height.slice(-1) === '%') {
                        _.elevation = $(window).height() * (_._defaults.height.substr(0, _._defaults.height.length - 1) / 100);
                    }
                } else if ((typeof _._defaults.height).toLowerCase() === 'number') {
                    _.elevation = _._defaults.height;
                } else {
                    _.elevation = _.element.height() == 0 ? $(window).height() : _.element.height();
                }
            }
        };

        this.dots = function() {
            //  Create the HTML
            var html = '<div class="container-dots-wrapper"><div class="container-dots-inner"><ol class="dots">';
            $.each(this.ashes, function(index) {
                html += '<li class="dot' + (index < 1 ? ' active' : '') + '">' + (index + 1) + '</li>';
            });
            html += '</ol></div></div>';

            //  Add it to the Slider
            this.element.append(html).find('.dot').click(function() {
                _.move($(this).index(), true);
            });
        }

        this.index = function() {
            return _.current;
        }

        this.destroy = function() {

            // Remove elements, unregister listeners, etc
            // TODO

            // Remove data
            this.element.removeData();
        };

        this.play = function() {
            _.interval = setInterval(function() {
                _.next();
            }, _._defaults.delay);

            return _;
        };

        //  Stop autoplay
        this.stop = function() {
            _.interval = clearInterval(_.interval);

            return _;
        };

        //  Keypresses
        this.keys = function(e) {
            var key = e.which;
            var map = {
                //  Prev/next
                37: _.prev,
                39: _.next,
            };

            if ($.isFunction(map[key])) {
                map[key](true);
            }
        };

        //  Arrow navigation
        this.next = function(f) {
            return _.move(_.current + 1, f);
        };

        this.prev = function(f) {
            return _.move(_.current - 1, f);
        };

        this.move = function(index, f) {

            if (index == _.current)
                return;

            var newIndex, oldIndex,
                oldIndex = _.current,
                oldElement = this.ashes.eq(_.current),
                newElement;

            //  If it's out of bounds, go to the first slide
            if (!this.ashes.eq(index).length)
                index = 0;
            if (index < 0)
                index = (this.ashes.length - 1);

            _.current = index;

            newIndex = _.current;
            newElement = this.ashes.eq(newIndex);

            newElement.css('opacity', 1);

            if (_._static)
                return;

            _.element.find('.dot:eq(' + index + ')').addClass('active').siblings().removeClass('active');

            oldElement.spitFire({
                'opacity': 0,
                'duration': this._defaults.speed
            }, function() {
                oldElement.css('z-index', 'auto');
                newElement.css('z-index', 99999);

                if (f)
                    _.stop().play();

                if (typeof(_._defaults.complete) === 'function')
                    _._defaults.complete(newIndex, newElement, oldElement);
            });
        }

        this.getRandomInt = function(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
    };

    //  Create a jQuery plugin
    return $.fn.phoenix = function(o) {
        var len = this.length;

        //  Enable multiple-slider support
        return $(this.each(function(index) {
            //  Cache a copy of $(this), so it
            var me = $(this),
                instance = (new Phoenix).setup(me, o);

            //  Invoke a Phoenix Slider instance
            me.data('phoenix' + (len > 1 ? '-' + (index + 1) : ''), instance);
        })).data('phoenix');
    };

})(jQuery);


function lottoMsgTranslate(msg) {
    if (typeof object_name == undefined) { // check if translating should be done
        return msg;
    } else {
        var temp = msg;
        temp = msg.toLowerCase();
        temp = temp.split(" ").join("_"); //string replace only replaces first occurrence

        if(object_name.hasOwnProperty(temp)){
            return object_name[msg];
        } else {
            return msg;
        }
    }
}

var countriesPhoneCodes = {DZ:213,AD:376,AO:244,AI:1264,AG:1268,AR:54,AM:374,AW:297,AU:61,AT:43,AZ:994,BS:1242,BH:973,BD:880,BB:1246,BY:375,BE:32,BZ:501,BJ:229,BM:1441,BT:975,BO:591,BA:387,BW:267,BR:55,BN:673,BG:359,BF:226,BI:257,KH:855,CM:237,CA:1,CV:238,KY:1345,CF:236,CL:56,CN:86,CO:57,KM:269,CG:242,CK:682,CR:506,HR:385,CU:53,CY:90392,CZ:42,DK:45,DJ:253,DM:1809,DO:1809,EC:593,EG:20,SV:503,GQ:240,ER:291,EE:372,ET:251,FK:500,FO:298,FJ:679,FI:358,FR:33,GF:594,PF:689,GA:241,GM:220,GE:7880,DE:49,GH:233,GI:350,GR:30,GL:299,GD:1473,GP:590,GU:671,GT:502,GN:224,GW:245,GY:592,HT:509,HN:504,HK:852,HU:36,IS:354,IN:91,ID:62,IR:98,IQ:964,IE:353,IL:972,IT:39,JM:1876,JP:81,JO:962,KZ:7,KE:254,KI:686,KP:850,KR:82,KW:965,KG:996,LA:856,LV:371,LB:961,LS:266,LR:231,LY:218,LI:417,LT:370,LU:352,MO:853,MK:389,MG:261,MW:265,MY:60,MV:960,ML:223,MT:356,MH:692,MQ:596,MR:222,YT:269,MX:52,FM:691,MD:373,MC:377,MN:976,MS:1664,MA:212,MZ:258,MM:95,NA:264,NR:674,MP:977,NL:31,NC:687,NZ:64,NI:505,NE:227,NG:234,NU:683,NF:672,NP:670,NO:47,OM:968,PW:680,PA:507,PG:675,PY:595,PE:51,PH:63,PL:48,PT:351,PR:1787,QA:974,RE:262,RO:40,RU:7,RW:250,SM:378,ST:239,SA:966,SN:221,CS:381,SC:248,SL:232,SG:65,SK:421,SI:386,SB:677,SO:252,ZA:27,ES:34,LK:94,SH:290,KN:1869,LC:1758,SD:249,SR:597,SZ:268,SE:46,CH:41,SY:963,TW:886,TJ:7,TH:66,TG:228,TO:676,TT:1868,TN:216,TR:90,TM:993,TC:1649,TV:688,UG:256,GB:44,UA:380,AE:971,UY:598,US:1,UZ:7,VU:678,VA:379,VE:58,VN:84,VG:84,VI:84,WF:681,YE:969,ZM:260,ZW:263};
var phoneCode = countriesPhoneCodes[CONFIG.countryCode];

(function(){
    if (CONFIG.countryCode !== '') {

        // sign up
        $('.form-field-bg').find('input[name=phone]').val(phoneCode); //signup header-menu
        $('#signupform').find('input[name=phone]').val(phoneCode); //signup playpage

        if (jQuery('input[name=phone]').val() == '') {
            jQuery('input[name=phone]').val(phoneCode);
        }
        if (jQuery('input[name=mobno]').val() == '') {
            jQuery('input[name=mobno]').val(phoneCode);
        }
    };
})();

jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
	$('#preloader').fadeOut('slow',function(){$(this).remove();});
});

});