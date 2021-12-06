<style>
	.highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
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

$ssql = '
SELECT  
    `w`.`Edition`,
    `w`.`NOC`,
    #`w`.`Medal`,
    count(*) AS `count`
FROM `winners` AS `w`
GROUP BY w.Edition, w.NOC
';

#$joined = $db->object('Medals', $mwSql);
function fetchAll($query = null) {
        $pdo = $this->pdo();
        $data = $pdo->query($query)->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

$winners = $db->fetchAll($ssql);


$caption = 'Winners';
$headers = array('Year', 'Country', 'Medal Count');
$data = $winners; 
$attributes = array('id' => 'winnersTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; 
$ui = new UI(); 

// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $data, $attributes);
$dialog = $ui->dialog();


$tableRows = array();
$countries = array();
$year = array();
$count = array();
$try = array();
$counter = 0;
foreach ($winners as $winner) {
$tableRows[$counter][] = $winner->Edition;
$year[$counter] = $winner->Edition;
$tableRows[$counter][] = $winner->NOC ;
$countries[$counter] = $winner->NOC;
array_push($try, $winner->NOC);
$tableRows[$counter][] = $winner->count;
array_push($try, $winner->count);
$count[$counter] = $winner->count;
$counter++; // increment the counter by 1
}

//$winners = array();
/*$newArray = array();
$count = 0;
$count1 = 0;
$year = "";
foreach ($winners as $dataItem) {
    $newArray[$count]['data'][$count1]['name']= $dataItem->NOC;
    $newArray[$count]['data'][$count1]['value']= $dataItem->count;
    if($year !== $dataItem->Edition)
    {
        $newArray[$count]['name'] = $dataItem->Edition;
        $year = $dataItem->Edition;
        if($dataItem->Edition !== '1896'){
        $count++;
    }
    }
    $count1++;
}*/


//echo '<pre>';
//print_r($newArray);
//echo '</pre>';

print_r(json_encode($winners));

//echo $dialog;
//echo "<div class='winners-table'>";
//echo $table;
//echo  "</div>"; 

//$full_use = array_chunk($try, 2);

//echo '<pre>';
//print_r($full_use);
//echo '</pre>';

?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>



<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        This chart shows how packed bubble charts can be grouped by series,
        creating a hierarchy.
    </p>
</figure>

<script type="text/javascript" >
// credit: in collaboration with Samuel Pastoriza
var winners = <?php echo json_encode($winners) ?>;
var initialTransformation = winners.reduce(function(previous, current) {
	if(current.count <= 10){ //|| current.Edition < '1950'
		return previous
	}
    if (previous[current.Edition] && previous[current.Edition].length > 0) {
        previous[current.Edition].push({
            name: current.NOC,
            value: current.count
        })
    } else {
        previous[current.Edition] = [
            {
                name: current.NOC,
                value: current.count
            }
        ]
    }
    return previous
}, {})

var finalTransformation = Object.keys(initialTransformation).map(function(key) {
    return {
        name: key,
        data: initialTransformation[key]
    }
})


console.log(JSON.stringify(finalTransformation, null, 2))
	Highcharts.chart('container', {
    chart: {
        type: 'packedbubble',
        height: '100%'
    },
    title: {
        text: 'Countries and Their Medal Count, by Year'
    },
    tooltip: {
        useHTML: true,
        pointFormat: '<b>{point.name}:</b> {point.value} medals</sub>'
    },
    plotOptions: {
        packedbubble: {
            minSize: '20%',
            maxSize: '100%',
            zMin: 0,
            zMax: 1000,
            layoutAlgorithm: {
                gravitationalConstant: 0.05,
                splitSeries: true,
                seriesInteraction: false,
                dragBetweenSeries: true,
                parentNodeLimit: true
            },
            dataLabels: {
                enabled: true,
                format: '{point.names}',
                filter: {
                    property: 'y',
                    operator: '>',
                    value: 250
                },
                style: {
                    color: 'black',
                    textOutline: 'none',
                    fontWeight: 'normal'
                }
            }
        }
    },
    series: finalTransformation

});
</script>

