<?php 
class Agent extends Controller 
{
    public function login()
    {
        if(!isset($_POST['login-agent'])) {
            if(isset($_SESSION['login_agent'])){
                header("Location: ". baseurl . "/agent/index");
            }else {
                $data['title'] = 'Login Agent';
                $this->view('agent/login',$data);   
            }
        }else {
            if($this->model("Agent_model")->login_agent($_POST) > 0)
            {
                Flasher::setFlash('success', 'Success Login');
                header("Location: ". baseurl . "/agent/index");
            }else {
                Flasher::setFlash('error', 'Email or Password is wrong');
                header("Location: ". baseurl . "/agent/login");
            }
        }
    }
    
    public function index()
    {
        $data['title'] = 'BliRumah - Agent'; 
        $data['set_active'] = 'agent_logout';
        $data['properties'] = $this->model("Agent_model")->getProperties($_SESSION['slug_agent_name']);
        $data['prices'] = $this->model("Home_model")->get_prices();
        $data['rooms'] = $this->model("Room_model")->getAllRooms();
        
        if(!isset($_SESSION['login_agent'])) {
            header("Location: " . baseurl . "/agent/login");
        }else {
            $this->view('layouts/header', $data);
            $this->view('agent/index', $data);
            $this->view('layouts/footer',$data);
        }
    }

    public function details($id)
    {
        $data['title'] = 'BliRumah - Agent'; 
        $data['set_active'] = 'agent_logout';
        $data['properties'] = $this->model("Agent_model")->getProperties($_SESSION['slug_agent_name']);       
        $data['property_single'] = $this->model("Properties_model")->getPropertySingle($id);
        
        $this->view('layouts/header', $data);
        $this->view('agent/details', $data);
        $this->view('layouts/footer',$data);

    }
          
    public function filter()
    {
        $address = $_GET['address'];
        $getPrices = $_GET['prices'];
        $getRooms  = $_GET['rooms'];
        $getPools  = $_GET['pools'];

        $data['title'] = 'BliRumah'; 
        $data['set_active'] = 'agent_logout';
        $data['prices'] = $this->model("Home_model")->get_prices();
        $data['rooms']  = $this->model("Room_model")->getAllRooms();
        $data['filter'] = $this->model("Agent_model")->filter_properties_action($address, $getPrices, $getRooms, $getPools, $_SESSION['slug_agent_name']);
        
        $this->view('layouts/header', $data);
        $this->view('agent/filter', $data);
        $this->view('layouts/footer',$data);
        
    }
    
    public function setOut()
    {
        $this->model('Agent_model')->logOut();
    }
}