<?php
class Kategori extends CI_Controller{
    public $data = array();

    public function __construct(){
        parent::__construct();

        if(empty($this->session->email) OR empty($this->session->password) OR $this->User_model->login($this->session->email,$this->session->password) === 0){
            redirect("login");
        }
        
        $this->data["nickname"] = $this->session->email;

        // setting & config
        $config_web = config_web();
        $this->data["title_web"] = $config_web->title_web." - Kategori";
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
        $this->data["message"] = "";

        // auto update status peminjam
        foreach($this->Peminjam_model->list_data(array("status" => 1),FALSE)->result() as $result){
            if($result->end_date <= time()){
                $this->Peminjam_model->update_peminjam($result->id,array("status" => 2));
            }
        }
    }

    public function index($page_now = 1){
        $this->load->view("header_view",$this->data);
        if($this->input->post("deletebtn")){
            $listidkategori = $this->input->post("listidkategori");
            if(!empty($listidkategori)){
                for($i=0;$i<count($listidkategori);$i++){
                    if($this->Kategori_model->get_id($listidkategori[$i])->num_rows() == 1){
                        $this->Kategori_model->delete_kategori($listidkategori[$i]);
                    }
                }
            }
        }

        if($this->input->post("tambahbtn")){
            $this->form_validation->set_rules("kategori","kategori","required|min_length[4]|max_length[24]|alpha_numeric_spaces");
            if($this->form_validation->run() === TRUE){
                $kategori = ucwords($this->input->post("kategori"));
                if($this->Kategori_model->already_kategori($kategori) == 1){
                    $data_post = array("kategori" => $kategori);
                    $this->Kategori_model->tambah_kategori($data_post);
                    $this->data["message"] = alert("success","Success $kategori Added kategori.");
                }else{
                    $this->data["message"] = alert("danger","Kategori already added.");
                }
            }
        }

        // pagination config
        $total_rows = $this->Kategori_model->get_all()->num_rows();
        $config["base_url"] = "http://127.0.0.1:8082/belajar/arsip_perpustakaan/index.php/kategori/index/";
        $config["total_rows"] = $total_rows;
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $total_page = ceil($config["total_rows"]/$config["per_page"]);
        $config["use_page_numbers"] = TRUE;
        $config["first_link"] = "First";
        $config["last_link"] = "Last";
        $config["full_tag_open"] = "<ul class='pagination justify-content-center'>";
        $config["full_tag_close"] = "</ul>";
        $config["prev_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["prev_tag_close"] = "</span></li>";
        $config["next_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["next_tag_close"] = "</span></li>";
        $config["num_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["num_tag_close"] = "</span></li>";
        $config["cur_tag_open"] = "<li class='page-item disabled'><span class='page-link'>";
        $config["cur_tag_close"] = "</span></li>";
        $config["first_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["first_tag_close"] = "</span></li>";
        $config["last_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["last_tag_close"] = "</span></li>";

        $this->pagination->initialize($config);
        $this->data["pagination"] = $this->pagination->create_links();

        if(empty($page_now) OR $page_now <= 1 OR is_numeric($page_now) == FALSE){
            $page_now = 0;
        }else{
            $page_now = $page_now - 1;
        }

        $this->data["list_kategori"] = "";
        foreach($this->Kategori_model->list_kategori($page_now,$config["per_page"]) as $result){
            $this->data["list_kategori"] .= "
            <tr>
                <td><input type='checkbox' name='listidkategori[]' value='".$result->id."'></td>
                <td>$result->kategori</td>
            </tr>
            ";
        }

        if(empty($this->data["list_kategori"]) OR $total_page > ($page_now + 1)){
            $this->data["list_kategori"] = "<tr><td colspan='2' align='center'>No Data</td></tr>";
        }
        
        $this->load->view("kategori_view",$this->data);
        $this->load->view("footer_view",$this->data);
    }
}