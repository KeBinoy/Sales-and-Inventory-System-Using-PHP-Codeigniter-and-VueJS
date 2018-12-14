<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubCategory extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array();
		$data['title'] = "Category";
		$data["base_url"] = base_url() . "Category/index";
		$data["total_rows"] = $this->category_model->record_count();
		$data["per_page"] = 10;
		$data["uri_segment"] = 3;

		$this->pagination->initialize($data);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["results"] = $this->category_model->fetchCategoryPagination($data["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data['content'] = $this->load->view('SubCategory/Index',$data,true);
		$this->load->view('Layout',$data);
	}

	public function getCategoryByIDJS($id){
		$categories = $this->category_model->fetchCategoryByID($id);
		// $response = array();
		$posts = array();
		$posts[] = array(
			"category_id"              =>  $categories->category_id,
			"category_name"            =>  $categories->category_name,
			"category_description"            =>  $categories->category_description
			);
		// $response['posts'] = $posts;
		echo json_encode($posts,TRUE);
	}

	public function getAllSubCategoryJS(){
		$query=  $this->category_model->fetchCategory();
		if($query){
			$result['subCategories']  = $this->sub_category_model->fetchSubCategory();
		}
		echo json_encode($result);
	}

	public function getCategory($id){
		$data = array();
		$data['result'] = $this->category_model->fetchCategoryByID($id);
		$data['title'] = "Category";
		$data['content'] = $this->load->view('Category/Update',$data,true);
		$this->load->view('Layout',$data);
	}
	public function updateCategory(){

		$data = array();
		$category_id = $this->input->post('category_id',true);
		/* Set validation rule for name field in the form */ 
		$this->form_validation->set_rules('category_name', 'Category Name', 'required'); 
		if ($this->form_validation->run() == FALSE) { 
         	 // $data = array();
			$data['result'] = $this->category_model->fetchCategoryByID($category_id);
			$this->load->view('Category/Update',$data); 
		} 
		else { 
            // $category_id = $this->input->post('category_id',true);
			$data['category_name'] = $this->input->post('category_name',true);
			$this->category_model->update_category_by_id($category_id,$data);
			redirect('category/index');
		} 

	}

	public function createCategory(){
		$data = array();
		/* Set validation rule for name field in the form */ 
		$config = array(
			array('field' => 'catName',
				'label' => 'Category Name',
				'rules' => 'trim|required'
				));
		$this->form_validation->set_rules($config);
		// $this->form_validation->set_rules('category_name', 'Category Name', 'required'); 
		if ($this->form_validation->run() == FALSE) { 
         	 // $data = array();

			$result['error'] = true;
			$result['msg'] = array(
				'catName'=>form_error('category_name')
				);
			$this->load->view('Category'); 
		} 
		else { 
            // $category_id = $this->input->post('category_id',true);
			$data['category_name'] = $this->input->post('category_name',true);
			$data['category_description'] = $this->input->post('category_description',true);
			$this->category_model->create_category($data);
			redirect('Category');
		} 
	}

	public function createSubCategoryJS(){
		$data = array();
		$result = array();
		$config = array(
			array('field' => 'category_id',
				'label' => 'Category Name',
				'rules' => 'trim|required'
				),
			array('field' => 'sub_category_name',
				'label' => 'Sub Category Name',
				'rules' => 'trim|required'
				));
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) { 
			$result['error'] = true;
			$result['msg'] = array(
				'category_id'=>form_error('category_id'),
				'sub_category_name'=>form_error('sub_category_name')
				);
			// $this->load->view('Category'); 
		} 
		else { 
            // $category_id = $this->input->post('category_id',true);
            $data['category_id'] = $this->input->post('category_id',true);
			$data['sub_category_name'] = $this->input->post('sub_category_name',true);
			$data['sub_category_description'] = $this->input->post('sub_category_description',true);
			if($this->sub_category_model->create_sub_category($data)){
				$result['error'] = false;
				$result['msg'] ='Sub Category added successfully';
			// redirect('Category');
			}
		} 
		echo json_encode($result);
	}

	public function updateSubCategoryJS(){
		$data = array();
		$result = array();
		$config = array(
			array('field' => 'category_id',
				'label' => 'Category Name',
				'rules' => 'trim|required'
				),
			array('field' => 'sub_category_name',
				'label' => 'Sub Category Name',
				'rules' => 'trim|required'
				));
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) { 
			$result['error'] = true;
			$result['msg'] = array(
				'category_id'=>form_error('category_id'),
				'sub_category_name'=>form_error('sub_category_name')
				);
			// $this->load->view('Category'); 
		} 
		else { 
            $sub_category_id = $this->input->post('sub_category_id',true);
			$data['category_id'] = $this->input->post('category_id',true);
			$data['sub_category_name'] = $this->input->post('sub_category_name',true);
			$data['sub_category_description'] = $this->input->post('sub_category_description',true);
			if($this->sub_category_model->update_sub_category_by_id($sub_category_id, $data)){
				$result['error'] = false;
				$result['success'] ='Sub Category Updated successfully';
			// redirect('Category');
			}
		} 
		echo json_encode($result);
	}
	public function searchSubCategoryJS(){
         $value = $this->input->post('text');
          $query =  $this->sub_category_model->search_sub_category($value);
           if($query){
               $result['subCategories']= $query;
           }
        echo json_encode($result);
    }
}
