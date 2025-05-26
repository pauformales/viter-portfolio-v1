<?php

class MainExperience
{


    public $mainexperience_aid;
    public $mainexperience_is_active;
    public $mainexperience_title;
    public $mainexperience_category;
    public $mainexperience_description;
    public $mainexperience_created;
    public $mainexperience_updated;

    public $experience_aid;
    public $experience_is_active;
    public $experience_title;
    public $experience_description;
    public $experience_created;
    public $experience_updated;



    public $mainexperience_start;
    public $mainexperience_total;
    public $mainexperience_search;


    public $experience_start;
    public $experience_total;
    public $experience_search;

    public $connection;
    public $lastInsertedId;

    public $tblMainexperience;
    public $tblExperience;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblMainexperience = 'pf_main_experience';
        $this->tblExperience = 'pf_experience';
    }

    public function create()
    {
        try {
            $sql = "INSERT INTO {$this->tblMainexperience} (
                mainexperience_is_active,
                mainexperience_title,
                mainexperience_category,
                mainexperience_description,
                mainexperience_created,
                mainexperience_updated
            ) VALUES (
                :mainexperience_is_active,
                :mainexperience_title,
                :mainexperience_category,
                :mainexperience_description,
                :mainexperience_created,
                :mainexperience_updated
            )";

            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainexperience_is_active" => $this->mainexperience_is_active,
                "mainexperience_title" => $this->mainexperience_title,
                "mainexperience_category" => $this->mainexperience_category,
                "mainexperience_description" => $this->mainexperience_description,
                "mainexperience_created" => $this->mainexperience_created,
                "mainexperience_updated" => $this->mainexperience_updated,
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
                    mainexperience_aid, 
                    mainexperience_is_active, 
                    mainexperience_title, 
                    mainexperience_category, 
                    mainexperience_description, 
                    mainexperience_created, 
                    mainexperience_updated 
                FROM {$this->tblMainexperience} 
                ORDER BY 
                    mainexperience_is_active DESC, 
                    mainexperience_title ASC, 
                    mainexperience_description ASC";

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
                        mainexperience_aid, 
                        mainexperience_is_active, 
                        mainexperience_title, 
                        mainexperience_category, 
                        mainexperience_description, 
                        mainexperience_created, 
                        mainexperience_updated 
                    FROM {$this->tblMainexperience} 
                    ORDER BY 
                        mainexperience_is_active DESC, 
                        mainexperience_title ASC 
                    LIMIT :start, :total";

            $query = $this->connection->prepare($sql);

            // PDO requires integers to be explicitly bound for LIMIT
            $query->bindValue(':start', (int)($this->mainexperience_start - 1), PDO::PARAM_INT);
            $query->bindValue(':total', (int)$this->mainexperience_total, PDO::PARAM_INT);

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
            $sql .= "mainexperience_aid, ";
            $sql .= "mainexperience_is_active, ";
            $sql .= "mainexperience_title, ";
            $sql .= "mainexperience_category, ";
            $sql .= "mainexperience_description, ";
            $sql .= " mainexperience_created,";
            $sql .= " mainexperience_updated ";
            $sql .= "from {$this->tblMainexperience} ";
            $sql .= "where ";
            $sql .= "mainexperience_title like :mainexperience_title ";
            $sql .= "or mainexperience_description like :mainexperience_description ";
            $sql .= "order by ";
            $sql .= "mainexperience_is_active desc, ";
            $sql .= "mainexperience_title asc ";


            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'mainexperience_title' => "%{$this->mainexperience_search}%",
                'mainexperience_description' => "%{$this->mainexperience_search}%"

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
            $sql .= "mainexperience_aid, ";
            $sql .= "mainexperience_is_active, ";
            $sql .= "mainexperience_title, ";
            $sql .= "mainexperience_category, ";
            $sql .= "mainexperience_description, ";
            $sql .= "mainexperience_created, ";
            $sql .= "mainexperience_updated ";
            $sql .= "from {$this->tblMainexperience} ";
            $sql .= "where ";
            $sql .= "mainexperience_is_active = :mainexperience_is_active ";
            $sql .= "and ( ";
            $sql .= "mainexperience_title like :mainexperience_title ";
            $sql .= "or mainexperience_description like :mainexperience_description ";
            $sql .= ") ";
            $sql .= "order by ";
            $sql .= "mainexperience_is_active desc, ";
            $sql .= "mainexperience_title asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'mainexperience_is_active' => $this->mainexperience_is_active,
                'mainexperience_title' => "%{$this->mainexperience_search}%",
                'mainexperience_description' => "%{$this->mainexperience_search}%",
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
            $sql .= "mainexperience_aid, ";
            $sql .= "mainexperience_is_active, ";
            $sql .= "mainexperience_title, ";
            $sql .= "mainexperience_category, ";
            $sql .= "mainexperience_description, ";
            $sql .= " mainexperience_created,";
            $sql .= " mainexperience_updated ";
            $sql .= "from {$this->tblMainexperience} ";
            $sql .= "where ";
            $sql .= "mainexperience_is_active =:mainexperience_is_active ";
            $sql .= "order by ";
            $sql .= "mainexperience_title asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'mainexperience_is_active' => $this->mainexperience_is_active,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM {$this->tblMainexperience} ";
            $sql .= "WHERE mainexperience_aid = :mainexperience_aid";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'mainexperience_aid' => $this->mainexperience_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }


    public function update()
    {
        try {
            $sql = "update {$this->tblMainexperience} set ";
            $sql .= "mainexperience_title = :mainexperience_title, ";
            $sql .= "mainexperience_category = :mainexperience_category, ";
            $sql .= "mainexperience_description = :mainexperience_description, ";
            $sql .= "mainexperience_updated = :mainexperience_updated ";
            $sql .= "where mainexperience_aid = :mainexperience_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainexperience_title" => $this->mainexperience_title,
                "mainexperience_category" => $this->mainexperience_category,
                "mainexperience_description" => $this->mainexperience_description,
                "mainexperience_updated" => $this->mainexperience_updated,
                "mainexperience_aid" => $this->mainexperience_aid,
            ]);
        } catch (PDOException $ex) {

            $query = false;
        }
        return $query;
    }



    public function active()
    {
        try {
            $sql = "update {$this->tblMainexperience} set ";
            $sql .= "mainexperience_is_active = :mainexperience_is_active, ";
            $sql .= "mainexperience_updated = :mainexperience_updated ";
            $sql .= "where mainexperience_aid = :mainexperience_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainexperience_is_active" => $this->mainexperience_is_active,
                "mainexperience_updated" => $this->mainexperience_updated,
                "mainexperience_aid" => $this->mainexperience_aid,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }






    function checkTitle()
    {
        try {
            $sql = "select ";
            $sql .= "mainexperience_title ";
            $sql .= "from {$this->tblMainexperience} ";
            $sql .= "where ";
            $sql .= "mainexperience_title like :title ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "title" => "{$this->mainexperience_title}",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }
}
