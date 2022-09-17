<?php
require 'db_data.php';
$result = getData($con, $_SESSION['Id']);
$_SESSION['Names'] = $result['Names'];
$_SESSION['Total_Players'] = $result['Total_Players'];
$_SESSION['Player_Array'] = explode(",",$result['Player_Array']);
$_SESSION['Card_Used'] = explode(",",$result['Cards_Used']);
print_r(implode(",",$_SESSION['Card_Used']));
?>