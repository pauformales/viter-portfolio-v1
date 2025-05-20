<?php

class Experience
{


    public $experience_aid;
    public $experience_is_active;
    public $experience_title;
    public $experience_description;
    public $experience_created;
    public $experience_updated;



    public $start;
    public $total;
    public $search;

    public $connection;
    public $lastInsertedId;

    public $tblExperience;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblExperience = 'db_experience';
    }

    public function create()
    {
        try {
            $sql = "INSERT INTO {$this->tblExperience} (
                experience_is_active,
                experience_title,
                experience_description,
                experience_created,
                experience_updated
            ) VALUES (
                :experience_is_active,
                :experience_title,
                :experience_description,
                :experience_created,
                :experience_updated
            )";

            $query = $this->connection->prepare($sql);
            $query->execute([
                "experience_is_active" => $this->experience_is_active,
                "experience_title" => $this->experience_title,
                "experience_description" => $this->experience_description,
                "experience_created" => $this->experience_created,
                "experience_updated" => $this->experience_updated,
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
            $sql = "SELECT 
                    experience_aid, 
                    experience_is_active, 
                    experience_title, 
                    experience_description, 
                    experience_created, 
                    experience_updated 
                FROM {$this->tblExperience} 
                ORDER BY 
                    experience_is_active DESC, 
                    experience_title ASC, 
                    experience_description ASC";

            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }


    public function readLimit()
    {
        try {
            $sql = "SELECT 
                        experience_aid, 
                        experience_is_active, 
                        experience_title, 
                        experience_description, 
                        experience_created, 
                        experience_updated 
                    FROM {$this->tblExperience} 
                    ORDER BY 
                        experience_is_active DESC, 
                        experience_title ASC 
                    LIMIT :start, :total";

            $query = $this->connection->prepare($sql);

            // PDO requires integers to be explicitly bound for LIMIT
            $query->bindValue(':start', (int)($this->start - 1), PDO::PARAM_INT);
            $query->bindValue(':total', (int)$this->total, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }


    public function search()
    {
        try {
            $sql = "select ";
            $sql .= "experience_aid, ";
            $sql .= "experience_is_active, ";
            $sql .= "experience_title, ";
            $sql .= "experience_description, ";
            $sql .= " experience_created,";
            $sql .= " experience_updated ";
            $sql .= "from {$this->tblExperience} ";
            $sql .= "where ";
            $sql .= "experience_title like :experience_title ";
            $sql .= "or experience_description like :experience_description ";
            $sql .= "order by ";
            $sql .= "experience_is_active desc, ";
            $sql .= "experience_title asc ";


            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'experience_title' => "%{$this->search}%",
                'experience_description' => "%{$this->search}%",

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function filterSearch()
    {
        try {
            $sql = "select ";
            $sql .= "experience_aid, ";
            $sql .= "experience_is_active, ";
            $sql .= "experience_title, ";
            $sql .= "experience_description, ";
            $sql .= "experience_created, ";
            $sql .= "experience_updated ";
            $sql .= "from {$this->tblExperience} ";
            $sql .= "where ";
            $sql .= "experience_is_active = :experience_is_active ";
            $sql .= "and ( ";
            $sql .= "experience_title like :experience_title ";
            $sql .= "or experience_description like :experience_description ";
            $sql .= ") ";
            $sql .= "order by ";
            $sql .= "experience_is_active desc, ";
            $sql .= "experience_title asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'experience_is_active' => $this->experience_is_active,
                'experience_title' => "%{$this->search}%",
                'experience_description' => "%{$this->search}%",
            ]);
        } catch (PDOException $ex) {
            returnError($ex);
            $query = false;
        }
        return $query;
    }

    public function filter()
    {
        try {
            $sql = "select ";
            $sql .= "experience_aid, ";
            $sql .= "experience_is_active, ";
            $sql .= "experience_title, ";
            $sql .= "experience_description, ";
            $sql .= " experience_created,";
            $sql .= " experience_updated ";
            $sql .= "from {$this->tblExperience} ";
            $sql .= "where ";
            $sql .= "experience_is_active =:experience_is_active ";
            $sql .= "order by ";
            $sql .= "experience_title asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'experience_is_active' => $this->experience_is_active,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM {$this->tblExperience} ";
            $sql .= "WHERE experience_aid = :experience_aid";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'experience_aid' => $this->experience_aid
            ]);
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

    public function checkTitle()
    {
        try {
            $sql = "SELECT experience_aid 
                    FROM {$this->tblExperience}
                    WHERE experience_title = :experience_title";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'experience_title' => $this->experience_title
            ]);

            return $query;
        } catch (PDOException $ex) {
            return false;
        }
    }
}
