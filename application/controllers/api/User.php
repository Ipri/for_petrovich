<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->load->helper('cookie');
        $this->load->library('session'); 
    }

    public function profile($queryType = 'get'){
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST)){
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
		
		if(!isset($_POST['email'])){
			echo 'Ку-ку'; exit;
		}
                
        $userInfoStr = read_file("./application/models/users/".$_POST['email']);
        $userInfoArr = explode(',', $userInfoStr);
		
		switch ($queryType) {
                   
            case 'edit':
			
                $userInfoArr[1] = $_POST['newName'];
                $userNewInfoStr = implode(',', $userInfoArr);
                write_file("./application/models/users/".$_POST['newEmail'], $userNewInfoStr);
                
                if($_POST['email'] !== $_POST['newEmail']){
                    unlink("./application/models/users/".$_POST['email']);
                }
                
                $this->sendResponse(true, ['name' => $_POST['newName'], 'email' => $_POST['newEmail']]);
            break;
			
            case 'get':
				$this->sendResponse(true, ['name' => $userInfoArr[1], 'email' => $_POST['newEmail']]);
			break;	
            default:
                echo 'Ку-ку'; exit;
            break;
        }  
    }
    
    public function logout(){
        $this->session->sess_destroy();
        $this->sendResponse(true, null);
        
    }
    
    private function sendResponse($flag, $data){
        
       $dataName =  $flag ? 'data' : 'error';
       
       echo json_encode([
           "success" => $flag,
           $dataName => $data
       ]); 
    }
    
    public function is_authorized(){
        $this->config->set_item('sess_expiration', '18000');
        $response_flag = isset($_SESSION['authorized']) ? true : false;
        $response_data = $response_flag ? 
                            [
                                "authorized" => $_SESSION['authorized'],
                                "name" => $_SESSION['name'],
                                "email" => $_SESSION['email']
                            ]
                            : 'user not found';
        
        $this->sendResponse($response_flag, $response_data);
    }
    
    public function login(){
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST)){
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
        
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember');
        
        $response_flag = false;
        $response_data = 'user not found';
        
        $userInfoStr = read_file("./application/models/users/$email");
        $userInfoArr = explode(',', $userInfoStr);
        
        if(isset($userInfoStr) && $userInfoArr[0] === $password) {
            
            $expiration = null;    
            $response_flag = true;
            $response_data = [
                'authorized' => true,
                'email' => $email,
                'name' => $userInfoArr[1]
            ];

            if($remember){
                $expiration = 2592000;
            } else {
                $expiration = 18000;
            }

            $cookie = $this->input->cookie('ci_session'); 
            $this->input->set_cookie('ci_session', $cookie, $expiration); 

            $_SESSION['authorized'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $userInfoArr[1];

        } 
        
        $this->sendResponse($response_flag, $response_data);
    }
}