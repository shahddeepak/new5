<?php
class AdminModel extends CI_Model{
public function __construct() {
	parent::__construct();
    $this->load->database();
}

public function insert($table,$data) {
     $this->db->insert($table,$data);
     $insert_id = $this->db->insert_id();
     return  $insert_id;
}

public function select_desc($table,$order) {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->order_by($order,'DESC');
    $query = $this->db->get(); 
    return $query->result();
}

public function select_where($table,$where) {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($where);
    $query=$this->db->get();
    // print_r($this->db->last_query());    
    // die;
    return $query->result();
}

public function select_where1($table,$keyword) {
     $this->db->select('*');
    $this->db->from($table);
    $this->db->like('first_name',$keyword);
    $this->db->or_like('last_name',$keyword);
    $query=$this->db->get();
    return $query->result();
}

public function update_row($table,$data,$where) {
    $this->db->where($where);
    if($this->db->update($table,$data)) {
        return true;
    }
    else {
        return false;
    }
}

public function delete($table,$where) {
    return $this->db->delete($table,$where);
}

public function select_count($table) {
    $this->db->select('*');
    $this->db->from($table);
    $query = $this->db->get()->result();
    return $total_value=count($query);
}


}