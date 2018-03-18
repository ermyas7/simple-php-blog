<?php namespace Blog\DB;
require('config.php');

//make connection with the database
function connect($config){
  //return connection
    try{
      $conn = new \PDO('mysql: host=localhost; dbname='.$config['dbname'],
      $config['username'], $config['password']);
      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      return $conn;
    }catch(Exception $e){
      return false;
    }
  }

  //get data from a specific table
  function get($tableName, $conn)
  {
    try{
      $result = $conn->query("SELECT * FROM $tableName");
      //check if the table have any data
      return ($result->rowCount() > 0)
      ?$result
      :false;
    }catch(Exception $e){
      return false;
    }
  }

function query($query, $bindings, $conn)
{
  $stmt = $conn->prepare($query);
  $stmt->execute($bindings);
  $result = $stmt->fetchAll();
  return $result? $result: false;
}
