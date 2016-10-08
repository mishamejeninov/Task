<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks_model extends CI_Model{
    function getUserTasks($u_id){

      $condition = array(
      'tasks.u_id' => $u_id,
      'tasks.t_archived' => 0
    );
        $this->db->select('
                t_id,
                t_subject,
                t_done,
                lb_name,
                t_due_date
              ');

              $this->db->from('tasks');
              $this->db->join('labels', 'labels.lb_id = tasks.lb_id','left');
              $this->db->where($condition);

              return $this->db->get()->result();
    }

    function post($data){
        $user_id = $this->session->userdata('user_id');
        $data['u_id'] = $user_id;
        $this->db->insert('tasks', $data);
        $insert_id = $this->db->insert_id();

        if (isset($data['lb_id'])) {
        $label_name = $this->_getLabaleName($data);

        return [ "success" => true, 't_id' => $insert_id, 'lb_name' => $label_name[0]->lb_name ];
      } else {

        return [ "success" => true, 't_id' => $insert_id ];
      }
    }

    function _getLabaleName($data){
      $label_id = $data['lb_id'];

      $this->db->select('lb_name');
      $this->db->from('labels');
      $this->db->where('lb_id', $label_id);

      return $this->db->get()->result();
    }

    function put($id, $data){
      $u_id = $this->session->userdata('user_id');
      $condition = array(
        'u_id' => $u_id,
        't_id' => $id
      );

      $this->db->where($condition);
      return $this->db->update('tasks', $data);

    }

    function delete($id){
      $u_id = $this->session->userdata('user_id');
      $condition = array(
        'u_id' => $u_id,
        't_id' => $id
      );

      $this->db->where($condition);
      $t_archived = array('t_archived' => 1);
        return $this->db->update('tasks', $t_archived);

    }
}
