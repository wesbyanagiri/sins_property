<?php
class PropertiesDetails_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPropertiesDetails($id)
    {
        $this->db->query("SELECT properties.*, agents.agent_name, owners.owner_name FROM properties INNER JOIN agents ON properties.slug_agent_name = agents.slug_agent_name INNER JOIN owners ON properties.slug_owner_name = owners.slug_owner_name WHERE properties.id = '$id'");
        return $this->db->single();
    }
}