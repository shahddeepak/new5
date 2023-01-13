<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

public function index() {
	$this->load->view('api/employee');
}

public function employeeList() {
	$api_url = base_url()."api/EmployeeRest/index_get";
	$response = curl_get($api_url);
	$val = json_decode($response, true);
	echo json_encode($val);
	
}

public function employeeAdd() {
	$api_url = base_url()."api/EmployeeRest/index_post";
	 $form_data = $this->input->post();
	// print_r((array)$this->request->getPost());
	// echo $_POST = json_decode($form_data,true);
	// die();
	$response = curl_post($api_url, $form_data);
	$val = json_decode($response, true);
	echo json_encode($val);
}

public function employeeDelete() {
	$id=$this->input->post('student_id');
	$api_url = base_url()."api/EmployeeRest/index_delete/?id=".$id;
	$response = curl_delete($api_url);
	$val = json_decode($response, true);
	echo json_encode($val);

}

public function employeeEdit() {
	$id=$this->input->post('student_id');
	$api_url = base_url()."api/EmployeeRest/index_get/?id=".$id;
	$response = curl_get($api_url);
	$val = json_decode($response, true);
	echo json_encode($val);
}

public function employeeUpdate() {
	$id=$this->input->post('sid');
	$api_url = base_url()."api/EmployeeRest/index_put/?id=".$id;
	$form_data=$this->input->post();
	$response = curl_put($api_url,$form_data);
	$val = json_decode($response, true);
	echo json_encode($val);
}

public function employeeSearch() {
	$search_term=$this->input->post('search_term');
	$api_url = base_url()."api/EmployeeRest/index_get/?search_term=".$search_term;
	$response = curl_get($api_url);
	$val = json_decode($response, true);
	echo json_encode($val);
}


public function search(){
	   $id=$this->input->get('id');	
       // $api_url="https://dummy.restapiexample.com/api/v1/employee/1";
       $api_url="https://jsonplaceholder.typicode.com/posts";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $val = json_decode($response, true);
        echo json_encode($val);
        // echo json_encode($val['status']);
   
}


} ?>
