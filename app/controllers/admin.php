<?php class Admin extends Controller
{
    public function index()
    {
        if(!isset($_POST['login-admin'])) {
            if(isset($_SESSION['login_admin'])){
                header("Location: ". baseurl . "/admin/dashboard");
            }else {
                $data['title'] = 'Login Admin';
                $this->view('admin/index',$data);   
            }
        }else {
            if($this->model("Admin_model")->login_admin($_POST) > 0)
            {
                Flasher::setFlash('success', 'Success Login');
                header("Location: ". baseurl . "/admin/dashboard");
            }else {
                Flasher::setFlash('error', 'Username or Password is wrong');
                header("Location: ". baseurl . "/admin/index");
            }
        }
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard Admin'; 
        $data['set_active'] = 'dashboard'; 
        $data['admin_single'] = $this->model("Admin_model")->getAdminId($_SESSION['id_admin']);
        $data['admins'] = $this->model("Admin_model")->getAdmin();
        $data['agents'] = $this->model("Agent_model")->getAgents();
        $data['owners'] = $this->model("Owner_model")->getOwners();
        $data['total_properties'] = $this->model("Properties_model")->getCountProperties();
        $data['total_agents'] = $this->model("Agent_model")->getCountAgents();
        $data['total_owners'] = $this->model("Owner_model")->getCountOwners();
        
        if(!isset($_SESSION['login_admin'])){
            header("Location: " . baseurl . "/admin/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('admin/dashboard', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }
    
    public function add_admin()
    {
        if($this->model('Admin_model')->addNewAdmin($_POST) > 0)
        {
            Flasher::setFlash('success', 'Success Add Admin');
            header("Location: " . baseurl . "/admin/dashboard");
        }else {
            Flasher::setFlash('error', 'Fail Add Data Admin');
            header("Location: " . baseurl . "/admin/dashboard");
        }
    }

    public function update_admin()
    {
        $data['title'] = 'Dashboard Admin'; 
        $data['set_active'] = 'dashboard'; 
        $data['admin_single'] = $this->model("Admin_model")->getAdminId($_SESSION['id_admin']);
        $data['admin'] = $this->model("Admin_model")->getAdmin();
        
        if(!isset($_SESSION['login_admin'])){
            header("Location: " . baseurl . "/admin/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('admin/update-admin', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }

    public function delete_admin($id)
    {
        if ($this->model('Admin_model')->delete_admin_action($id) > 0) {
            Flasher::setFlash('success', 'Success Delete Data Admin');
            header("Location: " . baseurl . "/admin/dashboard");
        } else {
            Flasher::setFlash('error', 'Fail Delete Data Owner');
            header("Location: " . baseurl . "/admin/dashboard");
        }
    }

    public function update_admin_action($id)
    {
        if($this->model('Admin_model')->update_admin_action($id) > 0)
        {
            Flasher::setFlash('success', 'Success Update Admin');
            header("Location: " . baseurl . "/admin/dashboard");
        }else {
            Flasher::setFlash('error', 'Fail Update Data Admin');
            header("Location: " . baseurl . "/admin/dashboard");
        }
    }

    public function properties()
    {
        $data['title'] = 'Dashboard Properties';
        $data['set_active'] = 'properties'; 
        $data['admin_single'] = $this->model("Admin_model")->getAdminId($_SESSION['id_admin']);
        $data['properties'] = $this->model("Properties_model")->getProperties();
        
        if(!isset($_SESSION['login_admin'])){
            header("Location: " . baseurl . "/admin/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('admin/properties', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }

    public function properties_confirm($id)
    {
        $data['title'] = 'Dashboard Properties';
        $data['set_active'] = 'properties'; 
        $data['admin_single'] = $this->model("Admin_model")->getAdminId($_SESSION['id_admin']);
        $data['properties'] = $this->model("Properties_model")->getPropertyId($id);
        $data['name_agents'] = $this->model("Agent_model")->getNameAgent();
        
        if(!isset($_SESSION['login_admin'])){
            header("Location: " . baseurl . "/admin/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('admin/properties-confirm', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }

    public function properties_details($id)
    {
        $data['title'] = 'Dashboard Properties';
        $data['set_active'] = 'properties'; 
        $data['admin_single'] = $this->model("Admin_model")->getAdminId($_SESSION['id_admin']);
        $data['properties_details'] = $this->model("Properties_model")->getPropertySingle($id);
        $data['name_agents'] = $this->model("Agent_model")->getNameAgent();
        
        if(!isset($_SESSION['login_admin'])){
            header("Location: " . baseurl . "/admin/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('admin/properties-details', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }

    public function confirm($id)
    {
        if ($this->model('Properties_model')->confirm_action($id) > 0) {
            Flasher::setFlash('success', 'Success Update Status Properties');
            header("Location: " . baseurl . "/admin/properties");
        } else {
            Flasher::setFlash('error', 'Fail Update Status Properties');
            header("Location: " . baseurl . "/admin/properties");
        }
    }
    
    // !! Section Agent
    public function owner()
    {
        $data['title'] = 'Owner - Admin'; 
        $data['set_active'] = 'owner'; 
        $data['admin_single'] = $this->model("Admin_model")->getAdminId($_SESSION['id_admin']);
        $data['owners'] = $this->model("Owner_model")->getOwners();
        
        if(!isset($_SESSION['login_admin'])){
            header("Location: " . baseurl . "/admin/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('admin/owner', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }
    
    public function add_agent()
    {
        if($this->model('Agent_model')->addNewAgents($_POST) > 0)
        {
            Flasher::setFlash('success', 'Success Add Agent');
            header("Location: " . baseurl . "/admin/dashboard");
        }else {
            Flasher::setFlash('error', 'Fail Add Data Agent');
            header("Location: " . baseurl . "/admin/dashboard");
        }
    }

    public function update_agent($slug)
    {
        $data['title'] = 'Dashboard Admin'; 
        $data['set_active'] = 'dashboard'; 
        $data['admin_single'] = $this->model("Admin_model")->getAdminId($_SESSION['id_admin']);
        $data['agent_single'] = $this->model("Agent_model")->getAgentSlug($slug);
        $data['admin'] = $this->model("Admin_model")->getAdmin();
        
        if(!isset($_SESSION['login_admin'])){
            header("Location: " . baseurl . "/admin/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('admin/update-agent', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }

    public function update_agent_action($slug)
    {
        if ($this->model('Agent_model')->updateAgent($slug) > 0) {
            Flasher::setFlash('success', 'Success Update Data Agent');
            header("Location: " . baseurl . "/admin/dashboard");
        } else {
            Flasher::setFlash('error', 'Password not valid');
            header("Location: " . baseurl . "/admin/dashboard");
        }
    }

    public function delete_agent($slug)
    {
        if ($this->model('Agent_model')->delete_agent_action($slug) > 0) {
            Flasher::setFlash('success', 'Success Delete Data Admin');
            header("Location: " . baseurl . "/admin/dashboard");
        } else {
            Flasher::setFlash('error', 'Fail Delete Data Admin');
            header("Location: " . baseurl . "/admin/dashboard");
        }
    }

    // !! Section Owner
    public function add_owner()
    {
        if($this->model('Owner_model')->addNewOwner($_POST) > 0)
        {
            Flasher::setFlash('success', 'Success Add Owner');
            header("Location: " . baseurl . "/admin/owner");
        }else {
            Flasher::setFlash('error', 'Fail Add Data Owner');
            header("Location: " . baseurl . "/admin/owner");
        }
    }

    public function update_owner($slug)
    {
        $data['title'] = 'Dashboard Admin'; 
        $data['set_active'] = 'dashboard'; 
        $data['admin_single'] = $this->model("Admin_model")->getAdminId($_SESSION['id_admin']);
        $data['owner_single'] = $this->model("Owner_model")->getOwnerSlug($slug);
        $data['admin'] = $this->model("Admin_model")->getAdmin();
        
        if(!isset($_SESSION['login_admin'])){
            header("Location: " . baseurl . "/admin/index");
        }else {
            $this->view('layouts/header-admin', $data);
            $this->view('admin/update-owner', $data);
            $this->view('layouts/footer-admin',$data);
        }
    }

    public function update_owner_controller($slug)
    {
        if ($this->model('Owner_model')->update_owner_action($slug) > 0) {
            Flasher::setFlash('success', 'Success Update Data Agent');
            header("Location: " . baseurl . "/admin/owner");
        } else {
            Flasher::setFlash('error', 'Password not valid');
            header("Location: " . baseurl . "/admin/owner");
        }
    }

    public function delete_owner($slug)
    {
        if ($this->model('Owner_model')->delete_owner_action($slug) > 0) {
            Flasher::setFlash('success', 'Success Delete Data Owner');
            header("Location: " . baseurl . "/admin/owner");
        } else {
            Flasher::setFlash('error', 'Fail Delete Data Owner');
            header("Location: " . baseurl . "/admin/owner");
        }
    }

    public function setOut()
    {
        $this->model('Admin_model')->logOut();
    }
}