<?php

class HomeModel
{
    private ?PDO $_db;

    public function __construct()
    {
        $this->_db = DB::getInstanse();
    }

    public function getReports()
    {
        return $this->_db->query("
            SELECT
            pr.id,
            pr.name,
            SUM(s.salary)as budget
            FROM `staff` as s
            LEFT JOIN projects as pr on pr.id = s.project_id
            LEFT JOIN department as dp on dp.id = s.department_id
            GROUP by 
            pr.id,
            pr.name
            order by budget desc;
        ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

}