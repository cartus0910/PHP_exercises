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

$sql="SELECT * FROM `ass6`.`account` ORDER BY `time` DESC";
$prepare=$conn->prepare($sql);
$prepare->execute();                           //$conn->query($sql), SQL injection
$result=$prepare->fetchAll();
$conn=null;

$items=[];
foreach($result as $rs){$items[]=[
	"time"=>(double)($rs[1]),
	"type"=>$rs[2],
	"selection"=>$rs[3],
	"cost"=>intval($rs[4]),
	"note"=>$rs[5]];}

echo json_encode($items,384);
