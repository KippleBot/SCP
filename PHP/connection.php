<?php
include "credentials.php"
$connection= new mysqli('localhost',$db,$user,$password)
$record=$connection->("select * from scp")
$record=execute();
$result=$record->get_result();
?>