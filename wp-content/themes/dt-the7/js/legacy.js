
jQuery(document).ready(function($){
    var $body = $("body"),
        $window = $(window),
       // $mainSlider = $('#main-slideshow'),
        //$3DSlider = $('.three-d-slider'),
        adminH = $('#wpadminbar').height(),
        header = $('.masthead:not(.side-header):not(.side-header-v-stroke)').height();
     
 /* !-Smart benefits & logos resize */
    $.fn.smartGrid = function() {
        return this.each(function() {
            var $this = $(this),
                colNum = parseInt($this.attr("data-columns")),
                colMinWidth = parseInt($this.attr("data-width")),
                contWidth = $this.width();

            for ( ; Math.floor(contWidth/colNum) < colMinWidth; ) {
                colNum--;
                if (colNum <= 1) break;
            }

            $("> .wf-cell", $this).css({
                width: (100/colNum).toFixed(6) + "%",
                display: "inline-block"
            });
        });
    };

    var $benLogColl = $(".benefits-grid, .logos-grid");
    $benLogColl.smartGrid();
    $window.on("debouncedresize", function () {
        $benLogColl.smartGrid();
    });

/*!-Project floating content*/
   // var $floatContent = $(".floating-content"),
        var projectPost = $(".project-post");
     
    // $parentHeight = $floatContent.siblings(".project-wide-col").height(),
    //     $floatContentHeight = $floatContent.height(),
        var phantomHeight = 0;

    if($(".phantom-sticky").length > 0){
        var $phantom = $(".masthead:not(.side-header):not(.side-header-v-stroke)"),
            $phantomVisibility = 1;
    }else{
        var $phantom = $("#phantom"),
            $phantomVisibility = $phantom.css("display")=="block";
    }

    if ($(".mobile-header-bar").css('display') !== 'none') {
        var $headerBar = $(".mobile-header-bar");
        if($(".phantom-sticky").length > 0){
            if($(".sticky-header .masthead.side-header").length > 0 || $(".overlay-navigation .masthead.side-header").length > 0){
                var $phantom = $(".mobile-header-bar").parent(".masthead:not(.side-header)");
            }else{
                var $phantom = $(".mobile-header-bar").parent();
            }
        }
    }else{
        var $headerBar = $(".masthead:not(.side-header):not(.side-header-v-stroke) .header-bar");
    }


    // function setFloatinProjectContent() {
    //     $(".project-slider .preload-me").loaded(null, function() {
    //         var $sidebar = $(".floating-content");
    //         if ($(".floating-content").length > 0) {
    //             var offset = $sidebar.offset();
    //             if($(".top-bar").length > 0 && $(".phantom-sticky").length > 0){
    //                 var topBarH = $(".top-bar").height();
    //             }else{
    //                 var topBarH = 0;
    //             }
    //                 //$scrollHeight = $(".project-post").height();
    //             var $scrollOffset = $(".project-post").offset();
    //             //var $headerHeight = $phantom.height();
    //             console.log($parentHeight, $floatContentHeight, $floatContent);
    //             $window.on("scroll", function () {
    //                 if (window.innerWidth > 1050) {
    //                     if (dtGlobals.winScrollTop + $phantom.height() > offset.top) {
    //                         if (dtGlobals.winScrollTop + $phantom.height() + $floatContentHeight + 40 < $scrollOffset.top + $parentHeight) {
    //                             $sidebar.stop().velocity({
    //                                 translateY : dtGlobals.winScrollTop - offset.top + $phantom.height() + 5 - topBarH
    //                             }, 300);
    //                         } else {
    //                             $sidebar.stop().velocity({
    //                                 translateY: $parentHeight - $floatContentHeight - 40 - topBarH
    //                             }, 300)
    //                         }
    //                     } else {
    //                         $sidebar.stop().velocity({
    //                             translateY: 0
    //                         }, 300)
    //                     }
    //                 } else {
    //                     $sidebar
    //                         .css({
    //                             "transform": "translateY(0)",
    //                             "-webkit-transform" : "translateY(0)",
    //                         });
    //                 }
    //             })
    //         }
    //     }, true);
    // }
    //     setFloatinProjectContent();
    
    $window.on("debouncedresize", function( event ) {
        // $parentHeight = $floatContent.siblings(".project-wide-col").height();
        // $floatContentHeight = $floatContent.height();
       // setFloatinProjectContent();
    
        
        //Set full height stripe
        $(".stripe").each(function(){
            var $_this = $(this),
                $_this_min_height = $_this.attr("data-min-height");
            if($.isNumeric($_this_min_height)){
                $_this.css({
                    "minHeight": $_this_min_height + "px"
                });
            }else if(!$_this_min_height){
                $_this.css({
                    "minHeight": 0
                });
            }else if($_this_min_height.search( '%' ) > 0){
                $_this.css({
                    "minHeight": $window.height() * (parseInt($_this_min_height)/100) + "px"
                });
            }else{
                $_this.css({
                    "minHeight": $_this_min_height
                });
            };
        });
    }).trigger( "debouncedresize" );
})