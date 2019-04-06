<?php
class User_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function get_by($type,$value){
        if($type == 1){ // by email
            $data = array("email" => $value);
        }elseif($type == 2){ // by id
            $data = array("id" => $value);
        }

        return $this->db->get_where("users",$data);
    }

    public function login($email,$password){
        $info_user = $this->get_by(1,$email)->row();
        if($this->get_by(1,$email)->num_rows() == 1){
            if(password_verify($password,$info_user->password) === TRUE){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}