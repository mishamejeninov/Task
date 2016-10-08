<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

    function post($data){
      $email = $data['u_email'];
      $password = $data['u_pass'];
      $this->db->where('u_email', $email);
      $this->db->select('u_id, u_email, u_pass, u_role, u_first, u_last');
      $this->db->from('users');

      $query = $this->db->get();


      if($query->num_rows() == 1){
        $user_data = $query->result();
        $existingHashFromDb = $user_data[0]->u_pass;
        $isPasswordCorrect = password_verify($password, $existingHashFromDb);

      if ($isPasswordCorrect) {
          //set the session
          $newdata = array(
            'username'  => $user_data[0]->u_first . ' ' . $user_data[0]->u_last,
            'u_role'   => $user_data[0]->u_role,
            'user_id'  => $user_data[0]->u_id,
            'email'     => $user_data[0]->u_email,
            'logged_in' => TRUE
          );

          $this->session->set_userdata($newdata);

          return true;

       } else {

          return false;
       }

       } else {

          return false;
       }
    }


    function last_login_data($today){
      $user_id = $this->session->userdata('user_id');
      $this->db->where('u_id', $user_id);
      $this->db->update('users' , $today);
    }

    function checkUniqueEmail($email){
      $this->db->where('u_email', $email);
      $res = $this->db->get('users');

      return $res->result();
    }

    function registration($data){
      return $this->db->insert('users', $data);
    }
}
