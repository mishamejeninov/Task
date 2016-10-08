<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{
    public function _remap($id=null){
        $this->load->model('Register_model');
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

        $firstName = $jsonArr['u_first'];
        $lastName = $jsonArr['u_last'];
        $gender = $jsonArr['u_gender'];
        $email = $jsonArr['u_email'];
        $password = $jsonArr['u_pass'];


        if (!empty($firstName) && !empty($lastName) && !empty($gender) && !empty($email) && !empty($password)) {

          $hashToStoreInDb = password_hash($password, PASSWORD_BCRYPT);
          $jsonArr['u_pass'] = $hashToStoreInDb;

          $validEmail = $this->Register_model->checkUniqueEmail($email);
          if (!$validEmail) {
            return $data = $this->Register_model->registration($jsonArr);

            $newdata = array(
                   'username'  => $firstName.$lastName,
                   'email'     => $email,
                   'gender'    => $gender,
                   'logged_in' => false
               );

            $this->session->set_userdata($newdata);

          } else {

            return  $data = [ 'success' => false ];
          }
        }

    }



}
