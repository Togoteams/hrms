$(document).ready(function() {
    if($('body').hasClass("select2")){
      $(".select2").select2();
    }
    $( ".addRole" ).click(function() {
      console.log("sdhsj");
      $('.formsubmit').trigger("reset");
    });
  });