@extends('admin_template')

@section('content')
<center> <h1>Statistics</h1></center>

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>


<script>
Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Males Vs. Females Reservations'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'Male',
      y: parseInt(<?php echo $male; ?>),
      sliced: true,
      selected: true
    },{
      name: 'Female',
      y: parseInt(<?php echo $female; ?>)
    }]
  }]
});
</script>



 @endsection
