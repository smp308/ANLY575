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
$counter = 0;
foreach ($happiest as $happy) {
$tableRows[$counter][] = $happy->Country;
$tableRows[$counter][] = $happy->Totals;
$tableRows[$counter][] = $happy->Positive_affect;
$tableRows[$counter][] = $happy->Negative_affect;


$countries[$counter] = $happy->Country;
$pos[$counter] = $happy->Positive_affect;
$neg[$counter] = $happy->Negative_affect;
$tots[$counter] = $happy->Totals;
$counter++; // increment the counter by 1
}
// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $tableRows, $attributes);
$dialog = $ui->dialog();

echo 'As defined by the World Happiness Report, "Positive affect comprises the average frequency of happiness, laughter and enjoyment on the previous day, and negative affect comprises the average frequency of worry, sadness and anger on the previous day. The affect measures thus lie between 0 and 1".<br><br>';
echo 'To see some visualization on this table, click <a href="http://localhost/final/happycountsviz.php"> here</a>. or <a href="http://localhost/final/happycount2.php"> here</a>.<br><br>';

echo $dialog;
echo "<div class='happiest-table'>";
echo $table;
echo  "</div>"; 

?>