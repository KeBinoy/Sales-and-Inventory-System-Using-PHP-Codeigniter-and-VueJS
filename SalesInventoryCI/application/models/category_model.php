<?php

class Category_model extends CI_Model{

    function record_count() {

        return $this->db->count_all("category");
    }

    function fetchCategoryPagination($limit, $start) {



        // $sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
        // $this->db->query($sql, array(3, 'live', 'Rick'));

        // $sql = "SELECT * FROM category";
        // $query = $this->db->query($sql);
        // return $query->row();
        $this->db->limit($limit, $start);
        $query = $this->db->get("category");

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {

                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    function fetchCategory() {


        $query = $this->db->get("category");

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {

                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    function fetchCategoryByID($id){
        $sql = "SELECT * FROM category WHERE category_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }

    function update_category_by_id($id, $data){
        $this->db->where('category_id', $id);
        $this->db->update('category', $data);
    }

    function create_category($data){
        $this->db->insert('category', $data);
    }
    
    function search_category($match) {
        $field = array('category_id','category_name');    
        $this->db->like('concat('.implode(',',$field).')',$match);
        $query = $this->db->get('category');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    function fetchSortCategory($col,$ord){
        $this->db->order_by($col, $ord);
        $query = $this->db->get('category'); 
        return $query->result();
    }

}