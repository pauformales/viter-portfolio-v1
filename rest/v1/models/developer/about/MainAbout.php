<?php

class Mainabout
{


    public $mainabout_aid;
    public $mainabout_is_active;
    public $mainabout_title;
    public $mainabout_description;
    public $mainabout_created;
    public $mainabout_updated;



    public $start;
    public $total;
    public $search;

    public $connection;
    public $lastInsertedId;

    public $tblMainabout;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblMainabout = 'db_main_about';
    }

    public function create()
    {
        try {
            $sql = "INSERT INTO {$this->tblMainabout} (
                mainabout_is_active,
                mainabout_title,
                mainabout_description,
                mainabout_created,
                mainabout_updated
            ) VALUES (
                :mainabout_is_active,
                :mainabout_title,
                :mainabout_description,
                :mainabout_created,
                :mainabout_updated
            )";

            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainabout_is_active" => $this->mainabout_is_active,
                "mainabout_title" => $this->mainabout_title,
                "mainabout_description" => $this->mainabout_description,
                "mainabout_created" => $this->mainabout_created,
                "mainabout_updated" => $this->mainabout_updated,
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
                    mainabout_aid, 
                    mainabout_is_active, 
                    mainabout_title, 
                    mainabout_description, 
                    mainabout_created, 
                    mainabout_updated 
                FROM {$this->tblMainabout} 
                ORDER BY 
                    mainabout_is_active DESC, 
                    mainabout_title ASC, 
                    mainabout_description ASC";

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
                        mainabout_aid, 
                        mainabout_is_active, 
                        mainabout_title, 
                        mainabout_description, 
                        mainabout_created, 
                        mainabout_updated 
                    FROM {$this->tblMainabout} 
                    ORDER BY 
                        mainabout_is_active DESC, 
                        mainabout_title ASC 
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
            $sql .= "mainabout_aid, ";
            $sql .= "mainabout_is_active, ";
            $sql .= "mainabout_title, ";
            $sql .= "mainabout_description, ";
            $sql .= " mainabout_created,";
            $sql .= " mainabout_updated ";
            $sql .= "from {$this->tblMainabout} ";
            $sql .= "where ";
            $sql .= "mainabout_title like :mainabout_title ";
            $sql .= "order by ";
            $sql .= "mainabout_is_active desc, ";
            $sql .= "mainabout_title asc ";


            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'mainabout_title' => "%{$this->search}%",

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
            $sql .= "mainabout_aid, ";
            $sql .= "mainabout_is_active, ";
            $sql .= "mainabout_title, ";
            $sql .= "mainabout_description, ";
            $sql .= " mainabout_created,";
            $sql .= " mainabout_updated ";
            $sql .= "from {$this->tblMainabout} ";
            $sql .= "where ";
            $sql .= "mainabout_is_active = :mainabout_is_active ";
            $sql .= "and ( ";
            $sql .= "mainabout_title like :mainabout_title ";
            $sql .= " ) ";
            $sql .= "order by ";
            $sql .= "mainabout_is_active desc, ";
            $sql .= "mainabout_title asc, ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'mainabout_is_active' => $this->mainabout_is_active,
                'mainabout_title' => "%{$this->search}%",

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
            $sql .= "mainabout_aid, ";
            $sql .= "mainabout_is_active, ";
            $sql .= "mainabout_title, ";
            $sql .= "mainabout_description, ";
            $sql .= " mainabout_created,";
            $sql .= " mainabout_updated ";
            $sql .= "from {$this->tblMainabout} ";
            $sql .= "where ";
            $sql .= "mainabout_is_active =:mainabout_is_active ";
            $sql .= "order by ";
            $sql .= "mainabout_title asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'mainabout_is_active' => $this->mainabout_is_active,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM {$this->tblMainabout} ";
            $sql .= "WHERE mainabout_aid = :mainabout_aid";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'mainabout_aid' => $this->mainabout_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }


    public function update()
    {
        try {
            $sql = "update {$this->tblMainabout} set ";
            $sql .= "mainabout_title = :mainabout_title, ";
            $sql .= "mainabout_description = :mainabout_description, ";
            $sql .= "mainabout_updated = :mainabout_updated ";
            $sql .= "where mainabout_aid = :mainabout_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainabout_title" => $this->mainabout_title,
                "mainabout_description" => $this->mainabout_description,
                "mainabout_updated" => $this->mainabout_updated,
                "mainabout_aid" => $this->mainabout_aid,
            ]);
        } catch (PDOException $ex) {

            $query = false;
        }
        return $query;
    }



    public function active()
    {
        try {
            $sql = "update {$this->tblMainabout} set ";
            $sql .= "mainabout_is_active = :mainabout_is_active, ";
            $sql .= "mainabout_updated = :mainabout_updated ";
            $sql .= "where mainabout_aid = :mainabout_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainabout_is_active" => $this->mainabout_is_active,
                "mainabout_updated" => $this->mainabout_updated,
                "mainabout_aid" => $this->mainabout_aid,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function checkTitle()
    {
        try {
            $sql = "SELECT mainabout_aid 
                FROM {$this->tblMainabout}
                WHERE mainabout_title = :mainabout_title";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'mainabout_title' => $this->mainabout_title
            ]);

            return $query->rowCount() > 0;
        } catch (PDOException $ex) {
            return false;
        }
    }
}
