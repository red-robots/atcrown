/**
 *	Custom jQuery Scripts
 *	Date Modified: 01.20.2022
 *	Developed by: Lisa DeBona
 */
 
jQuery(document).ready(function ($) {
  
  if( $('.embed-youtube').length ) {
    $('.embed-youtube').each(function(){
      $(this).append('<img class="video-resizer" src="'+assets+'/images/video-resizer.png" alt="">');
    });
  }

  $(document).on('click','.sponsorInfo',function(e){
    e.preventDefault();
    var target = $(this);
    target.addClass('active');
    $.ajax({
      url : frontajax.ajaxurl,
      type : 'post',
      dataType : "json",
      data : {
        action : 'get_posttype_content',
        postid : target.attr("data-id")
      },
      beforeSend:function(){
        $("#loaderdiv").show();
      },
      success : function( response ) {
        if(response.content) {
          $("#sponsor-details").html(response.content);
          $("#sponsor-details-popup").fadeIn();
          //$(".sponsor-wrap").addClass('fadeIn').css('background-image','url('+imgURL+')');
          //var img = '<img src="'+imgURL+'" alt="" class="sponsor-logo-img">';
          //$(img).appendTo(".sponsor-wrap");
          //$('.sponsor-wrap .sponsorLogo').html(img);
        }
      },
      complete: function() {
        $("#loaderdiv").hide();
        $(document).on("click","#close-info",function(e){
          e.preventDefault();
          $("#sponsor-details-popup").hide();
          $(".sponsor-wrap").removeClass('fadeIn');
          $("#sponsor-details").html("");
          $(".sponsorInfo").removeClass('active');
        });
        $(document).on('click', function (e) {
          if ($(e.target).closest(".sponsor-wrap").length === 0) {
            $("#sponsor-details-popup").hide();
            $(".sponsor-wrap").removeClass('fadeIn');
            $("#sponsor-details").html("");
          }
        });
        $(document).on("click","#sponsor-details-popup",function(e){
          $(".sponsorInfo").removeClass('active');
        });
      }
    });
  });


  $('#sponsors-slider').owlCarousel({
    loop:true,
    autoplay:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        400:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
  });



}); 