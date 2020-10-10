<?php

$database = array(
	'host' => 'localhost',
	'user' => 'root',
	'password' => '',
	'name' => 'paschat',
	'table' => 'paschat' 
);

$sql = new mysqli(
	"p:".$database['host'],
	$database['user'],
	$database['password'],
	$database['name']
);

$sql->set_charset("utf8mb4");

function sql($q){
    global $sql;
    $res = mysqli_multi_query($sql, $q);
    if(!$res) error_log("SQL error in '{$q}' >> ".mysqli_error($sql));
    return mysqli_store_result($sql);
}
