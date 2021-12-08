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


$caption = 'Winnings';
$headers = array('Year', 'Country', 'Medal Count');
$data = $winners; 
$attributes = array('id' => 'winnersTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; 
$ui = new UI(); 

// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $data, $attributes);
$dialog = $ui->dialog();


$tableRows = array();
$counter = 0;
foreach ($winners as $winner) {
$tableRows[$counter][] = $winner->Edition;
$tableRows[$counter][] = $winner->NOC ;
$tableRows[$counter][] = $winner->count;
$counter++; // increment the counter by 1
}

echo 'As there are many rows of data to look through, I reccommend taking a look at <a href="http://localhost/final/winners.php"> here</a> visualizaiton of the data.';
echo $dialog;
echo "<div class='win-table'>";
echo $table;
echo  "</div>"; 