<?php

class DonorList
{
    public $donor_list_aid;
    public $donor_list_is_active;
    public $donor_list_first_name;
    public $donor_list_last_name;
    public $donor_list_email;
    public $donor_list_contact_number;
    public $donor_list_address;
    public $donor_list_city;
    public $donor_list_state_province;
    public $donor_list_country;
    public $donor_list_zip;
    public $donor_list_created;
    public $donor_list_updated;

    public $start;
    public $total;
    public $search;

    public $connection;
    public $lastInsertedId;

    public $tblDonorList;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblDonorList = 'ftcd_donor_list';
    }

    public function create()
    {
        try {
            $sql = "insert into {$this->tblDonorList}";
            $sql .= "( donor_list_is_active,";
            $sql .= " donor_list_first_name,";
            $sql .= " donor_list_last_name,";
            $sql .= " donor_list_email,";
            $sql .= " donor_list_created,";
            $sql .= " donor_list_updated ) values ( ";
            $sql .= ":donor_list_is_active, ";
            $sql .= ":donor_list_first_name, ";
            $sql .= ":donor_list_last_name, ";
            $sql .= ":donor_list_email, ";
            $sql .= ":donor_list_created, ";
            $sql .= ":donor_list_updated ) ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "donor_list_is_active" => $this->donor_list_is_active,
                "donor_list_first_name" => $this->donor_list_first_name,
                "donor_list_last_name" => $this->donor_list_last_name,
                "donor_list_email" => $this->donor_list_email,
                "donor_list_created" => $this->donor_list_created,
                "donor_list_updated" => $this->donor_list_updated,
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
            $sql .= "donor_list_aid, ";
            $sql .= "donor_list_is_active, ";
            $sql .= "donor_list_first_name, ";
            $sql .= "donor_list_last_name, ";
            $sql .= "donor_list_email, ";
            $sql .= "donor_list_contact_number, ";
            $sql .= "donor_list_address, ";
            $sql .= "donor_list_city, ";
            $sql .= "donor_list_state_province, ";
            $sql .= "donor_list_country, ";
            $sql .= "donor_list_zip, ";
            $sql .= "donor_list_created, ";
            $sql .= "donor_list_updated ";
            $sql .= "from {$this->tblDonorList} ";
            $sql .= "order by ";
            $sql .= "donor_list_is_active desc, ";
            $sql .= "donor_list_last_name asc, ";
            $sql .= "donor_list_first_name asc ";
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
            $sql .= "donor_list_aid, ";
            $sql .= "donor_list_is_active, ";
            $sql .= "donor_list_first_name, ";
            $sql .= "donor_list_last_name, ";
            $sql .= "donor_list_email, ";
            $sql .= "donor_list_contact_number, ";
            $sql .= "donor_list_address, ";
            $sql .= "donor_list_city, ";
            $sql .= "donor_list_state_province, ";
            $sql .= "donor_list_country, ";
            $sql .= "donor_list_zip, ";
            $sql .= "donor_list_created, ";
            $sql .= "donor_list_updated ";
            $sql .= "from {$this->tblDonorList} ";
            $sql .= "order by ";
            $sql .= "donor_list_is_active desc, ";
            $sql .= "donor_list_last_name asc, ";
            $sql .= "donor_list_first_name asc ";
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
            $sql .= "donor_list_aid, ";
            $sql .= "donor_list_is_active, ";
            $sql .= "donor_list_first_name, ";
            $sql .= "donor_list_last_name, ";
            $sql .= "donor_list_email, ";
            $sql .= "donor_list_contact_number, ";
            $sql .= "donor_list_address, ";
            $sql .= "donor_list_city, ";
            $sql .= "donor_list_state_province, ";
            $sql .= "donor_list_country, ";
            $sql .= "donor_list_zip, ";
            $sql .= "donor_list_created, ";
            $sql .= "donor_list_updated ";
            $sql .= "from {$this->tblDonorList} ";
            $sql .= "where ";
            $sql .= "donor_list_last_name like :donor_list_last_name ";
            $sql .= "or donor_list_email like :donor_list_email ";
            $sql .= "order by ";
            $sql .= "donor_list_is_active desc, ";
            $sql .= "donor_list_last_name asc, ";
            $sql .= "donor_list_first_name asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'donor_list_last_name' => "%{$this->search}%",
                'donor_list_email' => "%{$this->search}%"
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
            $sql .= "donor_list_aid, ";
            $sql .= "donor_list_is_active, ";
            $sql .= "donor_list_first_name, ";
            $sql .= "donor_list_last_name, ";
            $sql .= "donor_list_email, ";
            $sql .= "donor_list_contact_number, ";
            $sql .= "donor_list_address, ";
            $sql .= "donor_list_city, ";
            $sql .= "donor_list_state_province, ";
            $sql .= "donor_list_country, ";
            $sql .= "donor_list_zip, ";
            $sql .= "donor_list_created, ";
            $sql .= "donor_list_updated ";
            $sql .= "from {$this->tblDonorList} ";
            $sql .= "where ";
            $sql .= "donor_list_is_active = :donor_list_is_active ";
            $sql .= "and ( ";
            $sql .= "donor_list_last_name like :donor_list_last_name ";
            $sql .= "or donor_list_email like :donor_list_email ";
            $sql .= " ) ";
            $sql .= "order by ";
            $sql .= "donor_list_is_active desc, ";
            $sql .= "donor_list_last_name asc, ";
            $sql .= "donor_list_first_name asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                'donor_list_is_active' => $this->donor_list_is_active,
                'donor_list_last_name' => "%{$this->search}%",
                'donor_list_email' => "%{$this->search}%"
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
            $sql .= "donor_list_aid, ";
            $sql .= "donor_list_is_active, ";
            $sql .= "donor_list_first_name, ";
            $sql .= "donor_list_last_name, ";
            $sql .= "donor_list_email, ";
            $sql .= "donor_list_contact_number, ";
            $sql .= "donor_list_address, ";
            $sql .= "donor_list_city, ";
            $sql .= "donor_list_state_province, ";
            $sql .= "donor_list_country, ";
            $sql .= "donor_list_zip, ";
            $sql .= "donor_list_created, ";
            $sql .= "donor_list_updated ";
            $sql .= "from {$this->tblDonorList} ";
            $sql .= "where ";
            $sql .= "donor_list_is_active =:donor_list_is_active ";
            $sql .= "order by ";
            $sql .= "donor_list_is_active desc, ";
            $sql .= "donor_list_last_name asc, ";
            $sql .= "donor_list_first_name asc ";

            $query = $this->connection->prepare($sql);
            $query->execute([
                // est
                // test
                'donor_list_is_active' => $this->donor_list_is_active,

            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM {$this->tblDonorList} ";
            $sql .= "WHERE donor_list_aid = :donor_list_aid";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'donor_list_aid' => $this->donor_list_aid
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblDonorList} set ";
            $sql .= "donor_list_last_name = :donor_list_last_name, ";
            $sql .= "donor_list_first_name = :donor_list_first_name, ";
            $sql .= "donor_list_email = :donor_list_email, "; //
            $sql .= "donor_list_contact_number = :donor_list_contact_number, "; //
            $sql .= "donor_list_address = :donor_list_address, "; //
            $sql .= "donor_list_city = :donor_list_city, "; //
            $sql .= "donor_list_state_province = :donor_list_state_province, "; //
            $sql .= "donor_list_country = :donor_list_country, "; //
            $sql .= "donor_list_zip = :donor_list_zip, "; //
            $sql .= "donor_list_is_active = :donor_list_is_active, ";
            $sql .= "donor_list_updated = :donor_list_updated ";
            $sql .= "where donor_list_aid = :donor_list_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "donor_list_last_name" => $this->donor_list_last_name,
                "donor_list_first_name" => $this->donor_list_first_name,
                "donor_list_email" => $this->donor_list_email, //
                "donor_list_contact_number" => $this->donor_list_contact_number, //
                "donor_list_address" => $this->donor_list_address, //
                "donor_list_city" => $this->donor_list_city, //
                "donor_list_state_province" => $this->donor_list_state_province, //
                "donor_list_country" => $this->donor_list_country, //
                "donor_list_zip" => $this->donor_list_zip, //
                "donor_list_is_active" => $this->donor_list_is_active,
                "donor_list_updated" => $this->donor_list_updated,
                "donor_list_aid" => $this->donor_list_aid,
            ]);
        } catch (PDOException $ex) {

            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblDonorList} set ";
            $sql .= "donor_list_is_active = :donor_list_is_active, ";
            $sql .= "donor_list_updated = :donor_list_updated ";
            $sql .= "where donor_list_aid = :donor_list_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "donor_list_is_active" => $this->donor_list_is_active,
                "donor_list_updated" => $this->donor_list_updated,
                "donor_list_aid" => $this->donor_list_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    function checkEmail()
    {
        try {
            $sql = "select donor_list_email ";
            $sql .= "from {$this->tblDonorList} ";
            $sql .= "where donor_list_email = :donor_list_email ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "donor_list_email" => $this->donor_list_email
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }
}
