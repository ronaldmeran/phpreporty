<?php
$db = new PDO('mysql:host=localhost;dbname=topdraw', 'root', '1qaz2wsx', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")); 

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Get all the tables in the database
$getmenu = "show tables";

$stmt = $db->prepare($getmenu);
$stmt->execute();

echo "<select name='tables'>";

foreach ($stmt as $tables){
	foreach($tables as $t)
    	echo "<option>".$t."</option>"; 
}
echo "</select>";

exit;

?>