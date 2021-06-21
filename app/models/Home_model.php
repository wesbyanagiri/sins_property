<?php 

class Home_model 
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function get_prices()
    {
        $query = "SELECT * FROM prices";
        $this->db->query($query);
        return $this->db->resultAll();
    }
    
    public function filter_properties_action($address, $prices, $rooms, $pools)
    {   
        if(!empty($address) && !empty($prices) && !empty($rooms) && !empty($pools)) {
            if ($rooms == '5+') {
                $this->db->query("SELECT * FROM properties WHERE prices <= :prices OR rooms >= :rooms OR pools = :pools HAVING status = 'done' AND address LIKE '%$address%'");
                $this->db->bind('prices', $prices);
                $this->db->bind('rooms', 5);
                $this->db->bind('pools', $pools);
            }
            else {
                $this->db->query("SELECT * FROM properties WHERE prices <= :prices OR rooms = :rooms OR pools = :pools HAVING status = 'done' AND address LIKE '%$address%'");
                $this->db->bind('prices', $prices);
                $this->db->bind('rooms', $rooms);
                $this->db->bind('pools', $pools);
            }
            return $this->db->resultAll();
        }else {
            var_dump('kaga mau sat');
            header("Location: " . baseurl . "/home");
        }
    }
}