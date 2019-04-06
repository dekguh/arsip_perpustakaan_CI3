<?php
class Buku_model extends CI_Model{
    public function construct(){
        parent::__construct();
    }

    public function get_id($id){
        return $this->db->get_where("buku",array("id" => $id));
    }

    public function delete_buku($id){
        $this->db->where("id",$id);
        $this->db->delete("buku");
    }

    public function tambah_buku($data){
        $this->db->insert("buku",$data);
    }

    public function list_data($like,$limit = FALSE, $offset = 0, $showpage = 0){
        $this->db->like($like);
        if($limit == TRUE){
            $this->db->limit($showpage, $offset);
            $this->db->order_by("id","DESC");
        }
        return $this->db->get("buku");
    }

    public function edit_buku($id,$data){
        $this->db->where("id",$id);
        $this->db->update("buku",$data);
    }
}