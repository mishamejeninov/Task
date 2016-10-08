<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

 // function __construct()
 // {
 //   parent::__construct();
 //  //  $this->load->model('login_model','',TRUE);
 // }

 function index()
 {
   //This method will have the credentials validation
  //  $this->load->library('form_validation');

  //  $this->form_validation->set_rules('u_email', 'Email', 'trim|required|xss_clean');
  //  $this->form_validation->set_rules('u_pass', 'Password', 'trim|required|xss_clean');

  //  if($this->form_validation->run() == FALSE)
  //  {
  //    //Field validation failed.
  //   //  echo json_encode([ "success" => false ]);
  //  }
  //  else
  //  {
   //
  //   //  echo "true";
  //  }

 }

 // function check_database($password)
 // {
 //   //Field validation succeeded.  Validate against database
 //  $jsonArr = $this->users->_getData();
 //   $email = $jsonArr['u_email'];
 //
 //   //query the database
 //   $result = $this->users->login($email, $password);
 //
 //   if($result)
 //   {
 //     $sess_array = array();
 //     foreach($result as $row)
 //     {
 //       $sess_array = array(
 //         'u_id' => $row->id,
 //         'u_email' => $row->email
 //       );
 //       $this->session->set_userdata('logged_in', $sess_array);
 //     }
 //     return TRUE;
 //   }
 //   else
 //   {
 //     return false;
 //   }
 // }
}
