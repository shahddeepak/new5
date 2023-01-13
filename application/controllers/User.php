<?php

require APPPATH.'libraries/REST_Controller.php';

class User extends REST_Controller {

public function index_post() {
  $user_name = $this->input->post('user_name');
  $user_email = $this->input->post('user_email');
  $password = $this->input->post('password');
  if(!empty($user_name) && !empty($user_email) && !empty($password)) {
      $user = array(
        "user_name" => $user_name,
        "user_email" => $user_email,
        "password" => $password,
      );
      if($this->admin->insert('user',$user)) {
        $this->response(array(
          "status" => 1,
          "message" => "User has been created"
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
        "message" => "user_name,user_email,password is require"
      ), REST_Controller::HTTP_NOT_FOUND);
    }
}

public function index_get() {
  $id= $this->input->get("id");
  if($id>0) {
     $users = $this->admin->select_where('user',array('id'=>$id));
  }
  else {
    $users = $this->admin->select_desc('user','id');
  }
  if(count($users) > 0) {
    $this->response(array(
      "status" => 1,
      "message" => "Students found",
      "data" => $users
    ), REST_Controller::HTTP_OK);
  } else {
    $this->response(array(
      "status" => 0,
      "message" => "No Students found",
      "data" => $users
    ), REST_Controller::HTTP_NOT_FOUND);
  }
}

public function index_delete() {
  $id= $this->input->get("id");
  $data=$this->admin->delete('user',array('id'=>$id));
  if(!empty($data)) {
      $this->response(array(
        "status" => 1,
        "message" => "User has been Delete",
        "data"=>$data
      ), REST_Controller::HTTP_OK);
    }else{

      $this->response(array(
        "status" => 0,
        "message" => "No User found",
        "data"=>$data
      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
}

public function index_put() {
  $id= $this->input->get("id");
  $user_name = $this->put('user_name');
  $user_email = $this->put('user_email');
  $password = $this->put('password');
  if(!empty($user_name) && !empty($user_email) && !empty($password)) {
      $user = array(
        "user_name" => $user_name,
        "user_email" => $user_email,
        "password" => $password,
      );
      if($this->admin->update_row('user',$user,array('id'=>$id))) {
        $this->response(array(
          "status" => 1,
          "message" => "User has been Update"
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
        "message" => "user_name,user_email,password is require"
      ), REST_Controller::HTTP_NOT_FOUND);
    }
}
  // PUT: <project_url>/index.php/student
  // public function index_put(){
  //   // updating data method
  //   //echo "This is PUT Method";
  //   $data = json_decode(file_get_contents("php://input"));

  //   if(isset($data->id) && isset($data->name) && isset($data->email) && isset($data->mobile) && isset($data->course)){

  //     $student_id = $data->id;
  //     $student_info = array(
  //       "name" => $data->name,
  //       "email" => $data->email,
  //       "mobile" => $data->mobile,
  //       "course" => $data->course
  //     );

  //     if($this->student_model->update_student_information($student_id, $student_info)){

  //         $this->response(array(
  //           "status" => 1,
  //           "message" => "Student data updated successfully"
  //         ), REST_Controller::HTTP_OK);
  //     }else{

  //       $this->response(array(
  //         "status" => 0,
  //         "messsage" => "Failed to update student data"
  //       ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
  //     }
  //   }else{

  //     $this->response(array(
  //       "status" => 0,
  //       "message" => "All fields are needed"
  //     ), REST_Controller::HTTP_NOT_FOUND);
  //   }
  // }

  // DELETE: <project_url>/index.php/student
  // public function index_delete(){
  //   echo 'delete data method';
  //   die();
  //   $data = json_decode(file_get_contents("php://input"));
  //   $student_id = $this->security->xss_clean($data->student_id);

  //   if($this->student_model->delete_student($student_id)){
  //     // retruns true
  //     $this->response(array(
  //       "status" => 1,
  //       "message" => "Student has been deleted"
  //     ), REST_Controller::HTTP_OK);
  //   }else{
  //     // return false
  //     $this->response(array(
  //       "status" => 0,
  //       "message" => "Failed to delete student"
  //     ), REST_Controller::HTTP_NOT_FOUND);
  //   }
  // }

  // GET: <project_url>/index.php/student

}

 ?>
