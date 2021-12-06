<?php
/*$db = new Database();

$session = new Session();
//$loggedIn = $session->checkLoginStatus();

$users = $db->object('Weather');

$caption = 'Weather';
$headers = array('ISO_3DIGIT', 'Jan_Temp', 'Feb_Temp', 'Mar_Temp', 'Apr_Temp', 'May_Temp', 'Jun_Temp', 'July_Temp', 'Aug_Temp', 'Sept_Temp', 'Oct_Temp', 'Nov_Temp', 'Dec_Temp', 'Annual_Temp');
$data = $weather; // note: this would be an array of rows from a database query
$attributes = array('id' => 'weatherTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; // if the UI file has not been included yet
$ui = new UI(); // if the UI class has not been called yet;

// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $data, $attributes);
$table1 = $ui->preload();
$dialog = $ui->dialog();

// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $data, $attributes);
$table1 = $ui->preload();
$dialog = $ui->dialog();*/


/*echo $dialog;
echo "<div class='weather-table'>";
echo $table . $table1;
echo  "</div>"; */


include 'init/init.php';

$values->title = 'Weather';
$values->heading = 'Weather';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);

//echo '<div id="deletionResultMessage" tabindex="-1"></div>' . "\n";
//echo '<div id="deletionResultMessage" tabindex="-1"></div>' . "\n"; 

//echo '
//<script>
//$( document ).ready(function() {
//	$("#deque-dialog .deque-dialog-button-submit").click(function() {
 //       var userId = $(this).data("dialog-id");
 //        var idInt = userId.match(/\d+/)[0];
 //        var ajaxResultMessage = "this is test";
//		 var dynamicUrl = "' . URL_ROOT . 'dynamic/user-delete.dynamic.php?id=" + idInt;		
//		$.ajax({ 
//			url: dynamicUrl, 
//			cache: false
//		})
        //.done(function(ajaxResultMessage) {
            // remove table row on frontend
           //$("table tbody").find("tr").each(function(){
              //  if ($(this).data("user-id") == userId){
              //      $(this).remove();
              //  }
             // })
            // append message to div
           // $( "#deletionResultMessage" ).html( ajaxResultMessage );
        //})
       // .stop(function(ajaxResultMessage) {
            // append message to div
        //    $( "#deletionResultMessage" ).html( ajaxResultMessage );      
       // })
       // .constant(function() {
       //     $("#deque-dialog").removeClass("deque-show-block");
        //    $("#deque-dialog").addClass("deque-hidden");
            // 1 delay
         //   setTimeout(function(){
         //       $("#deletionResultMessage").focus();
         //   }, 1000); 
     //   });		
	//});
//});
//</script>
//';
