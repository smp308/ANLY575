<style type="text/css">
#container {
    height: 2000px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
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
    padding: 1.5em;
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
$neg[$counter] = $happy->Negative_affect*(-1);
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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Bar chart showing german population distribution by using a mirrored
        horizontal column chart with stacking and two x-axes.
    </p>
</figure>



<script>
// Data gathered from http://populationpyramid.net/germany/2015/


// Age categories
var categories = <?php echo json_encode($countries) ?>;

Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Population pyramid for Germany, 2018'
    },
    subtitle: {
        text: 'Source: <a href="http://populationpyramid.net/germany/2018/">Population Pyramids of the World from 1950 to 2100</a>'
    },
    accessibility: {
        point: {
            valueDescriptionFormat: '{index}. Age {xDescription}, {value}%.'
        }
    },
    xAxis: [{
        categories: categories,
        reversed: false,
        labels: {
            step: 1
        },
        accessibility: {
            description: 'Age (male)'
        }
    }, { // mirror axis on right side
        opposite: true,
        reversed: false,
        categories: categories,
        linkedTo: 0,
        labels: {
            step: 1
        },
        accessibility: {
            description: 'Age (female)'
        }
    }],
    yAxis: {
        title: {
            text: null
        },
        labels: {
            formatter: function () {
                return Math.abs(this.value) + '%';
            }
        },
        accessibility: {
            description: 'Percentage population',
            rangeDescription: 'Range: 0 to 5%'
        }
    },

    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },

    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + ': ' + this.point.category + '</b><br/>' +
                ' ' + Highcharts.numberFormat(Math.abs(this.point.y), 1) + '%';
        }
    },

    series: [{
        name: 'Negative',
        data: <?php echo json_encode($neg, JSON_NUMERIC_CHECK) ?>
    }, {
        name: 'Positive',
        data: <?php echo json_encode($pos, JSON_NUMERIC_CHECK) ?>
    }]
});
</script>