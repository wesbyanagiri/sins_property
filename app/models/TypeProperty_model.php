<?php
class TypeProperty_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllType()
    {
        $this->db->query('SELECT * FROM type_property');
        return $this->db->resultAll();
    }

}