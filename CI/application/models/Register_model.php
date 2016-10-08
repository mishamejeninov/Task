<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model{
    function get_all(){
        $res = $this->db->get('users');
        return $res->result();
    }

    function get_by_id($id){
        $this->db->where('u_id', $id);
        $res = $this->db->get('users');
        return $res->first_row();
    }

    function checkUniqueEmail($email){
        $this->db->where('u_email', $email);
        $res = $this->db->get('users');

        return $res->result();
    }

    function registration($data){

       $this->db->insert('users', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
          return [ 'success' => true ];
        }else {
        return false;
        }
    }

    function put($id, $data){
        $this->db->where('u_id', $id);
        return $this->db->update('users', $data);

    }

    function delete($id){
        $this->db->where('u_id', $id);
        return $this->db->delete('users');

    }
}
