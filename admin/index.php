<?php
require_once('views/header/header_administrador.php');
require_once('seccion.class.php');
$app = new Seccion();
$data = $app->readAll();
?>

<h2>bienvenido al sistema</h2>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Element", "Density", { role: "style" } ],
            <?php foreach($data as $invernadero): ?>
                ["<?php echo $invernadero['invernadero'];?>", <?php echo $invernadero['area'];?>, "#b87333"],
            <?php endforeach;?>    
        ]);

    var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                        { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                        2]);

        var options = {
        title: "Density of Precious Metals, in g/cm^3",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }
</script>
<div id="columnchart_values" style="width: 900px; height: 300px;"></div>
<?php
require_once('views/footer.php');
?>