<?php
class Penerbit_model extends CI_Model{
    public function construct(){
        parent::__construct();
    }

    public function get_id($id){
        return $this->db->get_where("penerbit",array("id" => $id));
    }

    public function tambah_penerbit($data){
        $this->db->insert("penerbit",$data);
    }

    public function delete_penerbit($id){
        $this->db->where("id",$id);
        $this->db->delete("penerbit");
    }

    public function get_all(){
        return $this->db->get("penerbit");
    }

    public function total_data(){
        return $this->get_all()->num_rows();
    }

    public function list_penerbit($offset = 0,$showpage = 1){
        return $this->db->select("*")->order_by("id","DESC")->get("penerbit",$showpage,$offset)->result();
    }

    public function already_penerbit($value){
        $already = $this->db->get_where("penerbit",array("penerbit" => $value));
        if($already->num_rows() == 0){
            return 1;
        }else{
            return 0;
        }
    }

    public function select_list($select = ""){
        $temp = "";
        foreach($this->get_all()->result() as $result){
            if($select == $result->id){
                $temp .= "<option value='$result->id' selected>$result->penerbit</option>";
            }else{
                $temp .= "<option value='$result->id'>$result->penerbit</option>";
            }

        }
        return $temp;
    }
}