$(document).ready(function() {

$(".show-alert").click(function(){  
  $(".alert-my-alert").show();
  $(".commission-text").hide();
});

$(".alert-my-alert").click(function(){
    $(".alert-my-alert").hide();
  $(".commission-text").show();
});

$(".join-tournament").click(function(){
    $(".join-tournament").hide();
  $(".join-btn-container").css("visibility", "visible");

});

/*End First*/




/* Start Page 2 */
// Go onpage JS
/* End Page 2 */



/*option*/
$(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});

$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});

$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
  });
  $(this).parents(".custom-select").toggleClass("opened");
  event.stopPropagation();
});

$(".custom-option").on("click", function() {
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
 
}); 

/*option end*/

$(".f12pdp9g").click(function () {
   // $(".f12pdp9g").removeClass("f12pdp9g-active");
    // $(".tab").addClass("active"); // instead of this do the below 
   //$(this).addClass("f12pdp9g-active");  
    
});

$(".f1u2s0am").click(function () {
    $(".f1u2s0am").removeClass("f6lrqsn");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("f6lrqsn");   
});

$(".f188ddnc").click(function () {
    $(".f188ddnc").removeClass("fd3g1lt");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("fd3g1lt");   
});

$(".f188ddncc").click(function () {
    $(".f188ddncc").removeClass("fd3g1lt");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("fd3g1lt");   
});

/*
$("#Select-time").click(function(){
  $(".timer-container").hide();
  $("#timer-section").show();
});
*/

$("#Select-time").click(function(){
  $("#myModal").modal('hide');
  $("#myModalTime").modal('show');
});


$(".back-to-hours").click(function(){
  $("#myModalTime").modal('hide');
  $("#myModal").modal('show');
});





$(".f188ddnc").click(function(){
    /*alert("Text: " + $(this).text());*/
    var hour =  $(this).text()
    $(".exact-hour").text(hour);
    $("#exact_hour").val(hour);
    
  });
  
$(".f188ddncc").click(function(){
    /*alert("Text: " + $(this).text());*/
    var minutes =  $(this).text()
    $(".exact-minutes").text(minutes);
    $("#exact_minutes").val(minutes);
    
  });
$(".f1u2s0am").click(function(){
    /*alert("Text: " + $(this).text());*/
    var time =  $(this).text()
    $(".am-pm").text(time);
	$("#exact_ampm").val(time);
    
  });
  
  
$("#time-selected").click(function () {    
    //$(".btn-bottom").css("background", "#3e51b5");    
    $(".btn-bottom").addClass("btn-active"); 
	var hour = $("#exact_hour").val();
	var minutes = $("#exact_minutes").val();
	var ampm = $("#exact_ampm").val();
	var timeTXT = hour+":"+minutes+" "+ampm;
	$("#hours_minutes").empty();
    $("#hours_minutes").append(timeTXT);
	

});




});