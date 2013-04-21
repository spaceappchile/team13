$(document).ready(function($) {
  $('#menu ul:first').aListToSelect({ 
    target: '#mobileMenu', 
    selectedClass : 'current', 
    hideList: false 
  });

  $('.select-main-menu').change(function(){
    location.href = $(this).children('option:selected').val();
  });

  data = [];
  for (i=1; i<120; i++) {
    number = Math.random()*50;
    data.push(number);
  }
  console.log(data);

  var plot1 = $.jqplot ('example', [data], {
    seriesColors: [ '#FFF' ],
    grid : {
      gridLineColor: '#DFDFDF',
      borderColor: '#444',
      borderWidth: 0.5,
      background: '#0F2E42'
    }
  });
});