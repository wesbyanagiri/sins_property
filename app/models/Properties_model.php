<?php
class Properties_model {
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function getPropertiesBy($param, $value)
    {
        if (isset($param) && isset($value)) {
            $this->db->query("SELECT * FROM packages WHERE $param = :$param");
            $this->db->bind($param, $value);
            return $this->db->single();
        }
    }

    public function getProperties()
    {
        $this->db->query("SELECT * FROM properties");
        return $this->db->resultAll();
    }
    
    public function getPropertiesStatus()
    {
        $this->db->query("SELECT * FROM properties WHERE status = 'done'");
        return $this->db->resultAll();
    }
    
    public function getPropertySingle($id)
    {
        $this->db->query("SELECT properties.*, agents.agent_name, owners.owner_name FROM properties INNER JOIN agents ON properties.slug_agent_name = agents.slug_agent_name INNER JOIN owners ON properties.slug_owner_name = owners.slug_owner_name WHERE properties.id = '$id'");
        return $this->db->single();
    }
    

    public function getPropertyId($id)
    {
        $this->db->query('SELECT * FROM properties WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getCountProperties()
    {
        $this->db->query('SELECT COUNT(id) AS count FROM properties');
        return $this->db->resultAll();
    }

    
    //slug the category
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function addProperties($data)
    {
        $name_property = htmlspecialchars($data['name_property']);
        $agent_name = $this->slugify($data['slug_agent_name']);
        $owner_name = $this->slugify($data['slug_owner_name']);
        $type_property = htmlspecialchars($data['type_property']);
        $sertificate = htmlspecialchars($data['sertificate']);
        $prices = htmlspecialchars($data['prices']);
        $descriptions = htmlspecialchars($data['descriptions']);
        $rooms = htmlspecialchars($data['rooms']);
        $pools = htmlspecialchars($data['pools']);
        $address = htmlspecialchars($data['address']);
        
        //to find image location
        $targetDir =  __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR;
        $targetFile = $targetDir . basename($_FILES["images"]["name"]);
        $extension  = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $uploadOk   = 1;

        $check = getimagesize($_FILES["images"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
            echo "Sorry, only JPG, JPEG, and PNG images are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["images"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["images"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        $query = "INSERT INTO properties (name_property, slug_agent_name, slug_owner_name, type_property, sertificate, prices, descriptions, rooms, pools, address, images, status) VALUES (:name_property, :slug_agent_name, :slug_owner_name, :type_property, :sertificate, :prices, :descriptions, :rooms, :pools, :address, :images, :status)";
        $this->db->query($query);
        $this->db->bind("name_property", $name_property);
        $this->db->bind("slug_agent_name", $agent_name);
        $this->db->bind("slug_owner_name", $owner_name);
        $this->db->bind("type_property", $type_property);
        $this->db->bind("sertificate", $sertificate);
        $this->db->bind("prices", $prices);
        $this->db->bind("descriptions", $descriptions);
        $this->db->bind("rooms", $rooms);
        $this->db->bind("pools", $pools);
        $this->db->bind("address", $address);
        $this->db->bind("images", $_FILES['images']['name']);
        $this->db->bind("status", 'req');
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_property_action($id)
    {  
        $name_property = htmlspecialchars($_POST['name_property']);
        $owner_name = $this->slugify($_POST['slug_owner_name']);
        $type_property = htmlspecialchars($_POST['type_property']);
        $sertificate = htmlspecialchars($_POST['sertificate']);
        $prices = htmlspecialchars($_POST['prices']);
        $descriptions = htmlspecialchars($_POST['descriptions']);
        $rooms = htmlspecialchars($_POST['rooms']);
        $pools = htmlspecialchars($_POST['pools']);
        $address = htmlspecialchars($_POST['address']);


        if(isset($_FILES['images']['name']) && $_FILES['images']['error'] <= 0) {
            //to find image location
            $targetDir =  __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR;
            $targetFile = $targetDir . basename($_FILES["images"]["name"]);
            $extension  = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $uploadOk   = 1;

            $check = getimagesize($_FILES["images"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if ($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
                echo "Sorry, only JPG, JPEG, and PNG images are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["images"]["tmp_name"], $targetFile)) {
                    echo "The file " . basename($_FILES["images"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            
            $query = "UPDATE properties SET name_property = :name_property, slug_owner_name = :slug_owner_name, type_property = :type_property, sertificate = :sertificate, prices = :prices, descriptions = :descriptions, rooms = :rooms, pools = :pools, address = :address, images = :images WHERE id = :id";
            $this->db->query($query);
            $this->db->bind("name_property", $name_property);
            $this->db->bind("slug_owner_name", $owner_name);
            $this->db->bind("type_property", $type_property);
            $this->db->bind("sertificate", $sertificate);
            $this->db->bind("prices", $prices);
            $this->db->bind("descriptions", $descriptions);
            $this->db->bind("rooms", $rooms);
            $this->db->bind("pools", $pools);
            $this->db->bind("address", $address);
            $this->db->bind("images", $_FILES['images']['name']);
            $this->db->bind("id", $id);
            $this->db->execute();
            return $this->db->rowCount();
            
        }else {
            
            $query = "UPDATE properties SET name_property = :name_property, slug_owner_name = :slug_owner_name, type_property = :type_property, sertificate = :sertificate, prices = :prices, descriptions = :descriptions, rooms = :rooms, pools = :pools, address = :address WHERE id = :id";
            $this->db->query($query);
            $this->db->bind("name_property", $name_property);
            $this->db->bind("slug_owner_name", $owner_name);
            $this->db->bind("type_property", $type_property);
            $this->db->bind("sertificate", $sertificate);
            $this->db->bind("prices", $prices);
            $this->db->bind("descriptions", $descriptions);
            $this->db->bind("rooms", $rooms);
            $this->db->bind("pools", $pools);
            $this->db->bind("address", $address);
            $this->db->bind("id", $id);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function confirm_action($id)
    {
        $agent_name = $this->slugify($_POST['slug_agent_name']);
        $query = "UPDATE properties SET slug_agent_name = :slug_agent_name, status = 'done' WHERE id = :id";
        $this->db->query($query);
        $this->db->bind("slug_agent_name", $agent_name);
        $this->db->bind("id", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete_property_action($id) {
        $query = "DELETE FROM properties WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}