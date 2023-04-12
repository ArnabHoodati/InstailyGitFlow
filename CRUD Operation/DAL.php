<?php 
include('connection.php');

class DAL {
    private $_connection;

    function __construct() {
        $connectionClass = new Connection();
        $this->_connection = $connectionClass->connect();

    }

    public function insert($argument) {
        $columns = '';
        $values = '';

        foreach($argument['values'] as $column_name => $column_value) {
            $columns .= "`". $column_name . "`,";
            $values .= "'". $column_value . "',";
        }

        $sql = "INSERT INTO " . $argument['table'] . " (";
        $sql .= rtrim($columns, ',') . ") ";
        $sql .= "VALUES (" . rtrim($values, ',') . ")";

        $this->_connection->exec($sql);

    }

    public function update() {

    }
    
    public function get() {

    }

    public function delete() {

    }
}

$dal=new DAL();
$dal->insert([
    'table'=> 'user_details',
    'value'=> [
        'First_name'=>'Arnab',
        'Last_name'=>'Kumar',
        'Phone'=>9564569874,
        'Email'=>"a@testing.com",
    ]
    ])
?>