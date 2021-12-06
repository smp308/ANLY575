<?php

$db = new Database();

$session = new Session();


$sql = '
SELECT 
	`c`.`Country`, 
	`m`.`NOC_Code`,
	`m`.`Totals`,
	`m`.`Golds`,
	`m`.`Silvers`,
	`m`.`Bronzes`,
	`h`.`GDP_percapita` AS `GDP`,
	`h`.`Healthy_life_expectancy_at_birth` AS `life_expectancy`,
	`h`.`Freedom_to_make_life_choices` AS `freedom`
FROM `medals` AS `m`
INNER JOIN `countries` AS `c`
	ON `m`.`NOC_code` = `c`.`Olympic_Committee_code`
INNER JOIN `happiness` AS `h`
	ON `h`.`Country_name` = `c`.`Country`
WHERE `h`.`year`= 2018 
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


$caption = 'How Safe does Each Civilian Feel in Their Country (finances, health, freedom) vs Medal Stadings';
$headers = array('Country', 'Code', 'Total Medals', 'Golds', 'Silvers', 'Bronzes', 'GDP', 'Life expectancy', 'Degree of Freedom');
$data = $joined; // note: this would be an array of rows from a database query
$attributes = array('id' => 'joinedTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; // if the UI file has not been included yet
$ui = new UI(); // if the UI class has not been called yet;

// Call tables and dialog
$tableRows = array();
$counter = 0;
foreach ($joined as $join) {
$tableRows[$counter][] = $join->Country;
$tableRows[$counter][] = $join->NOC_Code ;
$tableRows[$counter][] = $join->Totals;
$tableRows[$counter][] = $join->Golds;
$tableRows[$counter][] = $join->Silvers;
$tableRows[$counter][] = $join->Bronzes;
//$tableRows[$counter][] = $join->average_temperature;
$tableRows[$counter][] = $join->GDP;
$tableRows[$counter][] = $join->life_expectancy;
$tableRows[$counter][] = $join->freedom;

$counter++; // increment the counter by 1
}
// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $tableRows, $attributes);
$dialog = $ui->dialog();

echo $dialog;
echo "<div class='joined-table'>";
echo $table;
echo  "</div>"; 

echo 'To see some visualization on this table, click <a href="http://localhost/final/viz.html"> here</a>.';


?>
