<?php
class Agent_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAgentBy($param, $value)
    {
        if (isset($param) && isset($value)) {
            $this->db->query("SELECT * FROM agents WHERE $param = :$param");
            $this->db->bind($param, $value);
            return $this->db->single();
        }
    }

    public function getNameAgent()
    {
        $this->db->query("SELECT agent_name, slug_agent_name FROM agents");
        return $this->db->resultAll();
    }
    
    public function getCountAgents()
    {
        $this->db->query('SELECT COUNT(id) AS count FROM agents');
        return $this->db->resultAll();
    }

    public function getAgents()
    {
        $this->db->query('SELECT * FROM agents');
        return $this->db->resultAll();
    }

    public function getAgentSlug($slug)
    {
        $this->db->query('SELECT * FROM agents WHERE slug_agent_name = :slug_agent_name');
        $this->db->bind('slug_agent_name', $slug);
        return $this->db->single();
    }
    
    public function getProperties($slug)
    {
        $this->db->query("SELECT properties.*, agents.slug_agent_name FROM properties INNER JOIN agents ON properties.slug_agent_name = agents.slug_agent_name WHERE properties.slug_agent_name = '$slug' HAVING status = 'done'");
        return $this->db->resultAll();
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

    public function filter_properties_action($address, $prices, $rooms, $pools, $slug)
    {   
        if(!empty($prices) && !empty($prices) && !empty($rooms) && !empty($pools)) {
            if ($rooms == '5+') {
                $this->db->query("SELECT properties.*, agents.slug_agent_name FROM properties INNER JOIN agents ON properties.slug_agent_name = agents.slug_agent_name WHERE prices <= :prices OR rooms >= :rooms OR pools = :pools HAVING properties.slug_agent_name = '$slug' OR status = 'done' AND address LIKE '%$address%'");
                $this->db->bind('prices', $prices);
                $this->db->bind('rooms', 5);
                $this->db->bind('pools', $pools);
            }
            else {
                $this->db->query("SELECT properties.*, agents.slug_agent_name FROM properties INNER JOIN agents ON properties.slug_agent_name = agents.slug_agent_name WHERE prices <= :prices OR rooms = :rooms OR pools = :pools HAVING properties.slug_agent_name = '$slug' AND status = 'done' AND address LIKE '%$address%'");
                $this->db->bind('prices', $prices);
                $this->db->bind('rooms', $rooms);
                $this->db->bind('pools', $pools);
            }
            return $this->db->resultAll();
        }else {
            header("Location: " . baseurl . "/agent");
        }
    }

    public function login_agent($data)
    {
        $email = $data['email'];
        $password = $data['password'];

        if ($data_agent = $this->getAgentBy('email', $email)) {
            $password_db = $data_agent['password'];
            if ($password === $password_db || password_verify($password, $password_db)) {
                $_SESSION['id_agent'] = $data_agent['id'];
                $_SESSION['slug_agent_name'] = $data_agent['slug_agent_name'];
                $_SESSION['login_agent'] = 'login_agent';
                return true;
            }else{
                return false;
            }
        }
    }

    public function addNewAgents($data)
    {
        $agent_name = htmlspecialchars($data['agent_name']);
        $slug = $this->slugify($agent_name);
        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);
        $password2 = htmlspecialchars($data['password2']);

        //validate password
        $lowercase =  preg_match('@[a-z]@', $password);
        $number =  preg_match('@[0-9]@', $password);

        if ($data_agent = $this->getAgentBy("agent_name", $agent_name)) {
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
                $query = "INSERT INTO agents (agent_name, slug_agent_name, email, password) VALUES (:agent_name, :slug_agent_name, :email, :password)";
                $this->db->query($query);
                $this->db->bind("agent_name", $agent_name);
                $this->db->bind("slug_agent_name", $slug);
                $this->db->bind("email", $email);
                $this->db->bind("password", password_hash($password, PASSWORD_DEFAULT));
                $this->db->execute();
                return $this->db->rowCount();
            }
        }
    }

    public function updateAgent($slug)
    {   
        $agent_name = $_POST['agent_name'];
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
                $query = "UPDATE agents SET agent_name = :agent_name, slug_agent_name = :slug_agent_name, password = :password WHERE slug_agent_name = :slug_agent_name";
                $this->db->query($query);
                $this->db->bind('agent_name', $agent_name);
                $this->db->bind('slug_agent_name', $slug);
                $this->db->bind('password', password_hash($_POST['password'], PASSWORD_DEFAULT));
                $this->db->execute();
                return $this->db->rowCount();
            }
        }
    }

    public function delete_agent_action($slug) 
    {
        $query = "DELETE FROM agents WHERE slug_agent_name = :slug_agent_name";
        $this->db->query($query);
        $this->db->bind('slug_agent_name', $slug);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function logOut()
    {
        session_destroy();
        $_SESSION = [];
        unset($_SESSION);

        header("Location: " . baseurl . '/agent/login');
    }
}