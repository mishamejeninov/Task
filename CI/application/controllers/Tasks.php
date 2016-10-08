<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller{
    public function _remap($id=null){
        $this->load->model('Tasks_model');
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
        $task = $this->Tasks_model->getUserTasks($u_id);


        return $data = [ 'success' => true , 'task' => $task];
      } else {
        return false;
      }


    }

    private function post(){

        $jsonArr = $this->_getData();
        return $this->Tasks_model->post($jsonArr);
    }

    private function put($id){
        $jsonArr = $this->_getData();

               $filterdata = array(
                 't_subject' => $jsonArr['t_subject']
               );

             if (isset($jsonArr['t_due_data'])) {
               $filterdata['t_due_data'] = $jsonArr['t_due_data'];
             }
             if (isset($jsonArr['t_done'])) {
               $filterdata['t_done'] = $jsonArr['t_done'];
             }

             $this->form_validation->set_data($filterdata);
             $this->form_validation->set_rules('t_subject', 'new task', 'trim|required');
             $this->form_validation->set_rules('t_done', 'checkboox', 'trim|required|in_list[0,1]');

               if ($this->form_validation->run() == false){
                       return $data = [ 'success' => false ];
               } elseif (is_numeric($id)) {
                     $this->Tasks_model->put($id, $filterdata);
                     return $data = [ 'success' => true ];
                 } else {
                      return $data = [ 'success' => false ];
                 }

               }

    private function delete($id){


      if (is_numeric($id)) {
        $this->Tasks_model->delete($id);
            return $data = [ 'success' => true ];
        } else {
             return $data = [ 'success' => false ];
        }

      

    }

}
