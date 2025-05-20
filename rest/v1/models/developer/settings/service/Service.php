<?php

class Service
{


    public $service_aid;
    public $service_is_active;
    public $service_title;
    public $service_description;
    public $service_created;
    public $service_updated;



    public $start;
    public $total;
    public $search;

    public $connection;
    public $lastInsertedId;

    public $tblService;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblService = 'db_service';
    }

    public function create()
    {
        try {
            $sql = "INSERT INTO {$this->tblService} (
                service_is_active,
                service_title,
                service_description,
                service_created,
                service_updated
            ) VALUES (
                :service_is_active,
                :service_title,
                :service_description,
                :service_created,
                :service_updated
            )";

            $query = $this->connection->prepare($sql);
            $query->execute([
                "service_is_active" => $this->service_is_active,
                "service_title" => $this->service_title,
                "service_description" => $this->service_description,
                "service_created" => $this->service_created,
                "service_updated" => $this->service_updated,
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
                    service_aid, 
                    service_is_active, 
                    service_title, 
                    service_description, 
                    service_created, 
                    service_updated 
                FROM {$this->tblService} 
                ORDER BY 
                    service_is_active DESC, 
                    service_title ASC, 
                    service_description ASC";

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
                        service_aid, 
                        service_is_active, 
                        service_title, 
                        service_description, 
                        service_created, 
                        service_updated 
                    FROM {$this->tblService} 
                    ORDER BY 
                        service_is_active DESC, 
                        service_title ASC 
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
            $sql .= "service_aid, ";
            $sql .= "service_is_active, ";
            $sql .= "service_title, ";
            $sql .= "service_description, ";
            $sql .= " service_created,";
            $sql .= " service_updated ";
            $sql .= "from {$this->tblService} ";
            $sql .= "where ";
            $sql .= "service_title like :service_title ";
            $sql .= "or service_description like :service_description ";
            $sql .= "order by ";
            $sql .= "service_is_active desc, ";
            $sql .= "service_title asc ";


            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'service_title' => "%{$this->search}%",
                'service_description' => "%{$this->search}%",

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
            $sql .= "service_aid, ";
            $sql .= "service_is_active, ";
            $sql .= "service_title, ";
            $sql .= "service_description, ";
            $sql .= "service_created, ";
            $sql .= "service_updated ";
            $sql .= "from {$this->tblService} ";
            $sql .= "where ";
            $sql .= "service_is_active = :service_is_active ";
            $sql .= "and ( ";
            $sql .= "service_title like :service_title ";
            $sql .= "or service_description like :service_description ";
            $sql .= ") ";
            $sql .= "order by ";
            $sql .= "service_is_active desc, ";
            $sql .= "service_title asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'service_is_active' => $this->service_is_active,
                'service_title' => "%{$this->search}%",
                'service_description' => "%{$this->search}%",
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
            $sql .= "service_aid, ";
            $sql .= "service_is_active, ";
            $sql .= "service_title, ";
            $sql .= "service_description, ";
            $sql .= " service_created,";
            $sql .= " service_updated ";
            $sql .= "from {$this->tblService} ";
            $sql .= "where ";
            $sql .= "service_is_active =:service_is_active ";
            $sql .= "order by ";
            $sql .= "service_title asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'service_is_active' => $this->service_is_active,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM {$this->tblService} ";
            $sql .= "WHERE service_aid = :service_aid";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'service_aid' => $this->service_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }


    public function update()
    {
        try {
            $sql = "update {$this->tblService} set ";
            $sql .= "service_title = :service_title, ";
            $sql .= "service_description = :service_description, ";
            $sql .= "service_updated = :service_updated ";
            $sql .= "where service_aid = :service_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "service_title" => $this->service_title,
                "service_description" => $this->service_description,
                "service_updated" => $this->service_updated,
                "service_aid" => $this->service_aid,
            ]);
        } catch (PDOException $ex) {

            $query = false;
        }
        return $query;
    }



    public function active()
    {
        try {
            $sql = "update {$this->tblService} set ";
            $sql .= "service_is_active = :service_is_active, ";
            $sql .= "service_updated = :service_updated ";
            $sql .= "where service_aid = :service_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "service_is_active" => $this->service_is_active,
                "service_updated" => $this->service_updated,
                "service_aid" => $this->service_aid,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function checkTitle()
    {
        $query = "SELECT * FROM " . $this->tblService . " 
              WHERE service_title = :service_title";

        // Only exclude self in update mode
        if (!empty($this->service_aid)) {
            $query .= " AND service_aid != :service_aid";
        }

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":service_title", $this->service_title);

        if (!empty($this->service_aid)) {
            $stmt->bindParam(":service_aid", $this->service_aid);
        }

        $stmt->execute();
        return $stmt;
    }
}
