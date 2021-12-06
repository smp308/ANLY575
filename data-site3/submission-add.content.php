<?php

$db = new Database();


include CLASS_PATH . 'Submission.class.php';
$sub = new Submission();
if ($sub->add() === true) {
return;
 }

$sql = 'SELECT `id`, `name` FROM `courses`';

$courses = $db->object('Course', $sql);

$optionsList = array();
foreach ($courses as $k => $courseObject) {
	$optionsList[$courseObject->id] = $courseObject->name;
}


include CLASS_PATH . 'UI.class.php';
$ui = new UI();

echo '<form action="' . $_SERVER['PHP_SELF']  . '" method="post">' . "\n";

echo $ui->selectList('courseSelect', 'course_id', $optionsList, 'Step 1: Choose a Course', true);

echo '<div id="dynamicContentWrapper"></div>' . "\n";

echo "</form>\n";

echo '
<script>

$( document ).ready(function() {
	$("#courseSelect").change(function() {
		var val = $( "#courseSelect option:checked" ).val();
		console.log(val);
		var dynamicUrl = "' . URL_ROOT . 'dynamic/assignment-select.dynamic.php?course_id=" + val;
		console.log(dynamicUrl);
		
		$.ajax({ 
			url: dynamicUrl, 
			cache: false
		})
		.done(function( html ) {
			$( "#dynamicContentWrapper" ).html( html );
		});
		
	});




});
</script>
';


/*
$.ajax({
  url: "[[~18437]]",
  cache: false
})
  .done(function( html ) {
    $( "#memberData" ).html( html );
  });
*/
/*
echo '<pre>';
print_r($optionsList);
echo '</pre>';
*/