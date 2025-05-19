<?php
class Experience
{
    public $experience_aid;
    public $experience_is_active;
    public $experience_title;
    public $experience_description;
    public $experience_created;
    public $experience_updated;

    public $connection;
    public $lastInsertedId;

    public $tblExperience;
    public $tblDesignation;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblExperience = 'db_experience';
 
    }



    // CREATE

    public function create()
    {
        try {
            $sql = "insert into {$this->tblExperience}";
            $sql .= "(experience_is_active, ";
            $sql .= "experience_title, ";
            $sql .= "experience_description, ";
            $sql .= "experience_created, ";
            $sql .= "experience_updated) values ( ";
            $sql .= ":experience_is_active, ";
            $sql .= ":experience_title, ";
            $sql .= ":experience_description, ";
            $sql .= ":experience_created, ";
            $sql .= ":experience_updated) ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'experience_is_active' => $this->experience_is_active,
                'experience_title' => $this->experience_title,
                'experience_description' => $this->experience_description,
                'experience_created' => $this->experience_created,
                'experience_updated' => $this->experience_updated
            ]);
            $this->lastInsertedId = $this->connection->lastInsertId();
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function readAll()
    {
        try {
            $sql = "select ";
            $sql .= "* ";
            $sql .= "from {$this->tblExperience} ";
            $sql .= "order by ";
            $sql .= "experience_is_active desc, ";
            $sql .= "experience_title asc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblExperience} set ";
            $sql .= "experience_title = :experience_title, ";
            $sql .= "experience_description = :experience_description, ";
            $sql .= "experience_updated = :experience_updated ";
            $sql .= "where experience_aid = :experience_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "experience_title" => $this->experience_title,
                "experience_description" => $this->experience_description,
                "experience_updated" => $this->experience_updated,
                "experience_aid" => $this->experience_aid,
            ]);
        } catch (PDOException $ex) {

            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblExperience} set ";
            $sql .= "experience_is_active = :experience_is_active, ";
            $sql .= "experience_updated = :experience_updated ";
            $sql .= "where experience_aid = :experience_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "experience_is_active" => $this->experience_is_active,
                "experience_updated" => $this->experience_updated,
                "experience_aid" => $this->experience_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblExperience} ";
            $sql .= "where experience_aid = :experience_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'experience_aid' => $this->experience_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }


    function checkTitle()
    {
        try {
            $sql = "select experience_title ";
            $sql .= "from {$this->tblExperience} ";
            $sql .= "where experience_title = :experience_title ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "experience_title" => $this->experience_title
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }


}
