<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Label extends CI_Controller{

  public function _remap($id=null){
      $this->load->model('Label_model');
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
    if($this->session->userdata('logged_in')){
      $u_id = $this->session->userdata('user_id');
      $data = $this->Label_model->getlabel();

      return $data = [ 'success' => true , 'label' => $data];
    } else {
      return $data = [ 'success' => false ];
    }
  }

  private function post(){

      $jsonArr = $this->_getData();
      return $this->Label_model->post($jsonArr);
  }

  private function put($id){
      $jsonArr = $this->_getData();

      $filterdata = [];

        if (isset($jsonArr['lb_name'])) {
          $filterdata['lb_name'] = $jsonArr['lb_name'];
        }

        $this->form_validation->set_data($filterdata);
        $this->form_validation->set_rules('lb_name', 'labelName', 'trim|required');

        if ($this->form_validation->run() == false){
                return $data = [ 'success' => false ];
        } elseif (is_numeric($id)) {
              $this->Label_model->put($id, $filterdata);
              return $data = [ 'success' => true ];
          } else {
               return $data = [ 'success' => false ];
          }
  }

  private function delete($id){
            
       if (is_numeric($id)) {
         $this->Label_model->delete($id);
             return $data = [ 'success' => true ];
       } else {
             return $data = [ 'success' => false ];
       }
       }


}
