<HTML>
<BODY>

<meta charset="utf-8"> 

<?php
require_once("randomClass.php");

//Creamos un objeto de la clase randomTable
$rand = new RandomTable();
//insertamos un valor aleatorio

//obtenemos toda la información de la tabla random
$rawdata = $rand->getAllInfo();

//nos creamos dos arrays para almacenar el tiempo y el valor numérico
$valoresArray;
$timeArray;
//en un bucle for obtenemos en cada iteración el valor númerico y 
//el TIMESTAMP del tiempo y lo almacenamos en los arrays 
for($i = 0 ;$i<count($rawdata);$i++){
$valoresArray[$i]= $rawdata[$i][1];
    //OBTENEMOS EL TIMESTAMP
//    $time= $rawdata[$i][2];
//    $date = new DateTime($time);
    //ALMACENAMOS EL TIMESTAMP EN EL ARRAY
    $timeArray[$i] = $rawdata[$i][0];;
}

?>
<div id="contenedor"></div>

<script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script>

Highcharts.chart('contenedor',{
   chart: {
      
    type: 'column'
  },
  title: {
    text: 'GRÁFICA DE COSTES'
  },
  subtitle: {
    text: 'AOM SUBSCRIPTION MANAGER'
  },
  xAxis: {
    type: 'category',
    labels: {
      rotation: -45,
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Precio (Euros)'
    }
  },
  legend: {
    enabled: false
  },
  tooltip: {
    pointFormat: 'Precio: <b>{point.y:.1f} Euros</b>'
  },
  series: [{
        name: 'Precio',
        data: (function() {
                // generate an array of random data
                var data = [];
                <?php
                    for($i = 0 ;$i<count($rawdata);$i++){
                ?>
                data.push(['<?php echo $timeArray[$i];?>',<?php echo $valoresArray[$i];?>]);
                <?php } ?>
                return data;
            })(),
    dataLabels: {
      enabled: true,
      rotation: -90,
      color: 'black',
      align: 'right',
      format: '{point.y:.1f}', // one decimal
      y: 10, // 10 pixels down from the top
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  }]
});

</script>   
</BODY>

</html>