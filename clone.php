<?php

include 'fx.php';

//===============read config ===================
$conf_array = parse_ini_file("config.ini", true);


$db_server_master = $conf_array["master"]["host"];
$db_user_master = $conf_array["master"]["user"];
$db_pass_master = $conf_array["master"]["pass"];
$db_master = $conf_array["master"]["database"];

$db_server_slave = $conf_array["slave"]["host"];
$db_user_slave = $conf_array["slave"]["user"];
$db_pass_slave = $conf_array["slave"]["pass"];
$db_slave = $conf_array["slave"]["database"];

//===============DB Connection =====================

$conn_master = mysqli_connect($db_server_master, $db_user_master, $db_pass_master, $db_master);

// Check connection
if (!$conn_master) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn_slave = mysqli_connect($db_server_slave, $db_user_slave, $db_pass_slave, $db_slave);

// Check connection
if (!$conn_slave) {
    die("Connection failed: " . mysqli_connect_error());
}

//===============list table in DB ===================

$table_list = showtables($conn_master, $db_master);

//==================process==========================
$i = 1;
while ($i < count($table_list)) {
    copy_data_table($conn_master, $conn_slave,$db_master,$table_list[$i][0]);
    $i++;
}



?>