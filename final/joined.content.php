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
$counter++; // increment the counter by 1
}
// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $tableRows, $attributes);
$dialog = $ui->dialog();

echo $dialog;
echo "<div class='joined-table'>";
echo $table;
echo  "</div>"; 


$target = "text.txt";
$linkname = "here";

echo 'To see some visualization on this table, click <a href="http://localhost/final/joined2.php"> here</a>.';

?>





