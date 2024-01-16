<?php 
require_once("../lib/functions.php");
require_once("../lib/CourseDAO.php");
require_once("../lib/SectionDAO.php");

//course_idは<a href="detail.php?course_id=<?= h($course["id"])?＞のcourse_idから来る
$course_id = (string)filter_input(INPUT_GET,"course_id");
if($course_id === ""){
    echo "値なし";
} 
if(filter_var($course_id,FILTER_VALIDATE_INT) === false){
    header("location:error.php");
}
$section_id = (string)filter_input(INPUT_GET,"section_id");
if($section_id !== "" && filter_var($section_id,FILTER_VALIDATE_INT) === false){
    echo "イント型じゃないよ";
    exit();
}

try{
    $pdo = new_PDO();
    $course_dao = new CourseDAO($pdo);
    $course = $course_dao->selectById($course_id);

    $section_dao = new SectionDAO($pdo);

    $account_id = get_account_id();
    
    if($account_id != false){
       $sections = $section_dao->selectByCourseIdAndAccountId($course_id,$account_id);
    }else {
        $sections = $section_dao->selectByCourseId($course_id);
    }

    if(count($sections) === 0){
        echo "値ないよ";
        
    }
    $current_section = $sections[0];
    foreach($sections as $section){
        if((int)$section["id"] === (int)$section_id){
            $current_section = $section;
            break;
        }
    }

    if(is_sign_in()){
        $csrf_token = generate_csrf_token();
    }
require("../views/detail_view.php");

}catch(PDOException $e){
    echo $e->getMessage();
}

?>
