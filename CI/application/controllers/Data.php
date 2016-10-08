<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller{
    public function _remap($id=null){

        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $data = $this->$method($id);
        $u_id = $this->session->userdata('user_id');

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($data);
    }

    private function get(){
      if($this->session->userdata('logged_in')){
        $username = $this->session->userdata('username');
      
        if ($this->session->userdata('u_role') === 'ADMIN') {
          return $data = [ 'success' => true , 'role' => true , 'name' => $username];
         } else {
            return $data = ['name' => $username];
          }

      } else {
        return false;
      }
    }
}
