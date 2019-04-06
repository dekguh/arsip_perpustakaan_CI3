<?php
class Home extends CI_Controller{
    public $data = array();

    public function __construct(){
        parent::__construct();

        if(empty($this->session->email) OR empty($this->session->password) OR $this->User_model->login($this->session->email,$this->session->password) === 0){
            redirect("login");
        }

        $this->data["nickname"] = $this->session->email;

        // setting & config
        $config_web = config_web();
        $this->data["title_web"] = $config_web->title_web." - Dashboard";

        // auto update status peminjam
        foreach($this->Peminjam_model->list_data(array("status" => 1),FALSE)->result() as $result){
            if($result->end_date <= time()){
                $this->Peminjam_model->update_peminjam($result->id,array("status" => 2));
            }
        }
    }

    public function index(){
        $like_buku = array("");
        $this->data["total_buku"] = $this->Buku_model->list_data($like_buku,FALSE)->num_rows();
        $this->data["total_peminjam"] = $this->Peminjam_model->list_data($like_buku,FALSE)->num_rows();

        $this->load->view("header_view",$this->data);
        $this->load->view("home_view",$this->data);
        $this->load->view("footer_view");
    }

    public function logout(){
        $data = array('email','password');
        $this->session->unset_userdata($data);
        redirect("login");
    }
}