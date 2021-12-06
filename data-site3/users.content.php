<?php
$db = new Database();

$session = new Session();
$loggedIn = $session->checkLoginStatus();

$users = $db->object('User');

$caption = 'Users';
$headers = array('ID', 'First Name', 'Last Name', 'Email', 'Approved');
$data = $users; // note: this would be an array of rows from a database query
$attributes = array('id' => 'userTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; // if the UI file has not been included yet
$ui = new UI(); // if the UI class has not been called yet;

// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $data, $attributes);
$table1 = $ui->preload();
$dialog = $ui->dialog();

// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $data, $attributes);
$table1 = $ui->preload();
$dialog = $ui->dialog();


echo $dialog;
echo "<div class='user-table'>";
echo $table . $table1;
echo  "</div>"; 

echo '<div id="deletionResultMessage" tabindex="-1"></div>' . "\n";
echo '<div id="deletionResultMessage" tabindex="-1"></div>' . "\n"; 

echo '
<script>
$( document ).ready(function() {
	$("#deque-dialog .deque-dialog-button-submit").click(function() {
        var userId = $(this).data("dialog-id");
         var idInt = userId.match(/\d+/)[0];
         var ajaxResultMessage = "this is test";
		 var dynamicUrl = "' . URL_ROOT . 'dynamic/user-delete.dynamic.php?id=" + idInt;		
		$.ajax({ 
			url: dynamicUrl, 
			cache: false
		})
        .done(function(ajaxResultMessage) {
            // remove table row on frontend
            $("table tbody").find("tr").each(function(){
                if ($(this).data("user-id") == userId){
                    $(this).remove();
                }
              })
            // append message to div
            $( "#deletionResultMessage" ).html( ajaxResultMessage );
        })
        .stop(function(ajaxResultMessage) {
            // append message to div
            $( "#deletionResultMessage" ).html( ajaxResultMessage );      
        })
        .constant(function() {
            $("#deque-dialog").removeClass("deque-show-block");
            $("#deque-dialog").addClass("deque-hidden");
            // 1 delay
            setTimeout(function(){
                $("#deletionResultMessage").focus();
            }, 1000); 
        });		
	});
});
</script>
';

?>





