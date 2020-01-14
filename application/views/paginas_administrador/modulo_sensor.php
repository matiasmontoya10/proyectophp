<main class="fondo_main">
    <!--AGREGAR REPORTE DE SENSOR DE TEMPERATURA & HUMEDAD-->
    <br>
    <div id="temperatura_humedad_gauge" class="container">
        <br>
        <div class="row">
            <div class="col s12 m8 l8 offset-l2 offset-m2">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>TACÓMETRO</b></h5>
                    <div id="estado_sensor" style="padding-left: 120px">

                    </div>
                </div>
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>GRÁFICO DE SEGUIMIENTO</b></h5>
                    <div id="grafico_sensor" style="width: 655px; height: 400px;">

                    </div>
                </div>
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>LISTA DE REGISTROS</b></h5>
                    <table id="tabla_listado_sensor" class="centered bordered highlight nowrap cell-border table-striped">
                        <thead class="teal darken-2 white-text">
                            <tr>
                                <th>ID</th>
                                <th>TEMPERATURA</th>
                                <th>HUMEDAD</th>
                                <th>FECHA</th>
                                <th>RUT RESP.</th>
                                <th>NOMBRE Y APELLIDO RESP.</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <input id="temperatura_sensor" type="hidden" readonly="true" class="center">
                    <input id="humedad_sensor" type="hidden" readonly="true" class="center">
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
//
    function dibujaGrafica() {
    google.charts.load('visualization', '1', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
//
<?php
//PARA OBTENER LOS DATOS DE LOS SENSORES
$con = new mysqli("localhost", "root", "", "santa_ana_sa");
$sql = ("select sensor.temperatura_sensor, sensor.humedad_sensor from sensor order by id_sensor desc limit 55");
$res = $con->query($sql);
$con->close();
?>
    //  
    //    
    var data = google.visualization.arrayToDataTable([
    ['H', 'T'],
<?php
while ($row_sensor = $res->fetch_assoc()) {
    echo "['" . $row_sensor["humedad_sensor"] . "'," . $row_sensor["temperatura_sensor"] . "],";
}
?>
    ]);
    var options = {
    title: 'Temperatura vs Humedad',
            hAxis: {title: 'Humedad'},
            vAxis: {title: 'Temperatura'},
            legend: 'none'
    };
    var chart = new google.visualization.AreaChart(document.getElementById('grafico_sensor'));
    chart.draw(data, options);
    }
    }
    setInterval(dibujaGrafica, 5000);
    //
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages': ['gauge']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
//
    var data = google.visualization.arrayToDataTable([
    ['Label', 'Value'],
    ["TEM °", 0],
    ['HUM %', 0]
    ]);
//
    var options = {
    width: 350, height: 150,
            redFrom: 45, redTo: 60,
            yellowFrom: 20, yellowTo: 45,
            minorTicks: 4,
            max: 60,
    };
//
    var chart = new google.visualization.Gauge(document.getElementById('estado_sensor'));
    chart.draw(data, options);
//
    setInterval(async function () {
    texto = await axios.get('http://192.168.1.83:125/');
    entrada = texto.data.indexOf("{");
    datos = texto.data.substring(entrada);
//
    console.log(datos);
    objeto = JSON.parse(datos);
//VALORES OBTENIDOS DEL SENSOR
    this.temperatura = objeto.temperatura;
    this.humedad = objeto.humedad;
//
    data.setValue(0, 1, this.temperatura);
    data.setValue(1, 1, this.humedad);
//
    var temperatura = this.temperatura;
    var humedad = this.humedad;
//
    $("#temperatura_sensor").val(temperatura);
    $("#humedad_sensor").val(humedad);
//
//    $("#boton_agregar_sensor").click(function (excepcion) {
//    excepcion.preventDefault();
    var rut_usuario = rut_usuario_php;
    var temperatura_sensor = $("#temperatura_sensor").val();
    var humedad_sensor = $("#humedad_sensor").val();
    //
    console.log(temperatura_sensor);
    console.log(humedad_sensor);
    //
    if (temperatura_sensor == "" || humedad_sensor == "") {
    Materialize.toast("SENSOR(ES) EN MANTENCIÓN", 3000);
    } else {
    $.ajax({
    url: base_url + 'insertar_sensor',
            type: 'post',
            dataType: 'json',
            data: {rut_usuario: rut_usuario, temperatura_sensor: temperatura_sensor,
                    humedad_sensor: humedad_sensor},
            success: function (resultado) {
            if (resultado.mensaje === "0") {
//            Materialize.toast(resultado.mensaje, "3000");
            } else {
//            Materialize.toast(resultado.mensaje, "3000");
            $("#tabla_listado_sensor").DataTable().ajax.reload();
            }
            },
            error: function () {
            Materialize.toast("ERROR 500", "3000");
            }
    });
    }
//    });

    chart.draw(data, options);
    }, 3000);
    }
</script>

<script type="text/javascript">
    //
    $('#tabla_listado_sensor').DataTable({
    scrollX: true,
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "ajax": {
            url: base_url + "listado_sensor",
                    type: 'post'
            },
            "iDisplayLength": 5,
            "bJQueryUI": false,
            "dom": 'Bfrtip',
            "buttons": [
            {
            title: 'Santa Ana S.A - Reporte de Temperatura & Humedad',
                    messageTop: 'Desarrollado por Matías Montoya P.',
                    filename: 'proyecto_php',
                    extend: 'pdfHtml5',
                    download: 'open',
                    pageSize: 'letter',
                    orientation: 'vertical',
                    customize: function (doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.content[2].margin = [50, 0, 50, 0];
                    }
            }
            ],
            "order": [[0, "desc"]],
            "columnDefs": [
            {targets: [1, 2], "render": function (data, type, row, meta) {
            return data + "°";
            }
            }
            ]
    });
    //

</script>
