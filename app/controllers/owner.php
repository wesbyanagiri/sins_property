<?php 
class Owner extends Controller 
{
    public function index()
    {
        if(!isset($_POST['login-owner'])) {
            if(isset($_SESSION['login_owner'])){
                header("Location: ". baseurl . "/owner/dashboard");
            }else {
                $data['title'] = 'Login Owner';
                $this->view('owner/index',$data);   
            }
        }else {
            if($this->model("Owner_model")->login_owner($_POST) > 0)
            {
                Flasher::setFlash('success', 'Success Login');
                header("Location: ". baseurl . "/owner/dashboard");
            }else {
                Flasher::setFlash('error', 'Email or Password is wrong');
                header("Location: ". baseurl . "/owner/index");
            }
        }
    }
    
    public function dashboard()
    {
        $data['title'] = 'Dashboard Properties';
        $data['set_active'] = 'properties'; 
        $data['owner_single'] = $this->model("Owner_model")->getOwnerId($_SESSION['id_owner']);
        $data['properties'] = $this->model("Owner_model")->getProperties($_SESSION['slug_owner_name']);
        $data['total_rooms'] = $this->model("Room_model")->getRooms();
        $data['type_property'] = $this->model("TypeProperty_model")->getAllType();
        
        if(!isset($_SESSION['login_owner'])){
            header("Location: " . baseurl . "/owner/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('owner/dashboard', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }
    
    // !! Section Properties   
    public function add_properties_action()
    {
        if ($this->model('Properties_model')->addProperties($_POST) > 0) {
            Flasher::setFlash('success', 'Success Add properties');
            header("Location: " . baseurl . "/owner/dashboard");
        } else {
            Flasher::setFlash('error', 'Fail Add Properties');
            header("Location: " . baseurl . "/owner/dashboard");
        }
    }
    
    public function properties_update($id)
    {
        $data['title'] = 'Dashboard Properties Update';
        $data['set_active'] = 'properties'; 
        $data['owner_single'] = $this->model("Owner_model")->getOwnerId($_SESSION['id_owner']);
        $data['property_single'] = $this->model("Properties_model")->getPropertyId($id);
        $data['total_rooms'] = $this->model("Room_model")->getRooms();
        $data['type_property'] = $this->model("TypeProperty_model")->getAllType();
        
        if(!isset($_SESSION['login_owner'])) {
            header("Location: " . baseurl . "/owner/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('owner/properties-update', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }

    public function update_properties_action($id)
    {
        if ($this->model('Properties_model')->update_property_action($id) > 0) {
            Flasher::setFlash('success', 'Success Update Data Properties');
            header("Location: " . baseurl . "/owner/properties");
        } else {
            Flasher::setFlash('error', 'Fail Update Data Properties');
            header("Location: " . baseurl . "/owner/properties");
        }
    }

    public function delete_property_action($id)
    {
        if ($this->model('Properties_model')->delete_property_action($id) > 0) {
            Flasher::setFlash('success', 'Success Delete Data Property');
            header("Location: " . baseurl . "/owner/dashboard");
        } else {
            Flasher::setFlash('error', 'Fail Delete Data Property');
            header("Location: " . baseurl . "/owner/dashboard");
        }
    }

    // !!Section Properties Details
    public function properties_details($id)
    {
        $data['title'] = 'Dashboard Properties Details';
        $data['owner_single'] = $this->model("Owner_model")->getOwnerId($_SESSION['id_owner']);
        $data['properties_details'] = $this->model("Owner_model")->getAllPropertiesDetails($id);
        
        if(!isset($_SESSION['login_owner'])) {
            header("Location: " . baseurl . "/owner/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('owner/properties-details', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }
    
    public function setOut()
    {
        $this->model('Owner_model')->logOut();
    }
}