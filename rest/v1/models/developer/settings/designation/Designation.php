<?php

class Designation
{
    // DATABASE COLUMN
    public $designation_aid;
    public $designation_is_active;
    public $designation_name;
    public $designation_category_id;
    public $designation_created;
    public $designation_updated;

    // DATABASE CONNECTION
    public $connection;
    public $lastInsertedId;

    //DATABASE TABLE
    public $tblDesignation;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblDesignation = 'ftcd_settings_designation';
    }

    // insert into ftcd_settings_designation
    //        ( designation_is_active,
    //         designation_name,
    //         designation_category_id,
    //         designation_created,
    //         designation_updated ) values (
    //        1,
    //        "Kamote",
    //        "Kamote ka",
    //        "2025-1-1",
    //        "2025-1-1" )

    // CREATE 
    public function create()
    {
        try {
            $sql = "insert into {$this->tblDesignation} ";
            $sql .= "( designation_is_active, ";
            $sql .= " designation_name, ";
            $sql .= " designation_category_id, ";
            $sql .= " designation_created, ";
            $sql .= " designation_updated ) values ( ";
            $sql .= ":designation_is_active, ";
            $sql .= ":designation_name, ";
            $sql .= ":designation_category_id, ";
            $sql .= ":designation_created, ";
            $sql .= ":designation_updated ) ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "designation_is_active" => $this->designation_is_active,
                "designation_name" => $this->designation_name,
                "designation_category_id" => $this->designation_category_id,
                "designation_created" => $this->designation_created,
                "designation_updated" => $this->designation_updated,
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
            $sql .= "from {$this->tblDesignation} ";
            $sql .= "order by ";
            $sql .= "designation_is_active desc, ";
            $sql .= "designation_name asc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblDesignation} set ";
            $sql .= "designation_name = :designation_name, ";
            $sql .= "designation_category_id = :designation_category_id, ";
            $sql .= "designation_updated = :designation_updated ";
            $sql .= "where designation_aid = :designation_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "designation_name" => $this->designation_name,
                "designation_category_id" => $this->designation_category_id,
                "designation_updated" => $this->designation_updated,
                "designation_aid" => $this->designation_aid,
            ]);
        } catch (PDOException $ex) {
     
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblDesignation} set ";
            $sql .= "designation_is_active = :designation_is_active, ";
            $sql .= "designation_updated = :designation_updated ";
            $sql .= "where designation_aid = :designation_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "designation_is_active" => $this->designation_is_active,
                "designation_updated" => $this->designation_updated,
                "designation_aid" => $this->designation_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblDesignation} ";
            $sql .= "where designation_aid = :designation_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'designation_aid' => $this->designation_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }


    function checkName()
    {
        try {
            $sql = "select designation_name ";
            $sql .= "from {$this->tblDesignation} ";
            $sql .= "where designation_name = :designation_name ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "designation_name" => $this->designation_name
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }
}
