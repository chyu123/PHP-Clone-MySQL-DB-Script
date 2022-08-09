<?php

function showtables($conn_db,$db)
{
    //list table
    $sql = "SHOW TABLES FROM ".$db;
    $result = $conn_db->query($sql);
    $table_list[] = "";
    while ($row1 = $result->fetch_array(MYSQLI_NUM)) {
        $table_list[] = $row1;
    }
    return $table_list;
}

function copy_data_table($conn_db_master, $conn_db_slave,$db,$table)
{
    erase_table($conn_db_slave, $table);
    $sql_copy = "select * from ".$table;
    $result_copy = $conn_db_master->query($sql_copy);
    
    while ($row = $result_copy->fetch_array(MYSQLI_ASSOC)) {
        $sql = make_sql_string($table,$row);
        $conn_db_slave->query($sql);
    }
}

function erase_table($conn_db,$table)
{
    $sql = "truncate ".$table;
    $conn_db->query($sql);
}

function make_sql_string($table, $row)
{

    $x = count($row);
    $colume_phase = "";
    $value_phase = "";
    
    for ($i=0; $i < $x; $i++) { 
    
        if($i!=$x-1){
            $colume_phase .= array_keys($row)[$i].", ";
            if(!is_null(array_values($row)[$i]) ){
                $value_phase .= "'".array_values($row)[$i]."', ";
            }else{
                $value_phase .= "NULL, ";                
            }
        }else{
            $colume_phase .= array_keys($row)[$i];
            if(!is_null(array_values($row)[$i])){
                $value_phase .= "'".array_values($row)[$i]."' ";
            }else{
                $value_phase .= "NULL ";
            }
        }
    }

    $sql = "insert into ".$table."( ".$colume_phase." ) values ( ".$value_phase." );";

    return $sql;

}


?>