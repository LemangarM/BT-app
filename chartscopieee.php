<?php
session_start(); // Démarage de la session
if (isset($_POST['logoutValue']) ) // Si les variables existent.
{
  $logoutValue=$_POST['logoutValue'];

}

else
{
  $logoutValue="";

}

if( $logoutValue==1){$_SESSION['connect']==0;}
if($_SESSION['connect']==1){
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookApplis- Charts</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

  </head>
  <style>
  .datepicker-switch{
    text-align: center;
  }
  .today{
    text-align: center;
  }
  </style>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><span>Book</span>Applis</a>
          <ul class="user-menu">
            <li class="dropdown pull-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $_SESSION['login']; ?> <span class="caret"></span></a>

              <ul class="dropdown-menu" role="menu">
                <li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
                <li><a onclick='document.getElementById("logout").submit()' href="login.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
              </ul>

            </li>
          </ul>
        </div>

      </div><!-- /.container-fluid -->
    </nav>

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
      <form role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
      </form>
      <ul class="nav menu">
        <li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
        <li class="active"><a href="charts.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>
        <li><a href="tables.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Tables</a></li>
        <li><a href="reviews.php"><svg class="glyph stroked two messages"><use xlink:href="#stroked-two-messages"/></svg> Reviews</a></li>

        <li class="parent ">
          <a href="#">
            <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Dropdown
          </a>
          <ul class="children collapse" id="sub-item-1">
            <li>
              <a class="" href="#">
                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 1
              </a>
            </li>
            <li>
              <a class="" href="#">
                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 2
              </a>
            </li>
            <li>
              <a class="" href="#">
                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
              </a>
            </li>
          </ul>
        </li>
        <li role="presentation" class="divider"></li>
        <li><a href="login.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
      </ul>

    </div><!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
      <div class="row">
        <ol class="breadcrumb">
          <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
          <li class="active">Charts</li>
        </ol>
      </div><!--/.row-->

      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Charts</h1>
        </div>
      </div><!--/.row-->


      <!--   Liste Déroulante -->
      <?php

      $bdd = new PDO('mysql:host=localhost;dbname=btelecom', 'root', '');

      // ID DropdowpList
      $appNameResult=$bdd->query("SELECT DISTINCT appstore_sales.appID, appstore.appName FROM appstore_sales,appstore where appstore_sales.appID=appstore.appID");
      // Date DropdowpList
      //$resultat2=$bdd->query("SELECT appstore_sales.DateMeasure FROM appstore_sales where appID='0001APPEL' ORDER BY appstore_sales.DateMeasure DESC LIMIT 0,31");

      $appNameResult->setFetchMode(PDO::FETCH_ASSOC);

      /*while($rows=$resultat2->fetch()){
        $DateMeasure[]=$rows['DateMeasure'];
      }*/

      ?>

      <div class="col-lg-12" style="margin-left: -30px; margin-right: 30px;">
        <form method="post" role="form">
          <div class="col-md-4">
            <div class="form-group">
              <label style="color: rgb(95, 100, 104);"> Applications: </label>
              <select name='ID_query' class="form-control">
                <?php
                foreach ($appNameResult as $data) {
                  if(substr($data['appID'],0,2)=='00'){
                    echo '<option value="' . $data['appID']. '">' . $data['appName'] .'</option>';
                  }

                  else{
                    echo '<option value="' . $data['appID']. '">' . $data['appName'] .'</option>';
                  }
                }
                $appNameResult->closeCursor();
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label style="color: rgb(95, 100, 104);"> Date de début: </label>
              <div class="input-group date" data-provide="datepicker" id='datepickerstart'>
                <input name="date_debut" type="text" class="form-control" value="<?php if( isset($_POST['date_debut'])) { echo $_POST['date_debut']; } else{echo "2016-01-01";} ?>"/>
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label style="color: rgb(95, 100, 104);"> Date de fin: </label>
              <div class="input-group date" data-provide="datepicker" id='datepickerend'>
                <input name="date_fin" type="text" class="form-control" value="<?php if( isset($_POST['date_fin'])) { echo $_POST['date_fin'];} else {echo "2016-02-01" ;} ?>">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-2" style="height: 59px;">
            <button type="submit" class="btn btn-primary btn-md" id="btn-todo" style="bottom: 0px; position: absolute; background-color: rgb(6, 50, 90); border-color: rgb(0, 0, 0);">Valider</button>
          </div>
        </form>
      </div>  <!--   Fin Liste Déroulante -->


      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Install / Uninstall <div id="carre"></div></div>

            <div class="panel-body">
              <div class="canvas-wrapper">
                <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div><!--/.row-->

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Upgrade</div>
            <div class="panel-body">
              <div class="canvas-wrapper">
                <canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div><!--/.row-->

      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">Pie Chart</div>
            <div class="panel-body">
              <div class="canvas-wrapper">
                <canvas class="chart" id="pie-chart" ></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">Doughnut Chart</div>
            <div class="panel-body">
              <div class="canvas-wrapper">
                <canvas class="chart" id="doughnut-chart" ></canvas>
              </div>
            </div>
          </div>
        </div>
      </div><!--/.row-->

      <div class="row">
        <div class="col-xs-6 col-md-3">
          <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
              <h4>Taux de rétention:</h4>
              <div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-6 col-md-3">
          <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
              <h4>Label:</h4>
              <div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-6 col-md-3">
          <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
              <h4>Label:</h4>
              <div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-6 col-md-3">
          <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
              <h4>Label:</h4>
              <div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span>
              </div>
            </div>
          </div>
        </div>
      </div><!--/.row-->

    </div>	<!--/.main-->


    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <!--<script src="js/chart-data.js"></script>-->
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/bootstrap-datepicker.fr.js" charset="UTF-8"></script>

    <script>
    !function ($) {
      $(document).on("click","ul.nav li.parent > a > span.icon", function(){
        $(this).find('em:first').toggleClass("glyphicon-minus");
      });
      $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
      if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    });
    $(window).on('resize', function () {
      if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    });

    //START DATE
    $('#datepickerstart').datepicker({
      format: 'yyyy-mm-dd',
      endDate: new Date(),
      language:'fr',
      todayBtn:true,
      autoclose:true
      //startDate: '-1d'
    });

    //$('#datepickerstart').datepicker('setDate','-30d');
    $('#datepickerstart').datepicker('getDate');

    //END DATE
    $('#datepickerend').datepicker({
      format: 'yyyy-mm-dd',
      endDate: new Date(),
      language:'fr',
      todayBtn:true,
      autoclose:true
    });
    //$('#datepickerend').datepicker('setDate','0')

    $("#datepickerend").on("dp.change", function (e) {
      $('#datepickerstart').data("DateTimePicker").minDate(e.date);
    });
    $("#datepickerstart").on("dp.change", function (e) {
      $('#datepickerend').data("DateTimePicker").maxDate(e.date);
    });
    </script>

    <!-- DATA Charts -->
    <?php

    // mysql database connection details
    /*$host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "btelecom";

    // open connection to mysql database
    $connection = mysqli_connect($host, $username, $password, $dbname) or die("Connection Error " . mysqli_error($connection));
    // fetch mysql table rows

/*
    $post=$_POST['ID_query'];
    $start=$_POST['date_debut'];
    $end=$_POST['date_fin'];

    $d_start = explode("-",$start);  // yyyymmdd
    $d_end = explode("-",$end);     //  yyyymmdd
*/

    if(isset($_POST['ID_query'], $_POST['date_debut'], $_POST['date_fin'])){

      $linChartResult=$bdd->query("SELECT appID, DateMeasure , Unites, Daily_uninstall, Daily_upgrade FROM appstore_sales WHERE appID='$_POST[ID_query]' and DateMeasure between '$_POST[date_debut]' and '$_POST[date_fin]'");
      //$sql2 = "SELECT Unites, DateMeasure FROM appstore_uvisitor WHERE appID='$_POST['ID_query']'";
    }
    /*
    else if ($d_start>$d_end) {
      # code...
      echo 'La Date de fin est antérieure à la date de début.';
    }*/
    else{
      $linChartResult=$bdd->query("SELECT appID, DateMeasure , Unites, Daily_uninstall, Daily_upgrade FROM appstore_sales WHERE appID='0001APPEL' ORDER BY DateMeasure ASC LIMIT 31");
    }

    //$result1 = mysqli_query($connection, $sql1) or die("Selection Error " . mysqli_error($connection));

    // déclaration arrays
    $Date= array();
    $Install= array();
    $Uninstall= array();
    $Upgrade= array();
    $Visitors=array();
    $VisitorsDate=array();

    while($row = $linChartResult->fetch()) {
      array_push($Date,$row['DateMeasure']) ;
      array_push($Install,$row['Unites']);
      array_push($Uninstall,$row['Daily_uninstall']);
      array_push($Upgrade,$row['Daily_upgrade']);
    }

    $linChartResult->closeCursor();

    if(isset($_POST['ID_query'], $_POST['date_debut'], $_POST['date_fin'])){

    //  $barChartResult = $bdd->query("SELECT Unites, DateMeasure FROM appstore_uvisitor WHERE appID='$_POST['ID_query']'");
    }

    /*$result3 = mysqli_query($connection, $sql2) or die("Selection Error " . mysqli_error($connection));
    $row2 = mysqli_fetch_array($result3);*/

    /*$barcount=$barChartResult->rowCount();
    if ($barcount > 0) {

      while($row1 = $barChartResult->fetch()) {
        array_push($Visitors,$row1['Unites']);
        array_push($VisitorsDate,$row1['DateMeasure']);
      }
    }
    else {

    }
    $barChartResult->closeCursor();

    //close the db connection
    //mysqli_close($connection);*/

    ?> <!-- DATA Charts-->

    <!-- insert DATA -->
    <script>
    var date_de_mesure = <?= json_encode($Date) ?>;
    var telechargement = <?= json_encode($Install) ?>;
    var desinstalation = <?= json_encode($Uninstall) ?>;
    var mise_a_jour = <?= json_encode($Upgrade) ?>;
    var visiteurs_unique = <?= json_encode($Visitors) ?>;
    var visiteurs_date = <?= json_encode($VisitorsDate) ?>;

    var lineChartData = {
      labels : date_de_mesure,
      datasets : [
        {
          label: "My First dataset",
          fillColor : "rgba(220,220,220,0.2)",
          strokeColor : "rgba(238,44,44,1)",
          pointColor : "rgba(238,44,44,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(220,220,220,1)",
          data : desinstalation
        },
        {
          label: "My Second dataset",
          fillColor : "rgba(48, 164, 255, 0.2)",
          strokeColor : "rgba(48, 164, 255, 1)",
          pointColor : "rgba(48, 164, 255, 1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(48, 164, 255, 1)",
          data : telechargement
        },
        {
          label: "Mise à jour",
          fillColor : "rgba(48, 164, 255, 0.2)",
          strokeColor : "#FFB53E",
          pointColor : "#FFB53E",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(48, 164, 255, 1)",
          data : mise_a_jour
        }
      ]

    }

    var barChartData = {
      labels : visiteurs_date,
      datasets : [

        {
          fillColor : "rgba(48, 164, 255, 0.2)",
          strokeColor : "rgba(48, 164, 255, 0.8)",
          highlightFill : "rgba(48, 164, 255, 0.75)",
          highlightStroke : "rgba(48, 164, 255, 1)",
          data : visiteurs_unique
        }
      ]

    }

    var pieData = [
      {
        value: 300,
        color:"#30a5ff",
        highlight: "#62b9fb",
        label: "Blue"
      },
      {
        value: 50,
        color: "#ffb53e",
        highlight: "#fac878",
        label: "Orange"
      },
      {
        value: 100,
        color: "#1ebfae",
        highlight: "#3cdfce",
        label: "Teal"
      },
      {
        value: 120,
        color: "#f9243f",
        highlight: "#f6495f",
        label: "Red"
      }

    ];

    var doughnutData = [
      {
        value: 300,
        color:"#30a5ff",
        highlight: "#62b9fb",
        label: "Blue"
      },
      {
        value: 50,
        color: "#ffb53e",
        highlight: "#fac878",
        label: "Orange"
      },
      {
        value: 100,
        color: "#1ebfae",
        highlight: "#3cdfce",
        label: "Teal"
      },
      {
        value: 120,
        color: "#f9243f",
        highlight: "#f6495f",
        label: "Red"
      }

    ];

    window.onload = function(){
      var chart1 = document.getElementById("line-chart").getContext("2d");
      window.myLine = new Chart(chart1).Line(lineChartData, {
        responsive: true
      });
      var chart2 = document.getElementById("bar-chart").getContext("2d");
      window.myBar = new Chart(chart2).Bar(barChartData, {
        responsive : true
      });
      var chart3 = document.getElementById("doughnut-chart").getContext("2d");
      window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive : true
      });
      var chart4 = document.getElementById("pie-chart").getContext("2d");
      window.myPie = new Chart(chart4).Pie(pieData, {responsive : true
      });

    };
    </script> <!--fin insert DATA -->

    <!--Formulaires Cachés-->

    <form id="logout" action="charts.php" method = "post">
      <input type="hidden" name="logoutValue" value="1"/>
    </form>
  </body>

  </html>
  <?php
}

else // Le mot de passe n'est pas bon.
{
  header('Location: login.php');

} // Fin du else.

// Fin du code. :)

?>
