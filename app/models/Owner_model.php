<?php
class Owner_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    
    public function getOwnerBy($param, $value)
    {
        if (isset($param) && isset($value)) {
            $this->db->query("SELECT * FROM owners WHERE $param = :$param");
            $this->db->bind($param, $value);
            return $this->db->single();
        }
    }

    public function getOwnerId($id)
    {
        $this->db->query('SELECT * FROM owners WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getProperties($slug)
    {
        $this->db->query("SELECT properties.*, owners.slug_owner_name FROM properties INNER JOIN owners ON properties.slug_owner_name = owners.slug_owner_name WHERE properties.slug_owner_name = '$slug'");
        return $this->db->resultAll();
    }

    public function getAllPropertiesDetails($id)
    {
        $this->db->query("SELECT properties.*, agents.slug_agent_name, agents.agent_name, owners.slug_owner_name, owners.owner_name FROM properties INNER JOIN agents ON properties.slug_agent_name = agents.slug_agent_name INNER JOIN owners ON properties.slug_owner_name = owners.slug_owner_name WHERE properties.id = '$id'");
        return $this->db->single();
    }

    public function getOwners()
    {
        $this->db->query('SELECT * FROM owners');
        return $this->db->resultAll();
    }

    public function getCountOwners()
    {
        $this->db->query('SELECT COUNT(id) AS count FROM owners');
        return $this->db->resultAll();
    }
    
    public function getNameOwner()
    {
        $this->db->query("SELECT owner_name FROM owners");
        return $this->db->resultAll();
    }

    public function getOwnerSlug($slug)
    {
        $this->db->query('SELECT * FROM owners WHERE slug_owner_name = :slug_owner_name');
        $this->db->bind('slug_owner_name', $slug);
        return $this->db->single();
    }

    public function login_owner($data)
    {
        $email = $data['email'];
        $password = $data['password'];

        if ($data_owner = $this->getOwnerBy('email', $email)) {
            $password_db = $data_owner['password'];
            if ($password === $password_db || password_verify($password, $password_db)) {
                $_SESSION['id_owner'] = $data_owner['id'];
                $_SESSION['slug_owner_name'] = $data_owner['slug_owner_name'];
                $_SESSION['owner_name'] = $data_owner['owner_name'];
                $_SESSION['login_owner'] = 'login_owner';
                return true;
            }else{
                return false;
            }
        }
    }

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

    public function addNewOwner($data)
    {
        $owner_name = htmlspecialchars($data['owner_name']);
        $slug = $this->slugify($owner_name);
        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);
        $password2 = htmlspecialchars($data['password2']);

        //validate password
        $lowercase =  preg_match('@[a-z]@', $password);
        $number =  preg_match('@[0-9]@', $password);

        if ($data_agent = $this->getOwnerBy("owner_name", $owner_name)) {
            var_dump("Email has been saved");
        }else{
            if (!$lowercase || !$number || strlen($password) < 8) {
                echo
                    '<script>
                            alert("Password should be at least 8 characters in length and should include at least one upper case letter, one number.")
                    </script>';
            } else if ($password != $password2) {
                echo
                '<script>
                        alert("Your password is not same")
                </script>';
            }else {
                $query = "INSERT INTO owners (owner_name, slug_owner_name, email, password) VALUES (:owner_name, :slug_owner_name, :email, :password)";
                $this->db->query($query);
                $this->db->bind("owner_name", $owner_name);
                $this->db->bind("slug_owner_name", $slug);
                $this->db->bind("email", $email);
                $this->db->bind("password", password_hash($password, PASSWORD_DEFAULT));
                $this->db->execute();
                return $this->db->rowCount();
            }
        }
    }

    public function update_owner_action($slug)
    {   
        $owner_name = $_POST['owner_name'];
        //validate password
        $lowercase =  preg_match('@[a-z]@', $_POST['password']);
        $number =  preg_match('@[0-9]@', $_POST['password']);


        if (!$lowercase || !$number || strlen($_POST['password']) < 8) {
            echo '<script>
                    alert("Password should be at least 8 characters in length and should include at least one upper case letter, one number.");
                    setTimeout(function() {
                        window.location.href="dashboard";
                    }, 1000);
                </script>';
        } else {
            if ($_POST['password'] !== $_POST['password2']) {
                echo
                    '<script>
                        alert("Your Password is invalid");
                        setTimeout(function() {
                            window.location.href="dashboard";
                        }, 1000);
                    </script>';
                exit;
            }else {

                $query = "UPDATE owners SET owner_name = :owner_name, slug_owner_name = :slug_owner_name, password = :password WHERE slug_owner_name = :slug_owner_name";
                $this->db->query($query);
                $this->db->bind('owner_name', $owner_name);
                $this->db->bind('slug_owner_name', $slug);
                $this->db->bind('password', password_hash($_POST['password'], PASSWORD_DEFAULT));
                $this->db->execute();
                return $this->db->rowCount();
                
            }
        }
    }

    public function delete_owner_action($slug) 
    {
        $query = "DELETE FROM owners WHERE slug_owner_name = :slug_owner_name";
        $this->db->query($query);
        $this->db->bind('slug_owner_name', $slug);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function logOut()
    {
        session_destroy();
        $_SESSION = [];
        unset($_SESSION);

        header("Location: " . baseurl . '/owner/login');
    }
}