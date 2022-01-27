"use strict";

/**
 *	Custom jQuery Scripts
 *	Date Modified: 01.20.2022
 *	Developed by: Lisa DeBona
 */
jQuery(document).ready(function ($) {
  $(".sponsorInfo").hover(function () {
    var target = $(this); // $.ajax({
    //   url : frontajax.ajaxurl,
    //   type : 'post',
    //   dataType : "json",
    //   data : {
    //     action : 'get_posttype_content',
    //     postid : target.attr("data-id")
    //   },
    //   beforeSend:function(){
    //     // $("#loaderdiv").show();
    //     // target.attr("data-pg", nextpage);
    //     // if(nextpage>total) {
    //     //   $('.loadmore').remove();
    //     // } 
    //   },
    //   success : function( response ) {
    //     if(response.content) {
    //       $("#sponsor-details").html(response.content);
    //       $("#sponsor-details-popup").fadeIn();
    //       $(".sponsor-wrap").addClass('fadeIn');
    //     }
    //   },
    //   complete: function() {
    //     //$("#loaderdiv").hide();
    //     $("#close-info").on("click",function(e){
    //       e.preventDefault();
    //       $("#sponsor-details-popup").fadeOut();
    //     });
    //   }
    // });
  }, function () {
    var target = $(this);
  });
});