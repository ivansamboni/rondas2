@extends('layouts.app')

@section('content')

<br><br>

<h3 class="text-center">Datos desde {{\Carbon\Carbon::parse($fechaini)->format('d/m/Y')}} Hasta {{\Carbon\Carbon::parse($fechafin)->format('d/m/Y')}}</h3><br><br><br>

<div class="container charts">
    <form action="{{ '/dashboard3' }}" target="_blank" method="GET">

        <label for="servicio">Servicio</label>
        <select name="servicio" id="">
            <?php foreach ($servicios as $servicio) { ?>
                <option value="<?php echo $servicio['servicio'] ?>"><?php echo $servicio['servicio'] ?></option>
            <?php } ?>
        </select>

        <input type="date" hidden name="fechaini" value="{{$fechaini}}">
        <input type="date" hidden name="fechafin" value="{{$fechafin}}">

        <button type="submit" class="btnblue2"><i class="bi bi-search"></i>Ver Reporte</button>
    </form>
</div>
<br>

<div class="container charts">
   
    <input type="color" id="colorC1" value="#148C3A">
    <input type="color" id="colorC2" value="#063F95">

    <div id="donutcumplimiento"></div>
    <br><br>

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
<hr>
<br>
<br>
<div class="container">

    <table class="table table-striped" id="miTabla">
        <thead>
            <h4 class="text-center">Proporción de Adherencia global por items</h4><br>
            <input id="filtro" type="text" placeholder="filtrar"><br><br>
            <select id="filtro2">
                <option value="">Vacío</option>
                <?php foreach ($datosEstrategia as $item) { ?>
                    <option value="<?php echo $item['estrategia']; ?>"><?php echo $item['estrategia']; ?></option>
                <?php } ?>
            </select>
            <br><br>
            <tr>
                <th>
                    <h4>Estrategia</h4>
                </th>
                <th>
                    <h4>Item</h4>
                </th>
                <th>
                    <h4>Cumplimiento</h4>
                </th>
                <th>
                    <h4>%</h4>
                </th>
            </tr>
        </thead>
        <tbody><?php foreach ($datosPregunta as $item) { ?>
                <tr>
                    <td><strong><?php echo $item['estrategia']; ?></strong></td>
                    <td><?php echo $item['item']; ?></td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width:<?php echo $item['cumplimiento']; ?>%;" aria-valuenow="<?php echo $item['cumplimiento']; ?>" aria-valuemin="1" aria-valuemax="100"> </div>
                        </div>
                    </td>
                    <td><?php echo $item['cumplimiento']; ?>%</td>
                <?php } ?>
                </tr>
        </tbody>
    </table>
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
            chartArea: {
                width: '50%'
            },
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
<script>
    const filtroSelect = document.getElementById('filtro2');
    const filtroInput = document.getElementById('filtro');
    const tabla = document.getElementById('miTabla');
    const filas = tabla.getElementsByTagName('tr');

    filtroSelect.addEventListener('change', function() {
        const filtro = filtroSelect.value.toLowerCase();

        for (let i = 1; i < filas.length; i++) { // Empezar desde 1 para omitir la fila de encabezado
            const fila = filas[i];
            const celdaNombre = fila.getElementsByTagName('td')[0]; // Primera celda de la fila (columna "Nombre")
            if (celdaNombre) {
                const texto = celdaNombre.textContent.toLowerCase();
                if (texto.includes(filtro)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            }
        }
    });

    filtroInput.addEventListener('input', function() {
        const filtro = filtroInput.value.toLowerCase();

        // Iterar a través de las filas de la tabla y mostrar/ocultar según el filtro
        for (let i = 1; i < filas.length; i++) { // Empezar desde 1 para omitir la fila de encabezado
            const fila = filas[i];
            const celdaNombre = fila.getElementsByTagName('td')[0]; // Primera celda de la fila (columna "Nombre")
            if (celdaNombre) {
                const texto = celdaNombre.textContent.toLowerCase();
                if (texto.includes(filtro)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            }
        }
    });
</script>


@endsection