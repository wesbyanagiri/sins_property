<?php 
class Room_model 
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllRooms()
    {
        $this->db->query("SELECT * FROM rooms WHERE total_rooms >= 1 OR total_rooms >= 5 LIMIT 5");
        return $this->db->resultAll();
    }
    
    public function getRooms()
    {
        $this->db->query("SELECT * FROM rooms");
        return $this->db->resultAll();
    }
}