<?php
/*$db = new Database();

$session = new Session();
$loggedIn = $session->checkLoginStatus();

$mwSql = '
SELECT 
	`m`.`Country`, 
	`m`.`NOC_Code`,
	`m`.`Totals`,
	`m`.`Golds`,
	`m`.`Silvers`,
	`m`.`Bronzes`,
	`w`.`Annual_temp` AS `average_temperature`
FROM `medalcounts` AS `m`
LEFT JOIN `weather` AS `w`
ON `m`.`NOC_code` = `w`.`ISO_3DIGIT`';


$medals = $db->object('Medals', $mwSql);
*/

$db = new Database();

$session = new Session();
//$loggedIn = $session->checkLoginStatus();

$happiness = $db->object('Happiness');

$caption = 'Happiness';
$headers = array('Country_name', 'year', 'Life_Ladder', 'GDP_percapita', 'Social_support', 'Healthy_life_expectancy_at_birth', 'Freedom_to_make_life_choices', 'Generosity', 'Perceptions_of_corruption', 'Positive_affect', 'Negative_affect' );
$data = $happiness; // note: this would be an array of rows from a database query
$attributes = array('id' => 'happinessTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; // if the UI file has not been included yet
$ui = new UI(); // if the UI class has not been called yet;


$tableRows = array();
$counter = 0;
foreach ($happiness as $happy) {
$tableRows[$counter][] = $happy->Country_name;
$tableRows[$counter][] = $happy->year ;
$tableRows[$counter][] = $happy->Life_Ladder;
$tableRows[$counter][] = $happy->GDP_percapita;
$tableRows[$counter][] = $happy->Social_support;
$tableRows[$counter][] = $happy->Healthy_life_expectancy_at_birth;
$tableRows[$counter][] = $happy->Freedom_to_make_life_choices;
$tableRows[$counter][] = $happy->Generosity;
$tableRows[$counter][] = $happy->Perceptions_of_corruption;
$tableRows[$counter][] = $happy->Positive_affect;
$tableRows[$counter][] = $happy->Negative_affect;
$counter++; // increment the counter by 1
}
// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $tableRows, $attributes);
$dialog = $ui->dialog();



echo $dialog;
echo "<div class='happiness-table'>";
echo $table;
echo  "</div>"; 
