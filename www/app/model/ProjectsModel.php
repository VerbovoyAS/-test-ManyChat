<?php

class ProjectsModel
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
            ->query("SELECT * FROM `projects` ORDER BY id ASC")
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
        $sql = $this->_db->prepare("SELECT * FROM `projects` WHERE id=:id");
        $sql->execute(['id' => $id]);
        return $sql->fetch();
    }

    public function add()
    {
        $sql = $this->_db->prepare("INSERT INTO projects (name) VALUES (:name)");
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
            "UPDATE projects SET name = :name, updated_at = :updated_at, is_delete = :is_delete WHERE id = :id"
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
        $sql = $this->_db->prepare("DELETE FROM `projects` WHERE `id` = :id");
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

    private function validateQuery($name): string
    {
        return trim(filter_var($name, FILTER_SANITIZE_STRING));;
    }

    /**
     * @param $query
     * @return mixed
     * @throws ErrorException
     */
    public function getProjects($query)
    {
        $this->validateId($query['id']);
        return $this->getOne($query['id']);
    }

    /**
     * @param $query
     * @return string
     */
    public function addNewProjects($query): string
    {
        if (empty($query['name'])) {
            return 'Пустое название проекта';
        }
        $name = $this->validateQuery($query['name']);

        $this->name = $name;
        $this->add();
        return 'Проект добавлен';
    }

    /**
     * @param $query
     * @return string
     * @throws ErrorException
     */
    public function updateProjects($query): string
    {
        if (empty($query['name'])) {
            return 'Пустое название проекта';
        }

        $this->name = $this->validateQuery($query['name']);
        $this->update($query['id']);

        return 'Название проекто обновлено на ' . $query['name'];
    }
}