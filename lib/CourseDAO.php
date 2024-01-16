<?php

class CourseDAO
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function selectAll()
    {
        $sql = "select co.id,co.title course_title,ca.title category_title from courses co 
        inner join categories ca on co.category_id = ca.id order 
        by co.id";
    
        $stmt = $this->pdo->query($sql);
        $courses = $stmt->fetchAll();
        return $courses;
    }
    public function selectById($course_id)
    {
        $sql = "select co.id,co.title course_title,ca.title category_title
        from courses co left join categories ca 
        on co.category_id = ca.id
        where co.id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id",$course_id,PDO::PARAM_INT);
        $stmt->execute();
        
        $course = $stmt->fetch();
        return $course;
    }
}
?>