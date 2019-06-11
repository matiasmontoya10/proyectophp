<main class="fondo_main">
    <!--AGREGAR REPORTE DE SENSOR DE TEMPERATURA & HUMEDAD-->
    <div id="temperatura_humedad_gauge" class="container">
        <br>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel borde_card_panel">
                    <h5 class="center"><b>REPORTES DE TEMPERATURA & HUMEDAD</b></h5>
                    <div id="estado_sensor" style="width: 100px; height: 100px;"></div>
                    <br>
                    <span>TEMPERATURA: {{temperatura}}</span>
                    <br>
                    <span>HUMEDAD: {{humedad}}</span>
                    <br>
                    <button @click="boton">boton</button>
                </div>
            </div>
        </div>
    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {

var data = google.visualization.arrayToDataTable([
['Label', 'Value'],
['Memory', 80],
['CPU', 55],
]);
var options = {
width: 250, height: 250,
        redFrom: 90, redTo: 100,
        yellowFrom:75, yellowTo: 90,
        minorTicks: 5
};
var chart = new google.visualization.Gauge(document.getElementById('estado_sensor'));
chart.draw(data, options);
setInterval(function() {
data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
chart.draw(data, options);
}, 13000);
setInterval(function() {
data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
chart.draw(data, options);
}, 5000);
}
</script>

<script type="text/javascript">
    new Vue({
    el:'#temperatura_humedad_gauge',
            data:{
            temperatura: "",
                    humedad: "",
            },
            methods: {
            boton: async function(){
            texto = await axios.get('http://10.100.138.53:125/');
            console.log(texto);
            i = texto.data.indexOf("{");
            x = texto.data.substring(i);
            console.log(x);
            obj = JSON.parse(x);
            this.temperatura = obj.temperatura;
            this.humedad = obj.humedad;
            console.log("-------------" + obj.temperatura);
            console.log("-------------" + obj.humedad);
            }
            },
            created(){
    this.boton();
    }

    });
    $('#tabla_listado_mensaje_entrada').DataTable({
    scrollX: true,
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "ajax": {
            url: base_url + "listado_mensaje_entrada",
                    type: 'post',
                    data: {rut_usuario: rut_usuario_php}
            },
            "iDisplayLength": 5,
            "bJQueryUI": false,
            "dom": 'Bfrtip',
            "buttons": [
            {
            title: 'Santa Ana S.A - Buzón de Mensajes',
                    messageTop: 'Desarrollado por Matías Montoya P.',
                    filename: 'proyecto_php',
                    extend: 'pdfHtml5',
                    download: 'open',
                    pageSize: 'letter',
                    orientation: 'landscape',
                    customize: function (doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.content[2].margin = [50, 0, 50, 0];
                    }
            }
            ],
            "order": [[0, "desc"]]
    });
</script>