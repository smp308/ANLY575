<?php
$db = new Database();

$session = new Session();
//$loggedIn = $session->checkLoginStatus();

$weather = $db->object('Weather');

$caption = 'Weather';
$headers = array('ISO_3DIGIT', 'Jan_Temp', 'Feb_Temp', 'Mar_Temp', 'Apr_Temp', 'May_Temp', 'Jun_Temp', 'July_Temp', 'Aug_Temp', 'Sept_Temp', 'Oct_Temp', 'Nov_Temp', 'Dec_Temp', 'Annual_Temp');
$data = $weather; // note: this would be an array of rows from a database query
$attributes = array('id' => 'weatherTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; // if the UI file has not been included yet
$ui = new UI(); // if the UI class has not been called yet;

$tableRows = array();
$counter = 0;
foreach ($weather as $weath) {
$tableRows[$counter][] = $weath->ISO_3DIGIT;
$tableRows[$counter][] = $weath->Jan_Temp ;
$tableRows[$counter][] = $weath->Feb_Temp;
$tableRows[$counter][] = $weath->Mar_Temp;
$tableRows[$counter][] = $weath->Apr_Temp;
$tableRows[$counter][] = $weath->May_Temp;
$tableRows[$counter][] = $weath->Jun_Temp;
$tableRows[$counter][] = $weath->July_Temp;
$tableRows[$counter][] = $weath->Aug_Temp;
$tableRows[$counter][] = $weath->Sept_Temp;
$tableRows[$counter][] = $weath->Oct_Temp;
$tableRows[$counter][] = $weath->Nov_Temp;
$tableRows[$counter][] = $weath->Dec_Temp;
$tableRows[$counter][] = $weath->Annual_Temp;
$counter++; // increment the counter by 1
}

// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $data, $attributes);
$dialog = $ui->dialog();


echo $dialog;
echo "<div class='weather-table'>";
echo $table;
echo  "</div>"; 

