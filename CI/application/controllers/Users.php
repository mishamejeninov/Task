<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Users extends CI_Controller{

  public function _remap($id=null){
      $this->load->model('Users_model');
      $method = strtolower($_SERVER['REQUEST_METHOD']);
      $data = $this->$method($id);
      $u_id = $this->session->userdata('user_id');

      header('Content-Type: application/json; charset=UTF-8');
      echo json_encode($data);
  }

  private function _getData(){
      $jsonStr = file_get_contents('php://input');
      return json_decode($jsonStr, true);
  }

  private function get(){
    if($this->session->userdata('logged_in') && $this->session->userdata('u_role') === 'ADMIN'){
        $u_id = $this->session->userdata('user_id');
        $data = $this->Users_model->getUser();
        return $data = [ 'success' => true , 'users' => $data];
      } else {
        return false;
      }

  }

  private function put($id){
      $jsonArr = $this->_getData();

           $filterdata = [];
           if (isset($jsonArr['u_first'])) {
             $filterdata['u_first'] = $jsonArr['u_first'];
           }
           if (isset($jsonArr['u_last'])) {
             $filterdata['u_last'] = $jsonArr['u_last'];
           }
           if (isset($jsonArr['u_email'])) {
             $filterdata['u_email'] = $jsonArr['u_email'];
           }
           if (isset($jsonArr['u_role'])) {
             $filterdata['u_role'] = $jsonArr['u_role'];
           }
           $this->form_validation->set_data($filterdata);
           $this->form_validation->set_rules('u_first', 'firstname', 'trim|required');
           $this->form_validation->set_rules('u_last', 'lastname', 'trim|required');
           $this->form_validation->set_rules('u_email', 'email', 'trim|required|valid_email');
           $this->form_validation->set_rules('u_role', 'role', 'trim|required');

             if ($this->form_validation->run() == false){
                     return $data = [ 'success' => false ];
             } elseif (is_numeric($id)) {
                   $this->Users_model->put($id, $filterdata);
                   return $data = [ 'success' => true ];
               } else {
                    return $data = [ 'success' => false ];
               }

             }
  private function delete($id){
              
       if (is_numeric($id)) {
         $this->Users_model->delete($id);
             return $data = [ 'success' => true ];
       } else {
             return $data = [ 'success' => false ];
       }
       }
  }
