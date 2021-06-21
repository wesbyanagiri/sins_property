<?php 
class Home extends Controller 
{
    public function index()
    {
        $data['title'] = 'SINS Property'; 
        $data['set_active'] = 'index';
        $data['properties'] = $this->model("Properties_model")->getPropertiesStatus();
        $data['prices'] = $this->model("Home_model")->get_prices();
        $data['rooms'] = $this->model("Room_model")->getAllRooms();
        
        $this->view('layouts/header', $data);
        $this->view('home/index', $data);
        $this->view('layouts/footer',$data);
        
    }
    
    public function details($id)
    {
        $data['title'] = 'Details - SINS Property'; 
        $data['set_active'] = 'properties';
        $data['properties'] = $this->model("Properties_model")->getPropertiesStatus();
        $data['property_single'] = $this->model("Properties_model")->getPropertySingle($id);
        
        $this->view('layouts/header', $data);
        $this->view('home/details', $data);
        $this->view('layouts/footer',$data);

    }  
      
    public function filter()
    {
        $address = $_GET['address'];
        $getPrices = $_GET['prices'];
        $getRooms  = $_GET['rooms'];
        $getPools  = $_GET['pools'];

        $data['title'] = 'SINS Property'; 
        $data['set_active'] = 'index';
        $data['prices'] = $this->model("Home_model")->get_prices();
        $data['rooms']  = $this->model("Room_model")->getAllRooms();
        $data['filter'] = $this->model("Home_model")->filter_properties_action($address, $getPrices, $getRooms, $getPools);
        
        $this->view('layouts/header', $data);
        $this->view('home/filter', $data);
        $this->view('layouts/footer',$data);
        
    }
}