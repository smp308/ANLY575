<?php
$db = new Database();

$session = new Session();
//$loggedIn = $session->checkLoginStatus();

$countries = $db->object('Countries');

$caption = 'Countries';
$headers = array('Country', 'Olympic_Committee_code', 'ISO_code','country_id');
$data = $countries; // note: this would be an array of rows from a database query
$attributes = array('id' => 'countriesTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; // if the UI file has not been included yet
$ui = new UI(); // if the UI class has not been called yet;


$tableRows = array();
$counter = 0;
foreach ($countries as $country) {
$tableRows[$counter][] = $country->Country;
$tableRows[$counter][] = $country->Olympic_Committee_code ;
$tableRows[$counter][] = $country->ISO_code;
$tableRows[$counter][] = $country->country_id;
$counter++; // increment the counter by 1
}
// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $tableRows, $attributes);
$dialog = $ui->dialog();



echo $dialog;
echo "<div class='countries-table'>";
echo $table;
echo  "</div>"; 

	
