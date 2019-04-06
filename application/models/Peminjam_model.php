<?php
class Peminjam_model extends CI_Model{
    public function construct(){
        parent::__construct();
    }

    public function get_id($id){
        return $this->db->get_where("peminjam",array("id" => $id));
    }

    public function tambah_peminjam($data){
        $this->db->insert("peminjam",$data);
    }

    public function delete_peminjam($id){
        $this->db->where("id",$id);
        $this->db->delete("peminjam");
    }

    public function edit_peminjam($id,$data){
        $this->db->where("id",$id);
        $this->db->update("peminjam",$data);
    }

    public function list_data($data,$limit = FALSE,$offset = 0,$showpage = 0){
        $this->db->like($data);
        if($limit == TRUE){
            $this->db->limit($showpage,$offset);
        }
        return $this->db->get("peminjam");
    }

    public function update_peminjam($id,$data){
        $this->db->where("id",$id);
        $this->db->update("peminjam",$data);
    }
}