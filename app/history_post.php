<?php
require_once("../lib/functions.php");
require_once("../lib/HistoryDAO.php");

$account_id = get_account_id();
if($account_id == false){
    echo "アカウントないよ";
    header("Location:error.php");
    exit();
}

$csrf_token = (string)filter_input(INPUT_POST,"csrf_token");

if(validate_csrf_token($csrf_token) ===false) {
    header("location:error.php");
    exit();

}
$course_id = (string)filter_input(INPUT_POST,"course_id");
if($course_id === ""){
    echo "値なし";
} 
if(filter_var($course_id,FILTER_VALIDATE_INT) === false){
    header("location:error.php");
}
$section_id = (string)filter_input(INPUT_POST,"section_id");
if($section_id !== "" && filter_var($section_id,FILTER_VALIDATE_INT) === false){
    echo "イント型じゃないよ";
    exit();
}
if(filter_var($section_id,FILTER_VALIDATE_INT) === false){
    header("location:error.php");
}

try{
$pdo = new_PDO();

$history_dao = new historyDAO($pdo);
$history = $history_dao->insert($account_id,$section_id);

set_message(MESSAGE_FINISH_SECTION);

header("location:detail.php?course_id=$course_id&section_id=$section_id");


}catch(PDOException $e){

    echo $e->getMessage();

}

?>