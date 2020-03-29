<?php 
class Prod_setup_model extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->load->database();
    }

	public function save_product($data){
        $q = $this->db->insert('product_setup', $data);
        return $q; 
	}

	public function update_product($prod_id, $data){
		$q = $this->db->update('product_setup',$data,array('id' => $prod_id));
		return $q;
	}

	public function show_all(){
        $q = $this->db->query('SELECT * FROM PRODUCT_SETUP');
        return $q->result(); 	
	}
	public function get_product_data($prod_id){
		$q = $this->db->query("SELECT * FROM PRODUCT_SETUP WHERE id =$prod_id");
        return $q->row();
	}

	public function delete_product($prod_id){
		$this->db->delete('product_setup', array('id' => $prod_id));
	}

	public function save_invoice($data){
		$q = $this->db->insert('product_invoices', $data);
        return $q; 
	}
}