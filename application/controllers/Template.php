<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller {

    public function get($templateName){
        $this->load->view($templateName); 
    }
	
	public function set(){
        echo 'Ку-ку'; 
    }
	
}