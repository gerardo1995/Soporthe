@extends('layouts.app')
@section('content')
<link href="{{ asset('css/boss_menu.css') }}" rel="stylesheet">
<link href="{{ asset('css/menu_empleado.css') }}" rel="stylesheet">
<div class="main">
  <div class="row row-header" style="">
    <h5 class="header" style="">Tareas verificadas por departamento</h5>
  </div>
  <div class="row" style="height: 95%">
    <div class="form-container">
      <br><br>
      <fieldset>
        <legend>Filtrado por fecha</legend>
        <br>
        <div>
          <form action="{{ route('boss index') }}" method="GET" id="dates">
            @csrf
            <label for="date1">Desde: </label>
            <input type="date" id="date1"  max="{{ date('Y-m-d') }}" name="date1"  value="{{ $date1 }}">
            <br><br>
            <label for="date2">Hasta: </label>
            <input type="date" id="date2" name="date2"  max="{{ date('Y-m-d') }}" value="{{ $date2 }}">
            <br><br>
            <button type="submit" class="btn btn-normal">Buscar</button>
          </form>
        </div>
      </fieldset>
    </div>
    <div class="col" id="chartPie" style="height: 550px; overflow: auto; margin-bottom: 30px">

    </div>
    <div style=" position: relative; right: 30px; top: 10px; ">
      <form action="{{ route('boss.pdf') }}" method="get">
        @csrf
        <input type="hidden" name="date1" value="{{ $date1 }}">
        <input type="hidden" name="date2" value="{{ $date2 }}">
        <button type="submit" class="btn btn-pdf" style="background-color: transparent;"></button>
      </form>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.1.0/echarts.min.js"></script>
<script>
$(function() {
    'use strict'
    //pie chart
    var pieData = [{
        name: 'Tareas verificadas por departamento',
        type: 'pie',
        radius: '80%',
        center: ['49%', '50.5%'],
        data: <?php echo json_encode($Data); ?>,
        label: {
            normal: {
                fontFamily: 'Tillium Web, sans-serif',
                fontSize: 20
            }
        },
        labelLine: {
            normal: {
                show: false
            }
        },
        markLine: {
            lineStyle: {
                normal: {
                    width: 1
                }
            }
        }
    }];
    var pieOption = {
        tooltip: {
            trigger: 'item',
            formatter: '{b}: {c} ({d}%)',
            textStyle: {
                fontSize: 16,
                fontFamily: 'Tillium Web, sans-serif'
            }
        },
        legend: {},
        series: pieData
    };
    var pie = document.getElementById('chartPie');
    var pieChart = echarts.init(pie);
    pieChart.setOption(pieOption);
});
</script>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Ingrese una fecha coherente.");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
})
</script>
@endsection