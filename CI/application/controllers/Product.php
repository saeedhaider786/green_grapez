<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Prod_setup_model', 'Prod_setup_model');
    }

	public function index(){
		$all_products = $this->Prod_setup_model->show_all();
		$this->load->view('product_views/all_products_view', array('products'=>$all_products));
	}

	public function add(){
		$this->load->view('product_views/add_product_view');
	}

	public function save(){
		$form_data = $this->input->post();
		$data = array('name'=>$form_data['prod_name'], 'price'=>$form_data['unit_price'], 
			'catagory'=>$form_data['prod_cat'], 'description'=>$form_data['prod_desc']);

		$response = $this->Prod_setup_model->save_product($data);
		if($response){
			$this->session->set_flashdata('success', "Product inserted successfully!");
			$this->load->view('product_views/add_product_view'); 
		}
		else{
			$this->session->set_flashdata('error', "Error in data insertion. Please try again later.");
			$this->load->view('product_views/add_product_view');
		}
	}

	public function edit($prod_id){
		$product_data = $this->Prod_setup_model->get_product_data($prod_id);
		$this->session->set_userdata('prod_id',$prod_id);
		$this->load->view('product_views/edit_product_view', array('product_data'=>$product_data));
	}

	public function update(){
		$form_data = $this->input->post();
		$data = array('name'=>$form_data['prod_name'], 'price'=>$form_data['unit_price'], 
			'catagory'=>$form_data['prod_cat'], 'description'=>$form_data['prod_desc']);

		//retrieve session data
		$prod_id = $this->session->userdata('prod_id');
		$response = $this->Prod_setup_model->update_product($prod_id, $data);
		if($response){
			$product_data = $this->Prod_setup_model->get_product_data($prod_id);
			$this->session->set_flashdata('update', "Product updated successfully!");
			$this->load->view('product_views/edit_product_view', array('product_data'=>$product_data)); 
		}
		else{
			$product_data = $this->Prod_setup_model->get_product_data($prod_id);
			$this->session->set_flashdata('update_error', "Error in data update. Please try again later.");
			$this->load->view('product_views/edit_product_view', array('product_data'=>$product_data));
		}
	}

	public function delete(){
		$prod_id = $this->input->post('id');
		$response = $this->Prod_setup_model->delete_product($prod_id);
		if($response){
			echo json_encode(TRUE);
		}else{
			echo json_encode(FALSE);
		}
	}

	public function invoice(){
		$all_products = $this->Prod_setup_model->show_all();
		$this->load->view('product_views/invoice_view', array('products'=>$all_products));
	}

	public function get_product(){
		$prod_id = $this->input->post('id');
		$product_data = $this->Prod_setup_model->get_product_data($prod_id);
		if($product_data){
			echo json_encode($product_data);
		}else{
			echo json_encode(FALSE);
		}
	}

	public function save_invoice(){
		$invoice_data = $this->input->post();
		$product_ids = $invoice_data['codes'];
		
		//stro all ids in a invoice in comma seperated string
		$product_ids = implode(',', $product_ids);
		$data = array('product_ids'=>$product_ids);

		$response = $this->Prod_setup_model->save_invoice($data);
		if($response){
			$this->session->set_flashdata('success', "Invoice saved successfully!");
			$this->load->view('product_views/invoice_view'); 
		}
		else{
			$this->session->set_flashdata('error', "Error in saving invoice. Please try again later.");
			$this->load->view('product_views/invoice_view');
		}
	}
}
