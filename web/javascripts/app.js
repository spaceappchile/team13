$(document).ready(function($) {
  $('#menu ul:first').aListToSelect({ 
    target: '#mobileMenu', 
    selectedClass : 'current', 
    hideList: false 
  });

  $('.select-main-menu').change(function(){
    location.href = $(this).children('option:selected').val();
  });
});