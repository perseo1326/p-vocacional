<?php
  if ($area->getTipo() == TIPO_INTERESES) {
    $color = 'navy';
  } else {
    $color = 'orangered';
  }
?>
  <!--Load the AJAX API-->
  <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
  <script type='text/javascript'>

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
  // Create the data table.
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Prueba de <?php echo $area->getName(); ?>');
  data.addColumn('number', 'Categoria');
  // data.addColumn({type: 'string', role: 'annotation'}); , '<?php //echo $categorias[$i]["catTipo"]; ?>'
  data.addRows([
    <?php $i = 0;
      foreach ($catValor as $cat => $value) {
        if(isset($categorias[$i+1]) ) {
          echo "['" . $categorias[$i]['catTipo'] . "', " . valorPorcentaje($value) . "], ";
        } 
        else {
          echo "['" . $categorias[$i]['catTipo'] . "', " . valorPorcentaje($value) . "]";
        }
        $i++;
      }
    ?>
  ]);

  // Set chart options
  var options = {'title':'Prueba de <?php echo $area->getName(); ?>',
    titleTextStyle: {fontSize: 20},
    'width': (document.getElementById('grafico-sencillo').clientWidth)-18,
    'height': 400,
    colors: ['<?php echo $color; ?>'],
    tooltip: { textStyle: {color: 'black'} },  
    hAxis: {
      title: 'Categorias'
    },
        vAxis: {
          title: 'Escala 1-100%',
          textStyle: {color: 'black'},
          ticks: [25, 50, 75, 100],
              maxValue: 110,
              minValue: 0
            }
          };
  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.ColumnChart(document.getElementById('grafico-sencillo'));
  chart.draw(data, options);
  
  function resize () {
    options.width = document.getElementById('grafico-general').clientWidth-18;
    var chart = new google.visualization.ColumnChart(document.getElementById('grafico-general'));
    chart.draw(data, options);
  }
  window.onload = resize;
  window.onresize = resize;
}

</script>