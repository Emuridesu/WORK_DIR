<?php
require_once("../lib/functions.php");
require_once("../lib/CourseDAO.php");



try{
    $pdo = new_PDO();

    $course_dao = new CourseDAO($pdo);
    $courses = $course_dao->selectAll();

    require("../views/index_view.php");

}catch(PDOException $e){
    echo $e->getMessage();
header("location: error.php");
exit();

}
?>