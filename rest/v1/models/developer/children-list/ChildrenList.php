<?php

class ChildrenList
{
    public $children_list_aid;
    public $children_list_is_active;
    public $children_list_first_name;
    public $children_list_last_name;
    public $children_list_birthdate;
    public $children_list_age;
    public $children_list_donation;
    public $children_list_story;
    public $children_list_created;
    public $children_list_updated;

    public $start;
    public $total;
    public $search;

    public $connection;
    public $lastInsertedId;

    public $tblChildrenList;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblChildrenList = 'ftcd_children_list';
    }

    public function create()
    {
        try {
            $sql = "insert into {$this->tblChildrenList}";
            $sql .= "( children_list_is_active,";
            $sql .= " children_list_first_name,";
            $sql .= " children_list_last_name,";
            $sql .= " children_list_birthdate,";
            $sql .= " children_list_donation,";
            $sql .= " children_list_created,";
            $sql .= " children_list_updated ) values ( ";
            $sql .= ":children_list_is_active, ";
            $sql .= ":children_list_first_name, ";
            $sql .= ":children_list_last_name, ";
            $sql .= ":children_list_birthdate, ";
            $sql .= ":children_list_donation, ";
            $sql .= ":children_list_created, ";
            $sql .= ":children_list_updated ) ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "children_list_is_active" => $this->children_list_is_active,
                "children_list_first_name" => $this->children_list_first_name,
                "children_list_last_name" => $this->children_list_last_name,
                "children_list_birthdate" => $this->children_list_birthdate,
                "children_list_donation" => $this->children_list_donation,
                "children_list_created" => $this->children_list_created,
                "children_list_updated" => $this->children_list_updated,
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
            $sql .= "children_list_aid, ";
            $sql .= "children_list_is_active, ";
            $sql .= "children_list_first_name, ";
            $sql .= "children_list_last_name, ";
            $sql .= "children_list_birthdate, ";
            $sql .= "children_list_age, ";
            $sql .= "children_list_donation, ";
            $sql .= "children_list_story, ";


            $sql .= "children_list_created, ";
            $sql .= "children_list_updated ";
            $sql .= "from {$this->tblChildrenList} ";
            $sql .= "order by ";
            $sql .= "children_list_is_active desc, ";
            $sql .= "children_list_last_name asc, ";
            $sql .= "children_list_first_name asc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function readLimit()
    {
        try {
            $sql = "select ";
            $sql .= "children_list_aid, ";
            $sql .= "children_list_is_active, ";
            $sql .= "children_list_first_name, ";
            $sql .= "children_list_last_name, ";
            $sql .= "children_list_birthdate, ";
            $sql .= "children_list_age, ";
            $sql .= "children_list_donation, ";
            $sql .= "children_list_story, ";


            $sql .= "children_list_created, ";
            $sql .= "children_list_updated ";
            $sql .= "from {$this->tblChildrenList} ";
            $sql .= "order by ";
            $sql .= "children_list_is_active desc, ";
            $sql .= "children_list_last_name asc, ";
            $sql .= "children_list_first_name asc ";
            $sql .= "limit :start, ";
            $sql .= ":total ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'start' => $this->start - 1,
                'total' => $this->total
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function search()
    {
        try {
            $sql = "select ";
            $sql .= "children_list_aid, ";
            $sql .= "children_list_is_active, ";
            $sql .= "children_list_first_name, ";
            $sql .= "children_list_last_name, ";
            $sql .= "children_list_birthdate, ";
            $sql .= "children_list_age, ";
            $sql .= "children_list_donation, ";
            $sql .= "children_list_story, ";
            $sql .= "children_list_created, ";
            $sql .= "children_list_updated ";
            $sql .= "from {$this->tblChildrenList} ";
            $sql .= "where ";
            $sql .= "CONCAT (children_list_last_name, ' ', children_list_first_name) like :fullname_lastname_first ";
            $sql .= "or CONCAT (children_list_first_name, ' ', children_list_last_name) like :fullname_firstname_first ";
            $sql .= "or children_list_birthdate like :children_list_birthdate ";
            $sql .= "order by ";
            $sql .= "children_list_is_active desc, ";
            $sql .= "children_list_last_name asc, ";
            $sql .= "children_list_first_name asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'fullname_lastname_first' => "%{$this->search}%",
                'fullname_firstname_first' => "%{$this->search}%",
                'children_list_birthdate' => "%{$this->search}%"
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
            $sql .= "children_list_aid, ";
            $sql .= "children_list_is_active, ";
            $sql .= "children_list_first_name, ";
            $sql .= "children_list_last_name, ";
            $sql .= "children_list_birthdate, ";
            $sql .= "children_list_age, ";
            $sql .= "children_list_donation, ";
            $sql .= "children_list_story, ";
            $sql .= "children_list_created, ";
            $sql .= "children_list_updated ";
            $sql .= "from {$this->tblChildrenList} ";
            $sql .= "where ";
            $sql .= "children_list_is_active = :children_list_is_active ";
            $sql .= "and ( ";
            $sql .= "children_list_last_name like :children_list_last_name ";
            $sql .= "or children_list_birthdate like :children_list_birthdate ";
            $sql .= "or CONCAT(children_list_last_name, ' ', children_list_first_name) like :fullname_lastname_first ";
            $sql .= "or CONCAT(children_list_first_name, ' ', children_list_last_name) like :fullname_firstname_first ";
            $sql .= ") ";
            $sql .= "order by ";
            $sql .= "children_list_is_active desc, ";
            $sql .= "children_list_last_name asc, ";
            $sql .= "children_list_first_name asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'children_list_is_active' => $this->children_list_is_active,
                'children_list_last_name' => "%{$this->search}%",
                'children_list_birthdate' => "%{$this->search}%",
                'fullname_lastname_first' => "%{$this->search}%",
                'fullname_firstname_first' => "%{$this->search}%"
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
    public function filter()
    {
        try {
            $sql = "select ";
            $sql .= "children_list_aid, ";
            $sql .= "children_list_is_active, ";
            $sql .= "children_list_first_name, ";
            $sql .= "children_list_last_name, ";
            $sql .= "children_list_birthdate, ";
            $sql .= "children_list_age, ";
            $sql .= "children_list_donation, ";
            $sql .= "children_list_story, ";


            $sql .= "children_list_created, ";
            $sql .= "children_list_updated ";
            $sql .= "from {$this->tblChildrenList} ";
            $sql .= "where ";
            $sql .= "children_list_is_active =:children_list_is_active ";
            $sql .= "order by ";
            $sql .= "children_list_is_active desc, ";
            $sql .= "children_list_last_name asc, ";
            $sql .= "children_list_first_name asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'children_list_is_active' => $this->children_list_is_active,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM {$this->tblChildrenList} ";
            $sql .= "WHERE children_list_aid = :children_list_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'children_list_aid' => $this->children_list_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblChildrenList} set ";
            $sql .= "children_list_last_name = :children_list_last_name, ";
            $sql .= "children_list_first_name = :children_list_first_name, ";
            $sql .= "children_list_birthdate = :children_list_birthdate, ";
            $sql .= "children_list_age = :children_list_age, ";
            $sql .= "children_list_donation = :children_list_donation, ";
            $sql .= "children_list_story = :children_list_story, ";


            $sql .= "children_list_is_active = :children_list_is_active, ";
            $sql .= "children_list_updated = :children_list_updated ";
            $sql .= "where children_list_aid = :children_list_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "children_list_last_name" => $this->children_list_last_name,
                "children_list_first_name" => $this->children_list_first_name,
                "children_list_birthdate" => $this->children_list_birthdate,
                "children_list_age" => $this->children_list_age,
                "children_list_donation" => $this->children_list_donation,
                "children_list_story" => $this->children_list_story,

                "children_list_is_active" => $this->children_list_is_active,
                "children_list_updated" => $this->children_list_updated,
                "children_list_aid" => $this->children_list_aid,
            ]);
        } catch (PDOException $ex) {

            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblChildrenList} set ";
            $sql .= "children_list_is_active = :children_list_is_active, ";
            $sql .= "children_list_updated = :children_list_updated ";
            $sql .= "where children_list_aid = :children_list_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "children_list_is_active" => $this->children_list_is_active,
                "children_list_updated" => $this->children_list_updated,
                "children_list_aid" => $this->children_list_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    function checkBirthdate()
    {
        try {
            $sql = "select children_list_birthdate ";
            $sql .= "from {$this->tblChildrenList} ";
            $sql .= "where children_list_birthdate = :children_list_birthdate ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "children_list_birthdate" => $this->children_list_birthdate
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }

    function checkName()
    {
        try {
            $sql = "select ";
            $sql .= "children_list_last_name ";
            $sql .= "children_list_first_name ";
            $sql .= "from {$this->tblChildrenList} ";
            $sql .= "where ";
            $sql .= "CONCAT (children_list_first_name, ' ',children_list_last_name) like :fullname ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "fullname" => "{$this->children_list_first_name} {$this->children_list_last_name}",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }
}
