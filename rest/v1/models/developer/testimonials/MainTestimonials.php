<?php

class Maintestimonials
{
    public $maintestimonials_aid;
    public $maintestimonials_is_active;
  
    public $maintestimonials_first_name;
    public $maintestimonials_last_name;
    public $maintestimonials_email;
    public $maintestimonials_description;
    public $maintestimonials_created;
    public $maintestimonials_updated;

    public $start;
    public $total;
    public $search;

    public $connection;
    public $lastInsertedId;

    public $tblMaintestimonials;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblMaintestimonials = 'db_main_testimonials';
    }

    public function create()
    {
        try {
            // Validate required fields
            if (empty($this->maintestimonials_first_name) || 
                empty($this->maintestimonials_last_name) || 
                empty($this->maintestimonials_email) || 
                empty($this->maintestimonials_description)) {
                return false;
            }

            // Validate email format
            if (!filter_var($this->maintestimonials_email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }

            $sql = "INSERT INTO {$this->tblMaintestimonials} (
                maintestimonials_is_active,
                maintestimonials_first_name,
                maintestimonials_last_name,
                maintestimonials_email,
                maintestimonials_description,
                maintestimonials_created,
                maintestimonials_updated
            ) VALUES (
                :maintestimonials_is_active,
                :maintestimonials_first_name,
                :maintestimonials_last_name,
                :maintestimonials_email,
                :maintestimonials_description,
                :maintestimonials_created,
                :maintestimonials_updated
            )";

            $query = $this->connection->prepare($sql);
            $query->execute([
                "maintestimonials_is_active" => $this->maintestimonials_is_active,
                "maintestimonials_first_name" => $this->maintestimonials_first_name,
                "maintestimonials_last_name" => $this->maintestimonials_last_name,
                "maintestimonials_email" => $this->maintestimonials_email,
                "maintestimonials_description" => $this->maintestimonials_description,
                "maintestimonials_created" => $this->maintestimonials_created,
                "maintestimonials_updated" => $this->maintestimonials_updated,
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
                    maintestimonials_aid, 
                    maintestimonials_is_active, 
                    maintestimonials_first_name,
                    maintestimonials_last_name,
                    maintestimonials_email,
                    maintestimonials_description, 
                    maintestimonials_created, 
                    maintestimonials_updated 
                FROM {$this->tblMaintestimonials} 
                ORDER BY maintestimonials_is_active DESC";

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
                        maintestimonials_aid, 
                        maintestimonials_is_active, 
                        maintestimonials_first_name,
                        maintestimonials_last_name,
                        maintestimonials_email,
                        maintestimonials_description, 
                        maintestimonials_created, 
                        maintestimonials_updated 
                    FROM {$this->tblMaintestimonials} 
                    ORDER BY maintestimonials_is_active DESC 
                    LIMIT :start, :total";

            $query = $this->connection->prepare($sql);
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
            $sql = "SELECT 
                    maintestimonials_aid, 
                    maintestimonials_is_active, 
                    maintestimonials_first_name,
                    maintestimonials_last_name,
                    maintestimonials_email,
                    maintestimonials_description, 
                    maintestimonials_created, 
                    maintestimonials_updated 
                FROM {$this->tblMaintestimonials}
                WHERE maintestimonials_description LIKE :search
                ORDER BY maintestimonials_is_active DESC";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'search' => "%{$this->search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM {$this->tblMaintestimonials} 
                    WHERE maintestimonials_aid = :maintestimonials_aid";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'maintestimonials_aid' => $this->maintestimonials_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }

    public function update()
    {
        try {
            $sql = "UPDATE {$this->tblMaintestimonials} SET 
                        maintestimonials_first_name = :maintestimonials_first_name, 
                        maintestimonials_last_name = :maintestimonials_last_name, 
                        maintestimonials_email = :maintestimonials_email, 
                        maintestimonials_description = :maintestimonials_description, 
                        maintestimonials_updated = :maintestimonials_updated 
                    WHERE maintestimonials_aid = :maintestimonials_aid";

            $query = $this->connection->prepare($sql);
            $query->execute([
                "maintestimonials_first_name" => $this->maintestimonials_first_name,
                "maintestimonials_last_name" => $this->maintestimonials_last_name,
                "maintestimonials_email" => $this->maintestimonials_email,
                "maintestimonials_description" => $this->maintestimonials_description,
                "maintestimonials_updated" => $this->maintestimonials_updated,
                "maintestimonials_aid" => $this->maintestimonials_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "UPDATE {$this->tblMaintestimonials} SET 
                        maintestimonials_is_active = :maintestimonials_is_active, 
                        maintestimonials_updated = :maintestimonials_updated 
                    WHERE maintestimonials_aid = :maintestimonials_aid";

            $query = $this->connection->prepare($sql);
            $query->execute([
                "maintestimonials_is_active" => $this->maintestimonials_is_active,
                "maintestimonials_updated" => $this->maintestimonials_updated,
                "maintestimonials_aid" => $this->maintestimonials_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function checkExists()
    {
        try {
            $sql = "SELECT maintestimonials_aid 
                    FROM {$this->tblMaintestimonials}
                    WHERE maintestimonials_first_name = :maintestimonials_first_name
                    AND maintestimonials_last_name = :maintestimonials_last_name
                    AND maintestimonials_email = :maintestimonials_email";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'maintestimonials_first_name' => $this->maintestimonials_first_name,
                'maintestimonials_last_name' => $this->maintestimonials_last_name,
                'maintestimonials_email' => $this->maintestimonials_email
            ]);

            return $query->rowCount() > 0;
        } catch (PDOException $ex) {
            return false;
        }
    }
}
