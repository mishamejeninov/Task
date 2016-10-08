<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{

  function getUser(){

      $this->db->select("*");
  
      return $this->db->get('users')->result();
  }

  function put($id, $data){
    $u_id = $this->session->userdata('user_id');
    $condition = array(
      'u_id' => $id
    );

    $this->db->where($condition);
    return $this->db->update('users', $data);

  }

  function delete($id){
    $u_id = $this->session->userdata('user_id');
    $condition = array(
      'u_id' => $id,

    );

    $this->db->where($condition);

      return $this->db->delete('users');

  }
}
