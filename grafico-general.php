<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script type="text/javascript">

  // var pantalla = window.screen.availHeight;
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Categorias');
  data.addColumn('number', 'Intereses');
  data.addColumn('number', 'Aptitudes');
  data.addRows([
    <?php 
      $i = 0;
      foreach ($catIntereses as $key => $value) { 
        echo "['" . $value['catTipo'] . "', " . valorPorcentaje($resulIntereses[$value['catId']]) . ", " . valorPorcentaje($resulAptitudes[($catAptitudes[$i]['catId'])]) . "],\n";
        $i++;
      }
    ?>
    ]);
  // Set chart options
  var options = {'title':'Intereses y Aptitudes',
                  'legend':'top',
                  titleTextStyle: {fontSize: 20},
                  'width': (document.getElementById('grafico-general').clientWidth)-18,
                  'height':400,
                  colors: ['navy', 'orangered'], 
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
  var chart = new google.visualization.ColumnChart(document.getElementById('grafico-general'));
  chart.draw(data, options);
  // console.log("Ancho pantalla: " + (getWindowSize('h') * 0.8) + " px");
  // console.log(data);
  // console.log(options);
  // console.log('chart propiedades');
  // console.log(chart);
  
  function resize () {
    options.width = document.getElementById('grafico-general').clientWidth-18;
    var chart = new google.visualization.ColumnChart(document.getElementById('grafico-general'));
    chart.draw(data, options);
  }
  window.onload = resize;
  window.onresize = resize;
}

</script>
