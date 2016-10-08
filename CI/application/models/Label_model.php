<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Label_model extends CI_Model{

  function getLabel(){
    $u_id = $this->session->userdata('user_id');
      $condition = array(
        'u_id' => $u_id,

      );
      $this->db->where($condition);
      $this->db->select("*");

      return $this->db->get('labels')->result();

   }
  function post($data){
          $user_id = $this->session->userdata('user_id');
          $data['u_id'] = $user_id;
          $this->db->insert('labels' , $data);
          $insert_id = $this->db->insert_id();

          return  $insert_id;

      }

  function put($id, $data){

          $u_id = $this->session->userdata('user_id');
          $condition = array(
            'lb_id' => $id
          );
          $this->db->where($condition);
          return $this->db->update('labels', $data);
      }

      function delete($id){
        $u_id = $this->session->userdata('user_id');
        $condition = array(
          'lb_id' => $id

        );
        $this->db->where($condition);

          return $this->db->delete('labels');
      }


}
