<?php

function mysql_connect_default($database) {
    $connection = mysqli_connect('localhost', 'root', 'Sasha10asd!', $database);
    if( mysqli_connect_errno() )
        die;
    return $connection;
}

function db_table_parse($str, &$database, &$table) {
    $parts = explode('.', $str);
    $database = $parts[0] ?? null;
    $table = $parts[1] ?? null;
}

function mysql_query_default($connection, $query) {
    $result = mysqli_query($connection, $query);
    if ( mysqli_errno($connection) )
        die(mysqli_error($connection));
    return $result;
}

function where_builder($where) {
    if(!$where)
        return null;
    
    $str = 'WHERE ';
    foreach ($where as $key => $value) {
        $str .= "$key=$value AND ";
    }
    $str = trim($str, ' AND ');
    return $str;
}

function mysql_first($table, $cols = '*', array $where = null) {
    $data = mysql_select($table, $cols, $where);
    return $data;
}

function mysql_select($table, $cols = '*', array $where = null) {
    db_table_parse($table, $database, $table);
    $connection = mysql_connect_default($database);

    if(is_array($cols))
        $cols = implode(',', $cols);

    $query = "SELECT {$cols} FROM {$table} " . where_builder($where);
    $result = mysql_query_default($connection, $query);

    mysqli_close($connection);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function mysql_insert($table, $args) {
    db_table_parse($table, $database, $table);
    $connection = mysql_connect_default($database);

    $query = "INSERT INTO $table(";

    foreach ($args as $key => $value) {
        $query .= "$key,";
    }
    $query = rtrim($query, ',');
    $query .= ') VALUES (';

    foreach ($args as $key => $value) {
        $query .= "'$value',";
    }
    $query = rtrim($query, ',');
    $query .= ');';

    $result = mysql_query_default($connection, $query); 
    mysqli_close($connection);

    return $result;
}

function mysql_delete($table, array $where) {
    db_table_parse($table, $database, $table);
    $connection = mysql_connect_default($database);

    $query = "DELETE FROM $table " . where_builder($where);

    $result = mysql_query_default($connection, $query); 
    mysqli_close($connection);

    return $result;
}

function set_builder($set) {
    if(!$set)
        return null;
    
    $str = 'SET ';
    foreach ($set as $key => $value) {
        $str .= "$key=$value, ";
    }
    $str = trim($str, ', ');
    return $str;
}

function mysql_update($table, array $where, array $data) {
    db_table_parse($table, $database, $table);
    $connection = mysql_connect_default($database);

    $query = "UPDATE $table " . set_builder($data) . " " . where_builder($where);

    $result = mysql_query_default($connection, $query); 
    mysqli_close($connection);

    return $result;
}