<style type="text/css">
    #container {
    height: 400px;
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


$sql = '
SELECT 
	`m`.`Country`, 
	#`m`.`NOC_Code`,
	`m`.`Totals`,
	`m`.`Golds`,
	`m`.`Silvers`,
	`m`.`Bronzes`,
	`w`.`Aug_Temp`,
	`w`.`Annual_temp` AS `average_temperature`
FROM `medals` AS `m`
INNER JOIN `weather` AS `w`
	ON `m`.`NOC_code` = `w`.`ISO_3DIGIT`
';

#$joined = $db->object('Medals', $mwSql);
function fetchAll($query = null) {
		$pdo = $this->pdo();
		$data = $pdo->query($query)->fetchAll(PDO::FETCH_OBJ);
		return $data;
	}

$joined = $db->fetchAll($sql);

//echo '<pre>';
//print_r($joined);
//echo '</pre>';


/*$m = $db->object('Medals', $mwSql);
$medalsCourseIndex = array();
foreach ($m as $k => $medalsObj) {
		$medalsCourseIndex[$medalsObj->id] = array('average_temperature' => $medalsObj->Annual_temp);
		//, 'course_name' => $assignmentObj->course_name);
}*/


$caption = 'Weather vs Medals';
$headers = array('Country', 'Total Medals', 'Golds', 'Silvers', 'Bronzes', 'August Avg Temp','Annual Avg Temp');
$data = $joined; // note: this would be an array of rows from a database query
$attributes = array('id' => 'joinedTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; // if the UI file has not been included yet
$ui = new UI(); // if the UI class has not been called yet;

// Call tables and dialog
$tableRows = array();
$countries = array();
$gold = array();
$silver = array();
$bronze = array();
$temps = array();
$counter = 0;
foreach ($joined as $join) {
$tableRows[$counter][] = $join->Country;
#$tableRows[$counter][] = $join->NOC_Code ;
$tableRows[$counter][] = $join->Totals;
$tableRows[$counter][] = $join->Golds;
$tableRows[$counter][] = $join->Silvers;
$tableRows[$counter][] = $join->Bronzes;
$tableRows[$counter][] = $join->Aug_Temp;
$tableRows[$counter][] = $join->average_temperature;

$countries[$counter] = $join->Country;
$gold[$counter] = $join->Golds;
$silver[$counter] = $join->Silvers;
$bronze[$counter] = $join->Bronzes;
$temps[$counter] = $join->average_temperature;

$counter++; // increment the counter by 1
}
// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $tableRows, $attributes);
$dialog = $ui->dialog();

echo $dialog;
echo "<div class='joined-table'>";
echo $table;
echo  "</div>"; 

?>



<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Chart showing stacked columns for comparing quantities. Stacked charts
        are often used to visualize data that accumulates to a sum. This chart
        is showing data labels for each individual section of the stack.
    </p>
</figure>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Chart showing stacked columns for comparing quantities. Stacked charts
        are often used to visualize data that accumulates to a sum. This chart
        is showing data labels for each individual section of the stack.
    </p>
</figure>

<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Stacked column chart'
    },
    xAxis: {
        categories: <?php echo json_encode($countries) ?>
    },

    
    yAxis: {
        min: 0,
        title: {
            text: 'Medal Counts By Country'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: ( // theme
                    Highcharts.defaultOptions.title.style &&
                    Highcharts.defaultOptions.title.style.color
                ) || 'gray'
            }
        }
    },
    legend: {
        align: 'right',
        x: -30,
        verticalAlign: 'top',
        y: 25,
        floating: true,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
        }
    },
    series: [{
        name: 'Gold',
        data: <?php echo json_encode($gold, JSON_NUMERIC_CHECK) ?>
    }, {
        name: 'Silver',
        data: <?php echo json_encode($silver, JSON_NUMERIC_CHECK) ?>
    }, {
        name: 'Bronze',
        data: <?php echo json_encode($bronze, JSON_NUMERIC_CHECK) ?>
    },
    {
        type: 'spline',
        name: 'Average Temperature',
        data: <?php echo json_encode($temps, JSON_NUMERIC_CHECK) ?>,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    }
    ]
});
</script>