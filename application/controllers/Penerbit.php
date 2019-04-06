<?php
class Penerbit extends CI_Controller{
    public $data = array();
    
    public function __construct(){
        parent::__construct();

        if(empty($this->session->email) OR empty($this->session->password) OR $this->User_model->login($this->session->email,$this->session->password) === 0){
            redirect("login");
        }

        $this->data["nickname"] = $this->session->email;

        // setting & config
        $config_web = config_web();
        $this->data["title_web"] = $config_web->title_web." - Penerbit";
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
        $this->data["message"] = "";

        // auto update status peminjam
        foreach($this->Peminjam_model->list_data(array("status" => 1),FALSE)->result() as $result){
            if($result->end_date <= time()){
                $this->Peminjam_model->update_peminjam($result->id,array("status" => 2));
            }
        }
    }

    public function index($page_now = 0){
        $this->load->view("header_view",$this->data);

        if($this->input->post("tambahbtn")){
            $this->form_validation->set_rules("penerbit","Penerbit","required|min_length[4]|max_length[24]|alpha_numeric_spaces|xss_clean");
            if($this->form_validation->run() === TRUE){
                $penerbit = ucwords($this->input->post("penerbit"));
                if($this->Penerbit_model->already_penerbit($penerbit) == 1){
                    $data_arr = array("penerbit" => $penerbit);
                    $this->Penerbit_model->tambah_penerbit($data_arr);
                    $this->data["message"] = alert("success","Success added penerbit ".$penerbit.".");
                }else{
                    $this->data["message"] = alert("danger","Penerbit already added.");
                }
            }
        }

        if($this->input->post("deletebtn")){
            $listidpenerbit = $this->input->post("listidpenerbit");
            if(!empty($listidpenerbit)){
                for($i=0;$i<count($listidpenerbit);$i++){
                    if($this->Penerbit_model->get_id($listidpenerbit[$i])->num_rows() == 1){
                        $this->Penerbit_model->delete_penerbit($listidpenerbit[$i]);
                    }
                }
            }
        }

        // pagination & config
        $config["base_url"] = "http://127.0.0.1:8082/belajar/arsip_perpustakaan/index.php/penerbit/index/";
        $config["uri_segment"] = 3;
        $config["total_rows"] = $this->Penerbit_model->get_all()->num_rows();
        $config["per_page"] = 10;
        $config["use_page_numbers"] = TRUE;
        $total_page = ceil($config["total_rows"]/$config["per_page"]);
        $config["first_link"] = "First";
        $config["last_link"] = "Last";
        $config["full_tag_open"] = "<ul class='pagination justify-content-center'>";
        $config["full_tag_close"] = "</ul>";
        $config["first_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["first_tag_close"] = "</span></li>";
        $config["last_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["last_tag_close"] = "</span></li>";
        $config["num_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["num_tag_close"] = "</span></li>";
        $config["cur_tag_open"] = "<li class='page-item disabled'><span class='page-link'>";
        $config["cur_tag_close"] = "</span></li>";
        $config["next_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["next_tag_close"] = "</span></li>";
        $config["prev_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["prev_tag_close"] = "</span></li>";

        $this->pagination->initialize($config);
        $this->data["pagination"] = $this->pagination->create_links();

        if(empty($page_now) OR $page_now <= 1 OR is_numeric($page_now) === FALSE){
            $page_now = 0;
        }else{
            $page_now = $page_now - 1;
        }

        $this->data["list_penerbit"] = "";
        foreach($this->Penerbit_model->list_penerbit($page_now,$config["per_page"]) as $result){
            $this->data["list_penerbit"] .= "
            <tr>
                <td><input type='checkbox' name='listidpenerbit[]' value='".$result->id."'></td>
                <td>$result->penerbit</td>
            </tr>
            ";
        }

        if(empty($this->data["list_penerbit"]) OR $total_page > ($total_page + 1)){
            $this->data["list_penerbit"] = "<tr><td colspan='2' align='center'>No Data</td></tr>";
        }

        $this->load->view("penerbit_view",$this->data);
        $this->load->view("footer_view");
    }
    
}