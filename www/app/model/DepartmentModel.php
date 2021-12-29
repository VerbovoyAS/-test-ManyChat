<?php

class DepartmentModel
{
    private ?PDO $_db;

    public $name;
    public $updated_at;
    public $is_delete;

    public function __construct()
    {
        $this->_db = DB::getInstanse();
    }

    public function getAll()
    {
        return $this->_db
            ->query("SELECT * FROM `department` ORDER BY id ASC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return mixed
     * @throws ErrorException
     */
    public function getOne($id)
    {
        $this->validateId($id);
        $sql = $this->_db->prepare("SELECT * FROM `department` WHERE id=:id");
        $sql->execute(['id' => $id]);
        return $sql->fetch();
    }

    public function add()
    {
        $sql = $this->_db->prepare("INSERT INTO department (name) VALUES (:name)");
        $sql->bindParam(':name', $name);
        $name = $this->name;
        $sql->execute();
    }

    /**
     * @param $id
     * @throws ErrorException
     */
    public function update($id)
    {
        $this->validateId($id);

        $sql = $this->_db->prepare(
            "UPDATE department SET name = :name, updated_at = :updated_at, is_delete = :is_delete WHERE id = :id"
        );
        $sql->bindValue(":id", $id);
        $sql->bindValue(":name", $this->name);
        $sql->bindValue(":updated_at", $this->updated_at ?? date('Y-m-d H:i:s'));
        $sql->bindValue(":is_delete", $this->is_delete ?? 0);

        $sql->execute();
    }

    /**
     * @param $id
     * @throws ErrorException
     */
    public function delete($id)
    {
        $this->validateId($id);

        $sql = $this->_db->prepare("DELETE FROM `department` WHERE `id` = :id");
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

    private function validateQuery($name)
    {
        return trim(filter_var($name, FILTER_SANITIZE_STRING));;
    }

    /**
     * @param $query
     * @return string
     */
    public function addNewDepartment($query): string
    {
        if (empty($query['name'])) {
            return 'Пустое название отдела';
        }
        $name = $this->validateQuery($query['name']);

        $this->name = $name;
        $this->add();
        return 'Отдел добавлен';
    }

    /**
     * @param $query
     * @return mixed
     * @throws ErrorException
     */
    public function getDepartment($query)
    {
        $this->validateId($query['id']);
        return $this->getOne($query['id']);
    }

    /**
     * @param $query
     * @return string
     * @throws ErrorException
     */
    public function updateDepartment($query): string
    {
        if (empty($query['name'])) {
            return 'Пустое название отдела';
        }

        $this->name = $this->validateQuery($query['name']);
        $this->update($query['id']);

        return 'Название отдела обновлено на ' . $query['name'];
    }

}