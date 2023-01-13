<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

public function index() {
	$this->load->view('user');
}

public function userAdd() {
	$api_url = base_url()."User/index_post";
	$form_data = $this->input->post();
	$response = curl_post($api_url, $form_data);
	$val = json_decode($response, true);
	if($val['status']==1) {
		return redirect('Admin/userList');
	}
	else {
		$this->load->view('user',$val);
	}
}

public function userList() {
	$api_url = base_url()."User/index_get";
	$response = curl_get($api_url);
	$val = json_decode($response, true);
	if($val['status']==1) {
		$this->load->view('userList',$val);
	}
	else {
		$this->load->view('userList',$val);
	}
}

public function userDelete($id) {
	$api_url = base_url()."User/index_delete/?id=".$id;
	$response = curl_delete($api_url);
	$val = json_decode($response, true);
	if($val['status']==1) {
		return redirect('Admin/userList',$val);
	}
	else {
		return redirect('Admin/userList',$val);
	}
}

public function userEdit($id) {
	$api_url = base_url()."User/index_get/?id=".$id;
	$response = curl_get($api_url);
	$val = json_decode($response, true);
	if($val['status']==1) {
		$this->load->view('userEdit',$val);
	}
	else {
		return redirect('Admin/userList',$val);
	}
}

public function userUpdate($id) {
	$api_url = base_url()."User/index_get/?id=".$id;
	$form_data=$this->input->post();
	$response = curl_put($api_url,$form_data);
	$val = json_decode($response, true);
	print_r($val);
	if($val['status']==1) {
		return redirect('Admin/userList',$val);
	}
	else {
		return redirect('Admin/userList',$val);
	}
}







} ?>
