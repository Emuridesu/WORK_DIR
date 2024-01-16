<?php

class historyDAO
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectbyaccountid($account_id)
    {
    $sql = "select 
        co.id course_id, 
        co.title course_title, 
        se.id section_id, 
        se.title section_title, 
        se.no section_no, 
        hi.created_at 
    from 
        histories hi
        inner join sections se on hi.section_id = se.id 
        inner join courses co on se.course_id = co.id 
    where 
        account_id = :account_id
    order by
        hi.created_at desc";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":account_id",$account_id,PDO::PARAM_INT);
        $stmt->execute();
        $histories = $stmt->fetchAll();

        return $histories;
    }

    public function insert($account_id,$section_id)
    {
        $sql = "insert into histories (account_id,section_id)
                values (:account_id,:section_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":account_id",$account_id,PDO::PARAM_INT);
        $stmt->bindValue(":section_id",$section_id,PDO::PARAM_INT);
       //:nameはプレースホルダーという
        $stmt->execute();
    }

    
}
?>