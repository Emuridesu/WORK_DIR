<?php 
require_once("../lib/functions.php");
require_once("../lib/HistoryDAO.php");

$account_id = get_account_id();

if($account_id === false){
    echo "値無し";
    header("location:error.php");
    exit();


}

try{
$pdo = new_PDO();

$history_dao = new historyDAO($pdo);
$histories = $history_dao->selectbyaccountid($account_id);


    require("../views/history_view.php");
}catch(PDOException $e){
   echo $e->getMessage();
 

}




?>