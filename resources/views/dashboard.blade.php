@extends('layouts.app')

@section('content')


<div class="container" style="float:center ;">
    <div class="col-sm-12">
        <div class="card"><br>
            <h3 class="text-center">Total de Datos Hasta la Fecha</h3>
            <div class="card-body">
                <form action="{{ '/dashboard2' }}" target="_blank" method="GET">

                    <input type="date" required name="fechaini" id="">

                    <input type="date" required name="fechafin" id="">

                    <button type="submit" class="btnblue2"><i class="bi bi-search"></i>Ver Reporte</button>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<div class="container charts">  
    <input type="color" id="colorC1" value="#148C3A" title="Color"> 
    <input type="color" id="colorC2" value="#063F95" title="Color">
    <div id="donutcumplimiento"></div>
    <table class="table">
        <thead>
            <tr>
                <th>Total Items que Cumplen</th>
                <th>Total Items que No Cumplen</th>
                <th>Total Items Auditados</th>
            </tr>
        </thead>
        <tbody>
            <th>{{$tc}}</th>
            <td>{{$tnc}}</td>
            <td>{{$totalitems}}</td>
            </tr>
        </tbody>
    </table>
</div>


<div class="card">
    <label for="colorServ">Color</label>
    <input type="color" id="colorServ" value="#063F95">
    <div class="container charts">
        <div id="servicios" class="charts"></div>


        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Items que Cumplen</th>
                    <th>Items que no cumplen</th>
                </tr>
            </thead>
            <tbody> @foreach ($datosServicio as $item)
                <tr>
                    <td>{{ $item['servicio'] }}</td>
                    <td>{{ $item['totalcumple'] }}</td>
                    <td>{{ $item['totalnocumple'] }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

</div>

<div class="card">

    <label for="colorCarg">Color</label>
    <input type="color" id="colorCarg" value="#148C3A">
    <div class="container charts">
        <div id="cargos" class="charts"></div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Cargo</th>
                    <th>Items que Cumplen</th>
                    <th>Items que No cumplen</th>
                </tr>
            </thead>
            <tbody> @foreach ($datosCargo as $item)
                <tr>
                    <td>{{ $item['cargo'] }}</td>
                    <td>{{ $item['totalcumple'] }}</td>
                    <td>{{ $item['totalnocumple'] }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card">

    <label for="colorEst">Color</label>
    <input type="color" id="colorEst" value="#063F95">
    <div class="container charts">
        <div id="estrategias" class="charts"></div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Estrategia</th>
                    <th>Items que Cumplen</th>
                    <th>Items que No cumplen</th>
                </tr>
            </thead>
            <tbody> @foreach ($datosEstrategia as $item)
                <tr>
                    <td>{{ $item['estrategia'] }}</td>
                    <td>{{ $item['totalcumple'] }}</td>
                    <td>{{ $item['totalnocumple'] }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    google.charts.load('current', {
        callback: drawChartcumplen,
        packages: ['corechart']
    });
    google.charts.load('current', {
        callback: drawChartservicio,
        packages: ['corechart']
    });
    google.charts.load('current', {
        callback: drawChartcargo,
        packages: ['corechart']
    });
    google.charts.load('current', {
        callback: drawChartestrategia,
        packages: ['corechart']
    });

    var color1d = '#148C3A';
    var color2d = '#063F95';
    var colorgs = '#063F95';
    var colorgc = '#148C3A';
    var colorge = '#063F95';

    function drawChartcumplen() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            ['Cumple', <?php echo $totalcum; ?>],
            ['No Cumple', <?php echo $totalnocum; ?>]

        ]);

        // Set chart options
        var options = {
            'title': 'Proporción de Adherencia Global',
            colors: [color1d, color2d],
            pieHole: 0.3,
            'width': 400,
            'height': 400
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('donutcumplimiento'));
        chart.draw(data, options);

        var colorC1 = document.getElementById('colorC1');


        colorC1.addEventListener('input', function() {
            // Actualiza la variable de color y el gráfico con el nuevo color seleccionado
            color1d = colorC1.value;
            options.colors[0] = color1d;
            chart.draw(data, options);
        });
        var colorC2 = document.getElementById('colorC2');

        colorC2.addEventListener('input', function() {
            // Actualiza la variable de color y el gráfico con el nuevo color seleccionado          
            color2d = colorC2.value;
            options.colors[1] = color2d;
            chart.draw(data, options);
        });
    }

    ///////////grafico barra servicio
    function drawChartservicio() {

        var data = google.visualization.arrayToDataTable([

            ['', '', ],

            <?php foreach ($datosServicio as $item) { ?>

                ['<?php echo $item['servicio']; ?>', <?php echo  $item['cumplimiento']; ?>],
            <?php
            }
            ?>['', 0]
        ]);

        var groupData = google.visualization.data.group(
            data,
            [{
                column: 0,
                modifier: function() {
                    return 'total'
                },
                type: 'string'
            }],
            [{
                column: 1,
                aggregation: google.visualization.data.sum,
                type: 'number'
            }]
        );

        var formatPercent = new google.visualization.NumberFormat({
            pattern: '%'
        });

        var formatShort = new google.visualization.NumberFormat({
            pattern: 'short'
        });

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1, {
            calc: function(dt, row) {
                var amount = formatShort.formatValue(dt.getValue(row, 1));
                var percent = formatPercent.formatValue(dt.getValue(row, 1));
                return amount + '%';
            },
            type: 'string',
            role: 'annotation'
        }]);

        var options = {
            annotations: {
                alwaysOutside: true
            },
            title: 'Proporción de Adherencia Global por Servicio ',
            responsive: true,
            width: 800,
            height: 1200,
            colors: [colorgs],

        };

        var chart = new google.visualization.BarChart(document.getElementById('servicios'));
        chart.draw(view, options);

        var colorServ = document.getElementById('colorServ');
        colorServ.addEventListener('input', function() {
            // Actualiza la variable de color y el gráfico con el nuevo color seleccionado
            colorgs = colorServ.value;
            options.colors[0] = colorgs;
            chart.draw(view, options);
        });
    }

    ////////////grafico barra servicio
    function drawChartcargo() {

        var data = google.visualization.arrayToDataTable([

            ['', '', ],

            <?php foreach ($datosCargo as $item) { ?>

                ['<?php echo $item['cargo']; ?>', <?php echo  $item['cumplimiento']; ?>],
            <?php
            }
            ?>['', 0]
        ]);

        var groupData = google.visualization.data.group(
            data,
            [{
                column: 0,
                modifier: function() {
                    return 'total'
                },
                type: 'string'
            }],
            [{
                column: 1,
                aggregation: google.visualization.data.sum,
                type: 'number'
            }]
        );

        var formatPercent = new google.visualization.NumberFormat({
            pattern: '%'
        });

        var formatShort = new google.visualization.NumberFormat({
            pattern: 'short'
        });

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1, {
            calc: function(dt, row) {
                var amount = formatShort.formatValue(dt.getValue(row, 1));
                var percent = formatPercent.formatValue(dt.getValue(row, 1));
                return amount + '%';
            },
            type: 'string',
            role: 'annotation'
        }]);

        var options = {
            annotations: {
                alwaysOutside: true
            },
            title: 'Proporción de Adherencia Global por Cargo ',
            responsive: true,
            width: 800,
            height: 1200,
            colors: [colorgc],
            chartArea: {
                width: '50%'
            },
        };
        var chart = new google.visualization.BarChart(document.getElementById('cargos'));
        chart.draw(view, options);

        var colorCarg = document.getElementById('colorCarg');
        colorCarg.addEventListener('input', function() {
            // Actualiza la variable de color y el gráfico con el nuevo color seleccionado
            colorgc = colorCarg.value;
            options.colors[0] = colorgc;
            chart.draw(view, options);
        });
    }

    ////////////grafico barra estrategias
    function drawChartestrategia() {

        var data = google.visualization.arrayToDataTable([

            ['', '', ],

            <?php foreach ($datosEstrategia as $item) { ?>

                ['<?php echo $item['estrategia']; ?>', <?php echo  $item['cumplimiento']; ?>],
            <?php
            }
            ?>['', 0]
        ]);

        var groupData = google.visualization.data.group(
            data,
            [{
                column: 0,
                modifier: function() {
                    return 'total'
                },
                type: 'string'
            }],
            [{
                column: 1,
                aggregation: google.visualization.data.sum,
                type: 'number'
            }]
        );

        var formatPercent = new google.visualization.NumberFormat({
            pattern: '%'
        });

        var formatShort = new google.visualization.NumberFormat({
            pattern: 'short'
        });

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1, {
            calc: function(dt, row) {
                var amount = formatShort.formatValue(dt.getValue(row, 1));
                var percent = formatPercent.formatValue(dt.getValue(row, 1));
                return amount + '%';
            },
            type: 'string',
            role: 'annotation'
        }]);

        var options = {
            annotations: {
                alwaysOutside: true
            },
            title: 'Proporción de Adherencia Global por Estrategia ',
            responsive: true,
            width: 800,
            height: 1200,
            colors: [colorge],
            chartArea: {
                width: '50%'
            },
        };
        var chart = new google.visualization.BarChart(document.getElementById('estrategias'));
        chart.draw(view, options);

        var colorEst = document.getElementById('colorEst');
        colorEst.addEventListener('input', function() {
            // Actualiza la variable de color y el gráfico con el nuevo color seleccionado
            colorge = colorEst.value;
            options.colors[0] = colorge;
            chart.draw(view, options);
        });
    }
</script>
@endsection