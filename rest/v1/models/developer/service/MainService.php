<?php

class MainService
{


    public $mainservice_aid;
    public $mainservice_is_active;
    public $mainservice_title;
    public $mainservice_category;
    public $mainservice_description;
    public $mainservice_created;
    public $mainservice_updated;

    public $service_aid;
    public $service_is_active;
    public $service_title;
    public $service_description;
    public $service_created;
    public $service_updated;



    public $mainservice_start;
    public $mainservice_total;
    public $mainservice_search;

    
    public $service_start;
    public $service_total;
    public $service_search;

    public $connection;
    public $lastInsertedId;

    public $tblMainservice;
    public $tblService;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblMainservice = 'pf_main_service';
        $this->tblService = 'pf_service';
    }

    public function create()
    {
        try {
            $sql = "INSERT INTO {$this->tblMainservice} (
                mainservice_is_active,
                mainservice_title,
                mainservice_category,
                mainservice_description,
                mainservice_created,
                mainservice_updated
            ) VALUES (
                :mainservice_is_active,
                :mainservice_title,
                :mainservice_category,
                :mainservice_description,
                :mainservice_created,
                :mainservice_updated
            )";

            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainservice_is_active" => $this->mainservice_is_active,
                "mainservice_title" => $this->mainservice_title,
                "mainservice_category" => $this->mainservice_category,
                "mainservice_description" => $this->mainservice_description,
                "mainservice_created" => $this->mainservice_created,
                "mainservice_updated" => $this->mainservice_updated,
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
                    mainservice_aid, 
                    mainservice_is_active, 
                    mainservice_title, 
                    mainservice_category, 
                    mainservice_description, 
                    mainservice_created, 
                    mainservice_updated 
                FROM {$this->tblMainservice} 
                ORDER BY 
                    mainservice_is_active DESC, 
                    mainservice_title ASC, 
                    mainservice_description ASC";

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
                        mainservice_aid, 
                        mainservice_is_active, 
                        mainservice_title, 
                        mainservice_category, 
                        mainservice_description, 
                        mainservice_created, 
                        mainservice_updated 
                    FROM {$this->tblMainservice} 
                    ORDER BY 
                        mainservice_is_active DESC, 
                        mainservice_title ASC 
                    LIMIT :start, :total";

            $query = $this->connection->prepare($sql);

            // PDO requires integers to be explicitly bound for LIMIT
            $query->bindValue(':start', (int)($this->mainservice_start - 1), PDO::PARAM_INT);
            $query->bindValue(':total', (int)$this->mainservice_total, PDO::PARAM_INT);

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
            $sql .= "mainservice_aid, ";
            $sql .= "mainservice_is_active, ";
            $sql .= "mainservice_title, ";
            $sql .= "mainservice_category, ";
            $sql .= "mainservice_description, ";
            $sql .= " mainservice_created,";
            $sql .= " mainservice_updated ";
            $sql .= "from {$this->tblMainservice} ";
            $sql .= "where ";
            $sql .= "mainservice_title like :mainservice_title ";
            $sql .= "or mainservice_description like :mainservice_description ";
            $sql .= "order by ";
            $sql .= "mainservice_is_active desc, ";
            $sql .= "mainservice_title asc ";


            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'mainservice_title' => "%{$this->mainservice_search}%",
                'mainservice_description' => "%{$this->mainservice_search}%"

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
            $sql .= "mainservice_aid, ";
            $sql .= "mainservice_is_active, ";
            $sql .= "mainservice_title, ";
            $sql .= "mainservice_category, ";
            $sql .= "mainservice_description, ";
            $sql .= "mainservice_created, ";
            $sql .= "mainservice_updated ";
            $sql .= "from {$this->tblMainservice} ";
            $sql .= "where ";
            $sql .= "mainservice_is_active = :mainservice_is_active ";
            $sql .= "and ( ";
            $sql .= "mainservice_title like :mainservice_title ";
            $sql .= "or mainservice_description like :mainservice_description ";
            $sql .= ") ";
            $sql .= "order by ";
            $sql .= "mainservice_is_active desc, ";
            $sql .= "mainservice_title asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'mainservice_is_active' => $this->mainservice_is_active,
                'mainservice_title' => "%{$this->mainservice_search}%",
                'mainservice_description' => "%{$this->mainservice_search}%",
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
            $sql .= "mainservice_aid, ";
            $sql .= "mainservice_is_active, ";
            $sql .= "mainservice_title, ";
            $sql .= "mainservice_category, ";
            $sql .= "mainservice_description, ";
            $sql .= " mainservice_created,";
            $sql .= " mainservice_updated ";
            $sql .= "from {$this->tblMainservice} ";
            $sql .= "where ";
            $sql .= "mainservice_is_active =:mainservice_is_active ";
            $sql .= "order by ";
            $sql .= "mainservice_title asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'mainservice_is_active' => $this->mainservice_is_active,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM {$this->tblMainservice} ";
            $sql .= "WHERE mainservice_aid = :mainservice_aid";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'mainservice_aid' => $this->mainservice_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }


    public function update()
    {
        try {
            $sql = "update {$this->tblMainservice} set ";
            $sql .= "mainservice_title = :mainservice_title, ";
            $sql .= "mainservice_category = :mainservice_category, ";
            $sql .= "mainservice_description = :mainservice_description, ";
            $sql .= "mainservice_updated = :mainservice_updated ";
            $sql .= "where mainservice_aid = :mainservice_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainservice_title" => $this->mainservice_title,
                "mainservice_category" => $this->mainservice_category,
                "mainservice_description" => $this->mainservice_description,
                "mainservice_updated" => $this->mainservice_updated,
                "mainservice_aid" => $this->mainservice_aid,
            ]);
        } catch (PDOException $ex) {

            $query = false;
        }
        return $query;
    }



    public function active()
    {
        try {
            $sql = "update {$this->tblMainservice} set ";
            $sql .= "mainservice_is_active = :mainservice_is_active, ";
            $sql .= "mainservice_updated = :mainservice_updated ";
            $sql .= "where mainservice_aid = :mainservice_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainservice_is_active" => $this->mainservice_is_active,
                "mainservice_updated" => $this->mainservice_updated,
                "mainservice_aid" => $this->mainservice_aid,

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
            $sql .= "mainservice_title ";
            $sql .= "from {$this->tblMainservice} ";
            $sql .= "where ";
            $sql .= "mainservice_title like :title ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "title" => "{$this->mainservice_title}",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }
}
