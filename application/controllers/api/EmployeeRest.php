<?php

require APPPATH.'libraries/REST_Controller.php';

class EmployeeRest extends REST_Controller {

public function index_post() {
  $first_name = $this->input->post('first_name');
  $last_name = $this->input->post('last_name');
  if(!empty($first_name) && !empty($last_name)) {
      $student = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
      );
      if($this->admin->insert('student',$student)) {
        $this->response(array(
          "status" => 1,
          "message" => "Student has been created"
        ), REST_Controller::HTTP_OK);
      }
      else {
        $this->response(array(
          "status" => 0,
          "message" => "Failed to create student"
        ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }
  }
  else {
      $this->response(array(
        "status" => 0,
        "message" => "first_name,last_name is require"
      ), REST_Controller::HTTP_NOT_FOUND);
    }
}

public function index_get() {
  $id= $this->input->get("id");
  $search_term= $this->input->get("search_term");

  if($id>0) {
     $users = $this->admin->select_where('student',array('id'=>$id));
  }
  elseif($search_term) {
      $users = $this->admin->select_where1('student',$search_term);
  }
  else {
    $users = $this->admin->select_desc('student','id');
  }
  if(count($users) > 0) {
    $this->response(array(
      "status" => 1,
      "message" => "Students found",
      "data" => $users
    ), REST_Controller::HTTP_OK);
  } 
  else {
    $this->response(array(
      "status" => 0,
      "message" => "Students Not found",
      "data" => $users
    ), REST_Controller::HTTP_NOT_FOUND);
  }
}

public function index_delete() {
  $id= $this->input->get("id");
  $data=$this->admin->delete('student',array('id'=>$id));
  if(!empty($data)) {
      $this->response(array(
        "status" => 1,
        "message" => "Student has been Deleted",
      ), REST_Controller::HTTP_OK);
    }else{

      $this->response(array(
        "status" => 0,
        "message" => "Student Not found",
      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
}

public function index_put() {
  $id= $this->input->get("id");
  if($this->put('sfirst_name') && $this->put('slast_name')) {
    $first_name = $this->put('sfirst_name');
    $last_name = $this->put('slast_name');
  }
  else {
    $first_name = $this->put('first_name');
    $last_name = $this->put('last_name');
  }
  if(!empty($first_name) && !empty($last_name)) {
      $student = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
      );
      if($this->admin->update_row('student',$student,array('id'=>$id))) {
        $this->response(array(
          "status" => 1,
          "message" => "Student has been Update"
        ), REST_Controller::HTTP_OK);
      }
      else {
        $this->response(array(
          "status" => 0,
          "message" => "Failed to create student"
        ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }
  }
  else {
      $this->response(array(
        "status" => 0,
        "message" => "first_name,last_name is require"
      ), REST_Controller::HTTP_NOT_FOUND);
    }
}
  

}

 ?>
