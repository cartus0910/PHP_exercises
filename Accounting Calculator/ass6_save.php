<?php
$db_servername = "localhost";
$db_username = "angus0822";
$db_password = "root";
$db_database = "ass6";
$db_port = NULL; 


try{
  $conn = new PDO("mysql:host={$db_servername};port={$db_port};dbname={$db_database}", 
                  $db_username, 
                  $db_password,
                  array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'  //important
                  )
                 );
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e)
{
  //echo "database connection failed: ({$db_servername}:{$db_port})\n {$e->getMessage()}";
  exit;
}

function Query($db,$sql,$bindValue=[]){
  $prepare=$db->prepare($sql);
  if(is_array($bindValue)){
    foreach($bindValue as $key => $value)
      $prepare->bindValue($key,$value);
  }
  $k=$prepare->execute();
  try {
    $result=$prepare->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  catch(PDOException $e){
    return $k;
  }
}

$sql="INSERT INTO `account` (`ID`, `time`, `type`, `selection`, `cost`, `note`) VALUES (NULL,:time,:type,:selection,:cost,:note)";
Query($conn,$sql,
    [
      "time"=>$_POST['time'],
      "type"=>$_POST['type'],
      "selection"=>$_POST['selection'],
      "cost"=>$_POST['cost'],
      "note"=>$_POST['note']
    ]
);
$conn=null;

