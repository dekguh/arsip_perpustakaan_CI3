<?php
class Kategori_model extends CI_Model{
    public function construct(){
        parent::__construct();
    }

    public function get_id($value){
        return $this->db->get_where("kategori",array("id" => $value));
    }

    public function tambah_kategori($data){
        $this->db->insert("kategori",$data);
    }

    public function delete_kategori($id){
        $this->db->where("id",$id);
        $this->db->delete("kategori");
    }

    public function already_kategori($kategori){
        $already = $this->db->get_where("kategori",array("kategori" => $kategori));
        if($already->num_rows() == 0){
            return 1;
        }else{
            return 0;
        }
    }
    
    public function list_kategori($offset = 0,$showpage = 1){
        $list = $this->db->select("*")->order_by("id","DESC")->get("kategori",$showpage,$offset);
        return $list->result();
    }

    public function get_all(){
        return $this->db->get("kategori");
    }

    public function select_list($select = ""){
        $temp = "";
        foreach($this->get_all()->result() as $result){
            if($result->id == $select){
                $temp .= "<option value='".$result->id."' selected>".$result->kategori."</option>";
            }else{
                $temp .= "<option value='".$result->id."'>".$result->kategori."</option>";
            }
        }
        return $temp;
    }
}