<?php

class Sub_Category_model extends CI_Model{

    function record_count() {

        return $this->db->count_all("sub_category");
    }

    function fetchCategoryPagination($limit, $start) {



        // $sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
        // $this->db->query($sql, array(3, 'live', 'Rick'));

        // $sql = "SELECT * FROM category";
        // $query = $this->db->query($sql);
        // return $query->row();
        $this->db->limit($limit, $start);
        $query = $this->db->get("sub_category");

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {

                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    function fetchSubCategory() {

        $this->db->select('
            sub_category.sub_category_id,
            sub_category.category_id, 
            sub_category.sub_category_name, 
            sub_category.sub_category_description, 
            sub_category.datetime_added,
            category.category_name')
        ->from('sub_category')
        ->join('category', 'sub_category.category_id = category.category_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {

                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    function fetchCategoryByID($id){
        $sql = "SELECT * FROM sub_category WHERE sub_category_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }

    function update_sub_category_by_id($id, $data){
        $this->db->where('sub_category_id', $id);
        $this->db->update('sub_category', $data);
    }

    function create_sub_category($data){
        $this->db->insert('sub_category', $data);
    }
    
    function search_sub_category($match) {
        $field = array('category.category_name','sub_category.sub_category_name');    
        // $this->db->like('concat('.implode(',',$field).')',$match);

        $this->db->select('
            sub_category.sub_category_id, 
            sub_category.category_id, 
            sub_category.sub_category_name, 
            sub_category.sub_category_description, 
            sub_category.datetime_added,
            category.category_name')
        ->from('sub_category')
        ->join('category', 'sub_category.category_id = category.category_id')
        ->like('concat('.implode(',',$field).')',$match);
        $query = $this->db->get();
        // $query = $this->db->get('sub_category');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


}