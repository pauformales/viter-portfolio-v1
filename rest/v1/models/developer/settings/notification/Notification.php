<?php

class Notification
{
    // DATABASE COLUMN
    public $notification_aid;
    public $notification_is_active;
    public $notification_name;
    public $notification_email;
    public $notification_purpose;
    public $notification_created;
    public $notification_updated;

    // DATABASE CONNECTION
    public $connection;
    public $lastInsertedId;

    //DATABASE TABLE
    public $tblNotification;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblNotification = 'ftcd_settings_notification';
    }

    // insert into ftcd_settings_notification
    //        ( notification_is_active,
    //         notification_name,
    //         notification_purpose,
    //         notification_created,
    //         notification_updated ) values (
    //        1,
    //        "Kamote",
    //        "Kamote ka",
    //        "2025-1-1",
    //        "2025-1-1" )

    // CREATE 
    public function create()
    {
        try {
            $sql = "insert into {$this->tblNotification} ";
            $sql .= "( notification_is_active, ";
            $sql .= " notification_name, ";
            $sql .= " notification_email, ";
            $sql .= " notification_purpose, ";
            $sql .= " notification_created, ";
            $sql .= " notification_updated ) values ( ";
            $sql .= ":notification_is_active, ";
            $sql .= ":notification_name, ";
            $sql .= ":notification_email, ";
            $sql .= ":notification_purpose, ";
            $sql .= ":notification_created, ";
            $sql .= ":notification_updated ) ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "notification_is_active" => $this->notification_is_active,
                "notification_name" => $this->notification_name,
                "notification_email" => $this->notification_email,
                "notification_purpose" => $this->notification_purpose,
                "notification_created" => $this->notification_created,
                "notification_updated" => $this->notification_updated,
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
            $sql .= "from {$this->tblNotification} ";
            $sql .= "order by ";
            $sql .= "notification_is_active desc, ";
            $sql .= "notification_name asc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblNotification} set ";
            $sql .= "notification_name = :notification_name, ";
            $sql .= "notification_purpose = :notification_purpose, ";
            $sql .= "notification_updated = :notification_updated ";
            $sql .= "where notification_aid = :notification_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "notification_name" => $this->notification_name,
                "notification_purpose" => $this->notification_purpose,
                "notification_updated" => $this->notification_updated,
                "notification_aid" => $this->notification_aid,
            ]);
        } catch (PDOException $ex) {
        
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblNotification} set ";
            $sql .= "notification_is_active = :notification_is_active, ";
            $sql .= "notification_updated = :notification_updated ";
            $sql .= "where notification_aid = :notification_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "notification_is_active" => $this->notification_is_active,
                "notification_updated" => $this->notification_updated,
                "notification_aid" => $this->notification_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblNotification} ";
            $sql .= "where notification_aid = :notification_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'notification_aid' => $this->notification_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }


    function checkName()
    {
        try {
            $sql = "select notification_name ";
            $sql .= "from {$this->tblNotification} ";
            $sql .= "where notification_name = :notification_name ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "notification_name" => $this->notification_name
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }
}
