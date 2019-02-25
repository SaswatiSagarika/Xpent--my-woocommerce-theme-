// JavaScript Document

(function($){
jQuery(function() {
 "use strict";

  function responsive_dropdown () {
    /* ---- For Mobile Menu Dropdown JS Start ---- */
      jQuery("#menu span.opener, #menu-main span.opener").on("click", function() {
        if (jQuery(this).hasClass("plus")) {
          jQuery(this).parent().find('.mobile-sub-menu').slideDown();
          jQuery(this).removeClass('plus');
          jQuery(this).addClass('minus');
        }
        else
        {
          jQuery(this).parent().find('.mobile-sub-menu').slideUp();
          jQuery(this).removeClass('minus');
          jQuery(this).addClass('plus');
        }
        return false;
      });

      jQuery( ".mobilemenu" ).click(function() {
     jQuery( ".mobilemenu-content" ).slideToggle();
    });
    /* ---- For Mobile Menu Dropdown JS End ---- */
    /* ---- For Sidebar JS Start ---- */
      jQuery('.sidebar-box span.opener').on("click", function(){
      
        if (jQuery(this).hasClass("plus")) {
          jQuery(this).parent().find('.sidebar-contant').slideDown();
          jQuery(this).removeClass('plus');
          jQuery(this).addClass('minus');
        }
        else
        {
          jQuery(this).parent().find('.sidebar-contant').slideUp();
          jQuery(this).removeClass('minus');
          jQuery(this).addClass('plus');
        }
        return false;
      });
    /* ---- For Sidebar JS End ---- */
    /* ---- For Footer JS Start ---- */
      jQuery('.footer-static-block span.opener').on("click", function(){
      
        if (jQuery(this).hasClass("plus")) {
          jQuery(this).parent().find('.footer-block-contant').slideDown();
          jQuery(this).removeClass('plus');
          jQuery(this).addClass('minus');
        }
        else
        {
          jQuery(this).parent().find('.footer-block-contant').slideUp();
          jQuery(this).removeClass('minus');
          jQuery(this).addClass('plus');
        }
        return false;
      });
    /* ---- For Footer JS End ---- */

    /* ---- For Navbar JS Start ---- */
    jQuery('.navbar-toggle').on("click", function(){
      var menu_id = jQuery('#menu');
      var nav_icon = jQuery('.navbar-toggle i');
      if(menu_id.hasClass('menu-open')){
        menu_id.removeClass('menu-open');
        nav_icon.removeClass('fa-close');
        nav_icon.addClass('fa-bars');
      }else{
        menu_id.addClass('menu-open');
        nav_icon.addClass('fa-close');
        nav_icon.removeClass('fa-bars');
      }
    });
    /* ---- For Navbar JS End ---- */
    /* ---- For Category Dropdown JS Start ---- */
    jQuery('.btn-sidebar-menu-dropdown').on("click", function() {
      jQuery('.cat-dropdown').toggle();
    });
    /* ---- For Category Dropdown JS End ---- */
  }

  function owlcarousel_slider () {
    /* ------------ OWL Slider Start  ------------- */
      /* ----- pro_cat_slider Start  ------ */
      jQuery('.pro_cat_slider').owlCarousel({
        items: 4,
        navigation: true,
        pagination: false,
        itemsDesktop : [1199, 4],
        itemsDesktopSmall : [991, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 2]
      });
      /* ----- pro_cat_slider End  ------ */
      /* ----- brand-logo Start  ------ */
      jQuery('#brand-logo').owlCarousel({
        items: 5,
        navigation: true,
        pagination: false,
        itemsDesktop : [1199, 3],
        itemsDesktopSmall : [991, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 1]
      });
      /* ----- brand-logo End  ------ */
      /* ----- special-pro Start  ------ */
      jQuery('#special-pro').owlCarousel({
        items: 1,
        navigation: true,
        pagination: false,
        itemsDesktop : [1199, 1],
        itemsDesktopSmall : [991, 1],
        itemsTablet : [768, 1],
        itemsTabletSmall : false,
        itemsMobile : [479, 1]
      });
      /* ----- special-pro End  ------ */
      /* ----- News Start  ------ */
      jQuery('#news').owlCarousel({
        items: 1,
        navigation: false,
        pagination: true,
        itemsDesktop : [1199, 1],
        itemsDesktopSmall : [991, 2],
        itemsTablet : [768, 2],
        itemsTabletSmall : [600, 2],
        itemsMobile : [479, 1]
      });
      /* ----- News End  ------ */
      /* ---- Testimonial Start ---- */
      jQuery(".main-banner").owlCarousel({
     
        //navigation : true,  Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        autoPlay: false,
        pagination:false,
        singleItem:true,
        navigation:true
      });
      /* ----- Testimonial End  ------ */
      /* ---- Testimonial Start ---- */
      jQuery("#client").owlCarousel({
     
        //navigation : true,  Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        autoPlay: false,
        pagination:true,
        singleItem:true,
        navigation:false
      });
      /* ----- Testimonial End  ------ */
    /* ------------ OWL Slider End  ------------- */
  }

  function scrolltop_arrow () {
   /* ---- Page Scrollup JS Start ---- */
   //When distance from top = 250px fade button in/out
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 250) {
            jQuery('#scrollup').fadeIn(300);
        } else {
            jQuery('#scrollup').fadeOut(300);
        }
    });
    //On click scroll to top of page t = 1000ms
    jQuery('#scrollup').on("click", function(){
        jQuery("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });
    /* ---- Page Scrollup JS End ---- */
  }

  function custom_tab() {
   /* ----------- product category Tab Start  ------------ */
    jQuery('.tab-stap').on('click', 'li', function() {
        jQuery('.tab-stap li').removeClass('active');
        jQuery(this).addClass('active');
        
        jQuery(".product-slider-main").fadeOut();
        var currentLiID = jQuery(this).attr('id');
        jQuery("#data-"+currentLiID).fadeIn();
        return false;
    });
    /* ------------ product category Tab End  ------------ */
    /* ------------ Account Tab JS Start ------------ */
    jQuery('.account-tab-stap').on('click', 'li', function() {
        jQuery('.account-tab-stap li').removeClass('active');
        jQuery(this).addClass('active');
        
        jQuery(".account-content").fadeOut();
        var currentLiID = jQuery(this).attr('id');
        jQuery("#data-"+currentLiID).fadeIn();
        return false;
    });
    /* ------------ Account Tab JS End ------------ */
  }

  function setminheight() {
    jQuery( ".pro_cat" ).css("min-height",jQuery(".product-slider-main").height() );
    jQuery( ".pro-detail-main" ).css("min-height",jQuery(".special-products-block").height() );
  }

  /* Price-range Js Start */
  function price_range () {
      jQuery( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 800,
      values: [ 75, 500 ],
      slide: function( event, ui ) {
      jQuery( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
      });
      jQuery( "#amount" ).val( "$" + jQuery( "#slider-range" ).slider( "values", 0 ) +
      " - $" + jQuery( "#slider-range" ).slider( "values", 1 ) );
  }
  /* Price-range Js End */

  /*Video_Popup Js Start*/
  function video_popup() {
    if(jQuery('.popup-youtube').length > 0){      
    jQuery('.popup-youtube').magnificPopup({          
        disableOn: 700,          
        type: 'iframe',          
        mainClass: 'mfp-fade',          
        removalDelay: 160,          
        preloader: false,          
        fixedContentPos: false      
      });    
    }  
  }
  /*Video_Popup Js Ends*/

  /* Product Detail Page Tab JS Start */
  function description_tab () {
    jQuery("#tabs li a").on("click", function(e){
      var title = jQuery(e.currentTarget).attr("title");
      jQuery("#tabs li a").removeClass("selected")
      jQuery(".tab_content li div").removeClass("selected")
      jQuery(".tab-"+title).addClass("selected")
      jQuery(".items-"+title).addClass("selected")
      jQuery("#items").attr("class","tab-"+title);

      return false;
    });
  }
  /* Product Detail Page Tab JS End */
  jQuery(document).ready(function() {
    owlcarousel_slider(); price_range (); responsive_dropdown(); description_tab (); custom_tab (); scrolltop_arrow (); video_popup();
  });

  jQuery( window ).on( "resize", function() {
    
  });
});

  jQuery( window ).on( "load", function() {
    // Animate loader off screen
    jQuery(".xpent-loader").fadeOut("slow");

  });

jQuery(document).ready(function(){

  jQuery('.page-scroll').hover( function(){
    jQuery('.megamenu ').slideDown(1000);
  });

});
}
