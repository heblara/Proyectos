// Jquery with no conflict
var $x=jQuery.noConflict();
jQuery(document).ready(function($x) {
	
    // nivo slider ------------------------------------------------------ //
	
    $x('#slider').nivoSlider({
        effect:'random', //Specify sets like: 'fold,fade,sliceDown'
        slices:15,
        animSpeed:500, //Slide transition speed
        pauseTime:3000,
        startSlide:0, //Set starting Slide (0 index)
        directionNav:true, //Next & Prev
        directionNavHide:true, //Only show on hover
        controlNav:true, //1,2,3...
        controlNavThumbs:false, //Use thumbnails for Control Nav
        controlNavThumbsFromRel:false, //Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', //Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
        keyboardNav:true, //Use left & right arrows
        pauseOnHover:true, //Stop animation while hovering
        manualAdvance: false, //Force manual transitions
        captionOpacity:0.7 //Universal caption opacity
    });
	
    // Poshytips ------------------------------------------------------ //
	
    $x('.poshytip').poshytip({
        className: 'tip-twitter',
        showTimeout: 1,
        alignTo: 'target',
        alignX: 'center',
        offsetY: 5,
        allowTipHover: false
    });
    
    
    // Poshytips Forms ------------------------------------------------------ //
    
    $x('.form-poshytip').poshytip({
        className: 'tip-yellowsimple',
        showOn: 'focus',
        alignTo: 'target',
        alignX: 'right',
        alignY: 'center',
        offsetX: 5
    });
	 
    // Superfish menu ------------------------------------------------------ //
	
    $x("ul.sf-menu").superfish({ 
        animation: {
            height:'show'
        },   // slide-down effect without fade-in 
        delay:     800               // 1.2 second delay on mouseout 
    });
    
    // Scroll to top ------------------------------------------------------ //
    
    $x('#to-top').click(function(){
        $x.scrollTo( {
            top:'0px', 
            left:'0px'
        }, 300 );
    });
		
    // Submenu rollover --------------------------------------------- //
	
    $x("ul.sf-menu>li>ul li").hover(function() { 
        // on rollover	
        $x(this).children('a').children('span').stop().animate({ 
            marginLeft: "3" 
        }, "fast");
    } , function() { 
        // on out
        $x(this).children('a').children('span').stop().animate({
            marginLeft: "0" 
        }, "fast");
    });
	
	
    // Tweet Feed ------------------------------------------------------ //
	
    $x("#tweets").tweet({
        count: 3,
        username: "ansimuz",
        callback: tweet_cycle
    });
	
    // Tweet arrows rollover --------------------------------------------- //
	
    $x("#twitter #prev-tweet").hover(function() { 
        // on rollover	
        $x(this).stop().animate({ 
            left: "27" 
        }, "fast");
    } , function() { 
        // on out
        $x(this).stop().animate({
            left: "30" 
        }, "fast");
    });
	
    $x("#twitter #next-tweet").hover(function() { 
        // on rollover	
        $x(this).stop().animate({ 
            right: "27" 
        }, "fast");
    } , function() { 
        // on out
        $x(this).stop().animate({
            right: "30" 
        }, "fast");
    });
	
    // Tweet cycle --------------------------------------------- //
	
    function tweet_cycle(){
        $x('#tweets .tweet_list').cycle({ 
            fx:     'scrollHorz', 
            speed:  500, 
            timeout: 0, 
            pause: 1,
            next:   '#twitter #next-tweet', 
            prev:   '#twitter #prev-tweet' 
        });
    }
	
    // tabs ------------------------------------------------------ //
	
    $x("ul.tabs").tabs("div.panes > div", {
        effect: 'fade'
    });
	
    // Thumbs rollover --------------------------------------------- //
	
    $x('.thumbs-rollover li a img').hover(function(){
        // on rollover
        $x(this).stop().animate({ 
            opacity: "0.5" 
        }, "fast");
    } , function() { 
        // on out
        $x(this).stop().animate({
            opacity: "1" 
        }, "fast");
    });
	
    // Resize home top-padding ------------------------------------------------------ //
	
    //$x('#headline-gap').height($x('#headline').height());
    $x('.home #header').height($x('#headline').height() + 430);
	
	
    // Blog posts rollover --------------------------------------------- //
	
    $x('#posts .post').hover(function(){
        // on rollover
        $x(this).children('.thumb-shadow').children('.post-thumbnail').children(".cover").stop().animate({ 
            left: "312"
        }, "fast");
    } , function() { 
        // on out
        $x(this).children('.thumb-shadow').children('.post-thumbnail').children(".cover").stop().animate({
            left: "0" 
        }, "fast");
    });
	
    // Portfolio projects rollover --------------------------------------------- //
	
    $x('#projects-list .project').hover(function(){
        // on rollover
        $x(this).children('.project-shadow').children('.project-thumbnail').children(".cover").stop().animate({ 
            top: "133"
        }, "fast");
    } , function() { 
        // on out
        $x(this).children('.project-shadow').children('.project-thumbnail').children(".cover").stop().animate({
            top: "0" 
        }, "fast");
    });
	
    // Sidebar rollover --------------------------------------------------- //

    $x('#sidebar>li>ul>li').hover(function(){
        // over
        $x(this).children('a').stop().animate({
            marginLeft: "5"
        }, "fast");
    } , function(){
        // out
        $x(this).children('a').stop().animate({
            marginLeft: "0"
        }, "fast");
    });
	
    // Fancybox --------------------------------------------------- //
	
    $x("a.fancybox").fancybox({ 
        'overlayColor':	'#000'
    });
	
    // pretty photo  ------------------------------------------------------ //
	
    $x("a[rel^='prettyPhoto']").prettyPhoto();


    // Project gallery over --------------------------------------------- //
	
    $x('.project-gallery li a img').hover(function(){
        // on rollover
        $x(this).stop().animate({ 
            opacity: "0.5" 
        }, "fast");
    } , function() { 
        // on out
        $x(this).stop().animate({
            opacity: "1" 
        }, "fast");
    });
	
	
    // Thumbs functions ------------------------------------------------------ //
	
    function thumbsFunctions(){
	
        // prettyphoto
		
        $x("a[rel^='prettyPhoto']").prettyPhoto();
						
        // Fancy box
        $x("a.fancybox").fancybox({ 
            'overlayColor'		:	'#000'
        });
		
        // Gallery over 
	
        $x('.gallery li a img').hover(function(){
            // on rollover
            $x(this).stop().animate({ 
                opacity: "0.5" 
            }, "fast");
        } , function() { 
            // on out
            $x(this).stop().animate({
                opacity: "1" 
            }, "fast");
        });
		
        // tips
		
        $x('.gallery a').poshytip({
            className: 'tip-twitter',
            showTimeout: 1,
            alignTo: 'target',
            alignX: 'center',
            offsetY: -15,
            allowTipHover: false
        });
		
    }
    // init
    thumbsFunctions();
	
    // Quicksand -----------------------------------------------------------//
	
    // get the initial (full) list
    var $xfilterList = $x('ul#portfolio-list');
		
    // Unique id 
    for(var i=0; i<$x('ul#portfolio-list li').length; i++){
        $x('ul#portfolio-list li:eq(' + i + ')').attr('id','unique_item' + i);
    }
	
    // clone list
    var $xdata = $xfilterList.clone();
	
    // Click 
    $x('#portfolio-filter a').click(function(e) {
        if($x(this).attr('rel') == 'all') {
            // get a group of all items
            var $xfilteredData = $xdata.find('li');
        } else {
            // get a group of items of a particular class
            var $xfilteredData = $xdata.find('li.' + $x(this).attr('rel'));
        }
		
        // call Quicksand
        $x('ul#portfolio-list').quicksand($xfilteredData, {
            duration: 500,
            attribute: function(v) {
                // this is the unique id attribute we created above
                return $x(v).attr('id');
            }
        }, function() {
            // restart thumbs functions
            thumbsFunctions();
        });
        // remove # link
        e.preventDefault();
    });

		
    // UI Accordion ------------------------------------------------------ //
	
    $x( ".accordion" ).accordion();
	
    // Toggle box ------------------------------------------------------ //
	
    $x(".toggle-container").hide(); 
    $x(".toggle-trigger").click(function(){
        $x(this).toggleClass("active").next().slideToggle("slow");
        return false;
    });
		
//close			
});
	
// search clearance	
function defaultInput(target){
    if((target).value == 'Search...'){
        (target).value=''
        }
}

function clearInput(target){
    if((target).value == ''){
        (target).value='Search...'
        }
}



