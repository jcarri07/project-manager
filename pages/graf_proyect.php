<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafica</title>
    <?php 
    require_once('../databases/conexion.php');
    ?>

    <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../assets/DataTable/datatables.min.css">
  </head>

  <body>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-7 col-lg-7">
          <canvas id="miGrafico"></canvas> 
    </div>

      </div>
    </div>



  </body>

  
    <script src="../assets/chart/chart.umd.min.js"></script>
    <script src="../assets/jqery/jquery.js"></script>
    <script src="../assets/DataTable/datatables.min.js"></script>
    <script src="../assets/Bootstrap/js/bootstrap.min.js"></script>


  <script>
    $(document).ready(function() {

  $.ajax({
      url: "./Consul_graf.php",
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      method: "GET",
      success: function(data) {
          var Estado = [];
          var Cantidad = [];

          var color = [
            'rgba(255, 0, 46, 1)', 
          'rgba(0, 51, 204, 1)', 
          'rgba(153, 92, 0, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)', 
          'rgba(255, 159, 64, 1)'
          /*
          'rgba(255, 99, 132, 1)', 
          'rgba(54, 162, 235, 1)', 
          'rgba(255, 206, 86, 1)',
          */
          ];
          var bordercolor = [
            'rgba(255, 0, 46, 1)', 
          'rgba(0, 51, 204, 1)', 
          'rgba(153, 92, 0, 1)', 
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)', 
          'rgba(255, 159, 64, 1)'
        ];
          console.log(data);

          for (var i in data) {
              Estado.push(data[i].Estado);
              Cantidad.push(data[i].Cantidad);
          }

          var chartdata = {
              labels: Estado,
              datasets: [{
                  label: 'Cantidad Total',
                  backgroundColor: color,
                  borderColor: color,
                  borderWidth: 1,
                  hoverBackgroundColor: color,
                  hoverBorderColor: bordercolor,
                  data: Cantidad,
              }]
          };

          var mostrar = $("#miGrafico");
          Chart.defaults.font.size = 20;
          var grafico = new Chart(mostrar, {
              type: 'polarArea',
              data: chartdata,
              options: {
                animation: { //Animacion del grafico
                          duration: 5000,
                          //easing: 'easeInOutCirc',
                          easing: 'easeInOutElastic',
                      },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 20
                                  }
                                }
                            }
                          }
                    }
              
          });
      },
      error: function(data) {
          console.log(data);
      }
  });

  })
  </script>

  </html>
