$(document).ready(function($) {
  data = [];
  for (i=1; i<120; i++) {
    number = Math.random()*50;
    data.push(number);
  }
  console.log(data);

  var plot1 = $.jqplot ('example', [data], {
    seriesColors: [ '#7597B9' ],
    grid : {
      gridLineColor: '#DFDFDF',
      borderColor: '#444',
      borderWidth: 0.5,
      background: '#FFF'
    }
  });
});