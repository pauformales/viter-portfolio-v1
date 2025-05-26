<?php

class MainRecentwork
{


    public $mainrecentwork_aid;
    public $mainrecentwork_is_active;
    public $mainrecentwork_title;
    public $mainrecentwork_description;
    public $mainrecentwork_created;
    public $mainrecentwork_updated;



    public $start;
    public $total;
    public $search;

    public $connection;
    public $lastInsertedId;

    public $tblMainrecentwork;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblMainrecentwork = 'db_main_recentwork';
    }

    public function create()
    {
        try {
            $sql = "INSERT INTO {$this->tblMainrecentwork} (
                mainrecentwork_is_active,
                mainrecentwork_title,
                mainrecentwork_description,
                mainrecentwork_created,
                mainrecentwork_updated
            ) VALUES (
                :mainrecentwork_is_active,
                :mainrecentwork_title,
                :mainrecentwork_description,
                :mainrecentwork_created,
                :mainrecentwork_updated
            )";

            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainrecentwork_is_active" => $this->mainrecentwork_is_active,
                "mainrecentwork_title" => $this->mainrecentwork_title,
                "mainrecentwork_description" => $this->mainrecentwork_description,
                "mainrecentwork_created" => $this->mainrecentwork_created,
                "mainrecentwork_updated" => $this->mainrecentwork_updated,
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
                    mainrecentwork_aid, 
                    mainrecentwork_is_active, 
                    mainrecentwork_title, 
                    mainrecentwork_description, 
                    mainrecentwork_created, 
                    mainrecentwork_updated 
                FROM {$this->tblMainrecentwork} 
                ORDER BY 
                    mainrecentwork_is_active DESC, 
                    mainrecentwork_title ASC, 
                    mainrecentwork_description ASC";

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
                        mainrecentwork_aid, 
                        mainrecentwork_is_active, 
                        mainrecentwork_title, 
                        mainrecentwork_description, 
                        mainrecentwork_created, 
                        mainrecentwork_updated 
                    FROM {$this->tblMainrecentwork} 
                    ORDER BY 
                        mainrecentwork_is_active DESC, 
                        mainrecentwork_title ASC 
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
            $sql .= "mainrecentwork_aid, ";
            $sql .= "mainrecentwork_is_active, ";
            $sql .= "mainrecentwork_title, ";
            $sql .= "mainrecentwork_description, ";
            $sql .= " mainrecentwork_created,";
            $sql .= " mainrecentwork_updated ";
            $sql .= "from {$this->tblMainrecentwork} ";
            $sql .= "where ";
            $sql .= "mainrecentwork_title like :mainrecentwork_title ";
            $sql .= "order by ";
            $sql .= "mainrecentwork_is_active desc, ";
            $sql .= "mainrecentwork_title asc ";


            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'mainrecentwork_title' => "%{$this->search}%",

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
            $sql .= "mainrecentwork_aid, ";
            $sql .= "mainrecentwork_is_active, ";
            $sql .= "mainrecentwork_title, ";
            $sql .= "mainrecentwork_description, ";
            $sql .= " mainrecentwork_created,";
            $sql .= " mainrecentwork_updated ";
            $sql .= "from {$this->tblMainrecentwork} ";
            $sql .= "where ";
            $sql .= "mainrecentwork_is_active = :mainrecentwork_is_active ";
            $sql .= "and ( ";
            $sql .= "mainrecentwork_title like :mainrecentwork_title ";
            $sql .= " ) ";
            $sql .= "order by ";
            $sql .= "mainrecentwork_is_active desc, ";
            $sql .= "mainrecentwork_title asc, ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'mainrecentwork_is_active' => $this->mainrecentwork_is_active,
                'mainrecentwork_title' => "%{$this->search}%",

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
            $sql .= "mainrecentwork_aid, ";
            $sql .= "mainrecentwork_is_active, ";
            $sql .= "mainrecentwork_title, ";
            $sql .= "mainrecentwork_description, ";
            $sql .= " mainrecentwork_created,";
            $sql .= " mainrecentwork_updated ";
            $sql .= "from {$this->tblMainrecentwork} ";
            $sql .= "where ";
            $sql .= "mainrecentwork_is_active =:mainrecentwork_is_active ";
            $sql .= "order by ";
            $sql .= "mainrecentwork_title asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'mainrecentwork_is_active' => $this->mainrecentwork_is_active,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM {$this->tblMainrecentwork} ";
            $sql .= "WHERE mainrecentwork_aid = :mainrecentwork_aid";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'mainrecentwork_aid' => $this->mainrecentwork_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }


    public function update()
    {
        try {
            $sql = "update {$this->tblMainrecentwork} set ";
            $sql .= "mainrecentwork_title = :mainrecentwork_title, ";
            $sql .= "mainrecentwork_description = :mainrecentwork_description, ";
            $sql .= "mainrecentwork_updated = :mainrecentwork_updated ";
            $sql .= "where mainrecentwork_aid = :mainrecentwork_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainrecentwork_title" => $this->mainrecentwork_title,
                "mainrecentwork_description" => $this->mainrecentwork_description,
                "mainrecentwork_updated" => $this->mainrecentwork_updated,
                "mainrecentwork_aid" => $this->mainrecentwork_aid,
            ]);
        } catch (PDOException $ex) {

            $query = false;
        }
        return $query;
    }



    public function active()
    {
        try {
            $sql = "update {$this->tblMainrecentwork} set ";
            $sql .= "mainrecentwork_is_active = :mainrecentwork_is_active, ";
            $sql .= "mainrecentwork_updated = :mainrecentwork_updated ";
            $sql .= "where mainrecentwork_aid = :mainrecentwork_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "mainrecentwork_is_active" => $this->mainrecentwork_is_active,
                "mainrecentwork_updated" => $this->mainrecentwork_updated,
                "mainrecentwork_aid" => $this->mainrecentwork_aid,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function checkTitle()
    {
        try {
            $sql = "SELECT mainrecentwork_aid 
                FROM {$this->tblMainrecentwork}
                WHERE mainrecentwork_title = :mainrecentwork_title";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'mainrecentwork_title' => $this->mainrecentwork_title
            ]);

            return $query->rowCount() > 0;
        } catch (PDOException $ex) {
            return false;
        }
    }
}
