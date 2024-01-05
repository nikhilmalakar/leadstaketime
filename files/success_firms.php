<?php
include __DIR__."/../configs.php";

$log_session = ( isset($_SESSION['login']) ? (int)$_SESSION['login'] : ( isset($_COOKIE['login']) ? (int)$_COOKIE['login'] : 0 ) );
$query = "UPDATE ".prefix."users SET plan = '4' WHERE id = '{$log_session}'";
// echo $query;
// echo $_COOKIE['login'];
// echo us_id; 
$result = mysqli_query($db, $query);

if($result){
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($db);
}
// echo path;
header("Location: ".path."/../index.php");
?>