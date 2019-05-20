<?php
extract($_POST);
$result= $siblings; 
$arrayName = array('Siblings'=>$result);

$poi = json_encode($arrayName);
echo $poi;
?>
