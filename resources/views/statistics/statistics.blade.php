@extends('admin_template')

@section('content')
<center> <h1>Statistics</h1></center>
<br>
<div class="row">
<div class="col-md-6" id="pieChart" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<div class="col-md-6" id="lineChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
<br>
<div class="row">
<div class="col-md-6" id="countries" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<div class="col-md-6" id="top" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
</div>
<script>
Highcharts.chart('pieChart', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Male - Female Reservation​'
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
    },]
  }]
});

Highcharts.chart('lineChart', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Reservations Revenue 2018'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: '[Revenue ($)]'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Revenue',
        data:[parseInt(<?php echo $jan; ?>), parseInt(<?php echo $feb; ?>), parseInt(<?php echo $mar; ?>), parseInt(<?php echo $apr; ?>), parseInt(<?php echo $may; ?>), parseInt(<?php echo $jun; ?>), parseInt(<?php echo $jul; ?>), parseInt(<?php echo $aug; ?>), parseInt(<?php echo $sep; ?>), parseInt(<?php echo $oct; ?>), parseInt(<?php echo $nov; ?>), parseInt(<?php echo $dec; ?>)]
    }]
});






Highcharts.chart('countries', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Countries Reservation​'
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
    data: [

    @foreach($countries as $c)
    {
       name: '{{ $c->co }}',
       y: {{ $c->c }} ,
     },
    @endforeach
    
    ]
  }]
});



Highcharts.chart('top', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Top 10 Reservation Clients​'
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
    data: [

    @foreach($top as $t)
    {
       name: '{{ $t->co }}',
       y: {{ $t->c }} ,
     },
    @endforeach
    
    ]
  }]
});



</script>



 @endsection
