<?php 

class Admin_model 
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function getAdminBy($param, $value)
    {
        if (isset($param) && isset($value)) {
            $this->db->query("SELECT * FROM admins WHERE $param = :$param");
            $this->db->bind($param, $value);
            return $this->db->single();
        }
    }
    
    public function login_admin($data)
    {
        $username = $data['username'];
        $password = $data['password'];

        if ($data_admin = $this->getAdminBy('username', $username)) {
            $password_db = $data_admin['password'];
            if ($password === $password_db || password_verify($password, $password_db)) {
                $_SESSION['id_admin'] = $data_admin['id'];
                $_SESSION['login_admin'] = 'login_admin';
                return true;
            }else{
                return false;
            }
        }
    }

    public function getAdmin()
    {
        $this->db->query('SELECT * FROM admins');
        return $this->db->resultAll();
    }

    public function getAdminId($id)
    {
        $this->db->query('SELECT * FROM admins WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addNewAdmin($data)
    {
        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars($data['password']);
        $password2 = htmlspecialchars($data['password2']);

        //validate password
        $lowercase =  preg_match('@[a-z]@', $password);
        $number =  preg_match('@[0-9]@', $password);

        if ($data_admin = $this->getAdminBy("username", $username)) {
            var_dump("Username has been saved");
            header("Location: " . baseurl . "/admin/dashboard");
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
                $query = "INSERT INTO admins (username, password) VALUES (:username, :password)";
                $this->db->query($query);
                $this->db->bind("username", $username);
                $this->db->bind("password", password_hash($password, PASSWORD_DEFAULT));
                $this->db->execute();
                return $this->db->rowCount();
            }
        }
    }

    public function update_admin_action($id)
    {   
        $username = $_POST['username'];
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
                $query = "UPDATE admins SET username = :username, password = :password WHERE id = :id";
                $this->db->query($query);
                $this->db->bind('username', $username);
                $this->db->bind('password', password_hash($_POST['password'], PASSWORD_DEFAULT));
                $this->db->bind('id', $id);
                $this->db->execute();
                return $this->db->rowCount();
            }
        }
    }

    public function delete_admin_action($id) 
    {
        $query = "DELETE FROM admins WHERE id= :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function logOut()
    {
        session_destroy();
        $_SESSION = [];
        unset($_SESSION);

        header("Location: " . baseurl . '/admin/index');
    }
}