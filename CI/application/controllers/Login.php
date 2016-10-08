<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  public function _remap($id=null){
      $this->load->model('login_model');
      $method = strtolower($_SERVER['REQUEST_METHOD']);
      $data = $this->$method($id);

      header('Content-Type: application/json; charset=UTF-8');
      echo json_encode($data);
  }



  private function _getData(){
      $jsonStr = file_get_contents('php://input');
      return json_decode($jsonStr, true);
  }
  private function post(){
      $jsonArr = $this->_getData();

      $this->load->helper('date');
      $today = ['u_last_login_date'=>date('Y-m-d H:i:s')];
      $this->login_model->last_login_data($today);

      if ($this->login_model->post($jsonArr)) {
        return $data = [ "success" => true ];
      } else {
        return $data = [ "success" => false ];
      }
  }

   private function get(){

     $this->session->unset_userdata('logged_in');
  	 return [ "success" => true ];
    }
  }
