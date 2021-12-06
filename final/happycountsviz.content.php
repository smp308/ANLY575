<style type="text/css">
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 0 auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
</style>



<?php

$db = new Database();

$session = new Session();


$hsql = '
SELECT 
    `c`.`Country`, 
    `m`.`Totals`,
    `h`.`Positive_affect`,
    `h`.`Negative_affect`
FROM `medals` AS `m`
INNER JOIN `countries` AS `c`
    ON `m`.`NOC_code` = `c`.`Olympic_Committee_code`
INNER JOIN `happiness` AS `h`
    ON `h`.`Country_name` = `c`.`Country`
WHERE `h`.`year`= 2018 
';

function fetchAll($query = null) {
        $pdo = $this->pdo();
        $data = $pdo->query($query)->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

$happiest = $db->fetchAll($hsql);


$caption = 'Happiness and Medal Counts';
$headers = array('Country', 'Total Medals', 'Positve Feelings', 'Negative Feelings');
$data = $happiest; // note: this would be an array of rows from a database query
$attributes = array('id' => 'happiestTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; // if the UI file has not been included yet
$ui = new UI(); // if the UI class has not been called yet;

// Call tables and dialog
$tableRows = array();
$countries = array();
$pos = array();
$neg = array();
$tots = array();
$try = array();
$counter = 0;
foreach ($happiest as $happy) {
$tableRows[$counter][] = $happy->Country;
array_push($try, $happy->Country);
$tableRows[$counter][] = $happy->Totals;
array_push($try, $happy->Totals);
$tableRows[$counter][] = $happy->Positive_affect;
array_push($try, $happy->Positive_affect);
$tableRows[$counter][] = $happy->Negative_affect;
array_push($try, $happy->Negative_affect);


$countries[$counter] = $happy->Country;
$pos[$counter] = $happy->Positive_affect;
$neg[$counter] = $happy->Negative_affect;
$tots[$counter] = $happy->Totals;
$counter++; // increment the counter by 1
}
// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $tableRows, $attributes);
$dialog = $ui->dialog();

echo $dialog;
echo "<div class='happiest-table'>";
echo $table;
echo  "</div>"; 


echo 'To see some visualization on this table, click <a href="http://localhost/final/joined2.php"> here</a>.';



$full = array_merge_recursive($pos, $countries, $neg);
$full_use = array_chunk($try, 4);


echo '<pre>';
print_r($full_use);
echo '</pre>';

?>

<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Chart demonstrating a 3D scatter plot, where the chart can be rotated to
        inspect points from different angles. Each point has an x, y, and z
        coordinate value.
    </p>
</figure>

<script>
// Give the points a 3D feel by adding a radial gradient
Highcharts.setOptions({
    colors: Highcharts.getOptions().colors.map(function (color) {
        return {
            radialGradient: {
                cx: 0.4,
                cy: 0.3,
                r: 0.5
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.2).get('rgb')]
            ]
        };
    })
});

// Set up the chart
var chart = new Highcharts.Chart({
    chart: {
        renderTo: 'container',
        margin: 100,
        type: 'scatter3d',
        animation: false,
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 30,
            depth: 250,
            viewDistance: 5,
            fitToPlot: false,
            frame: {
                bottom: { size: 1, color: 'rgba(0,0,0,0.02)' },
                back: { size: 1, color: 'rgba(0,0,0,0.04)' },
                side: { size: 1, color: 'rgba(0,0,0,0.06)' }
            }
        }
    },
    title: {
        text: 'Draggable box'
    },
    subtitle: {
        text: 'Click and drag the plot area to rotate in space'
    },
    plotOptions: {
        scatter: {
            width: 10,
            height: 10,
            depth: 10
        }
    },
    yAxis: {
        min: 0,
        max: 1,
        title: null
    },
    xAxis: {
        min: 0,
        max: 2000,
        gridLineWidth: 1
    },
    zAxis: {
        min: 0,
        max: 10,
        showFirstLabel: false
    },
    legend: {
        enabled: false
    },
    series: [{
        name: 'Data',
        colorByPoint: true,
        accessibility: {
            exposeAsGroupOnly: true
        },
                dataLabels: {
        enabled: true,
        formatter: function () {
            return this.point.name;
        },
    },
        data: <?php echo json_encode($full_use, JSON_NUMERIC_CHECK) ?>
    }]
});


// Add mouse and touch events for rotation
(function (H) {
    function dragStart(eStart) {
        eStart = chart.pointer.normalize(eStart);

        var posX = eStart.chartX,
            posY = eStart.chartY,
            alpha = chart.options.chart.options3d.alpha,
            beta = chart.options.chart.options3d.beta,
            sensitivity = 5,  // lower is more sensitive
            handlers = [];

        function drag(e) {
            // Get e.chartX and e.chartY
            e = chart.pointer.normalize(e);

            chart.update({
                chart: {
                    options3d: {
                        alpha: alpha + (e.chartY - posY) / sensitivity,
                        beta: beta + (posX - e.chartX) / sensitivity
                    }
                }
            }, undefined, undefined, false);
        }

        function unbindAll() {
            handlers.forEach(function (unbind) {
                if (unbind) {
                    unbind();
                }
            });
            handlers.length = 0;
        }

        handlers.push(H.addEvent(document, 'mousemove', drag));
        handlers.push(H.addEvent(document, 'touchmove', drag));


        handlers.push(H.addEvent(document, 'mouseup', unbindAll));
        handlers.push(H.addEvent(document, 'touchend', unbindAll));
    }
    H.addEvent(chart.container, 'mousedown', dragStart);
    H.addEvent(chart.container, 'touchstart', dragStart);
}(Highcharts));
</script>






