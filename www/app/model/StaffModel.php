<?php

require_once 'DepartmentModel.php';
require_once 'ProjectsModel.php';

class StaffModel
{
    private $_db;

    public $name;
    public $surname;
    public $gender;
    public $birthday;
    public $salary;
    public $department_id;
    public $project_id;
    public $updated_at;

    public const GENDER = [
        1 => 'Мужской',
        2 => 'Женский',
    ];

    public function __construct()
    {
        $this->_db = DB::getInstanse();
    }

    public function getAll()
    {
        $result = $this->_db->query("SELECT * FROM `staff` ORDER BY id ASC");
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getOne($id)
    {
        $this->validateId($id);
        $sql = $this->_db->prepare("SELECT * FROM `staff` WHERE id=:id");
        $sql->execute(['id' => $id]);
        return $sql->fetch();
    }

    public function getStaff($query)
    {
        $this->validateId($query['id']);
        return $this->getOne($query['id']);
    }

    public function add()
    {
        $sql = $this->_db->prepare(
            "INSERT INTO staff 
        (name, surname, gender, birthday, salary, department_id, project_id) 
        VALUES (:name, :surname, :gender, :birthday, :salary, :department_id, :project_id)"
        );

        $sql->execute([
                          'name'          => $this->name,
                          'surname'       => $this->surname,
                          'gender'        => $this->gender,
                          'birthday'      => $this->birthday,
                          'salary'        => $this->salary,
                          'department_id' => $this->department_id,
                          'project_id'    => $this->project_id
                      ]);
    }

    /**
     * @param $id
     * @throws ErrorException
     */
    public function update($id)
    {
        $this->validateId($id);

        $sql = $this->_db->prepare(
            "UPDATE staff SET
                 name = :name, surname = :surname, gender = :gender, birthday = :birthday, salary = :salary, department_id = :department_id, project_id = :project_id
                WHERE id = :id"
        );

        $sql->execute([
                          'id'            => $id,
                          'name'          => $this->name,
                          'surname'       => $this->surname,
                          'gender'        => $this->gender,
                          'birthday'      => $this->birthday,
                          'salary'        => $this->salary,
                          'department_id' => $this->department_id,
                          'project_id'    => $this->project_id
                      ]);
    }

    public function delete($id)
    {
        $this->validateId($id);

        $sql = $this->_db->prepare("DELETE FROM `staff` WHERE `id` = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    /**
     * @param $id
     * @throws ErrorException
     */
    private function validateId($id)
    {
        if (!is_numeric($id)) {
            throw new ErrorException('Error validate');
        }
    }

    public function addNewStaff($query)
    {
        foreach ($query as $name => $value) {
            if (empty($value)) {
                return 'Пустое поле ' . $name;
            }
        }

        $this->name = $query['name'];
        $this->surname = $query['surname'];
        $this->gender = $query['gender'];
        $this->birthday = date('Y-m-d');
        $this->salary = $query['salary'];
        $this->department_id = $query['department'];
        $this->project_id = $query['project'];

        $this->add();
        return 'Сотрудник добавлен';
    }

    public function updateStaff($query)
    {
        foreach ($query as $name => $value) {
            if (empty($value)) {
                return 'Пустое поле ' . $name;
            }
        }

        $this->name = $query['name'];
        $this->surname = $query['surname'];
        $this->gender = $query['gender'];
        $this->birthday = $query['birthday'];
        $this->salary = $query['salary'];
        $this->department_id = $query['department'];
        $this->project_id = $query['project'];

        $this->update($query['id']);

        return 'Обновлено';
    }

    public function getOptionDepartment()
    {
        $getDepartmentList = $this->getAllDepartment();

        foreach ($getDepartmentList as $department) {
            $option .= "<option value='{$department["id"]}'>{$department['name']}</option>";
        }
        return $option ?? null;
    }

    public function getOptionProject()
    {
        $getProjectList = $this->getAllProjects();

        foreach ($getProjectList as $project) {
            $option .= "<option value='{$project["id"]}'>{$project['name']}</option>";
        }
        return $option ?? null;
    }

    public function getAllProjects()
    {
        $get = new ProjectsModel();
        return $get->getAll();
    }

    public function getAllDepartment()
    {
        $get = new DepartmentModel();
        return $get->getAll();
    }

    public function getAllProjectsList()
    {
        $getList = $this->getAllProjects();

        $projectsList = [];
        foreach ($getList as $projects) {
            $projectsList[$projects['id']] = $projects['name'];
        }
        return $projectsList;
    }

    public function getAllDepartmentList()
    {
        $getList = $this->getAllDepartment();

        $departmentList = [];
        foreach ($getList as $department) {
            $departmentList[$department['id']] = $department['name'];
        }
        return $departmentList;
    }
}