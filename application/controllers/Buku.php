<?php
class Buku extends CI_Controller{
    public $data = array();
    public function __construct(){
        parent::__construct();

        if(empty($this->session->email) OR empty($this->session->password) OR $this->User_model->login($this->session->email,$this->session->password) === 0){
            redirect("login");
        }
        
        $this->data["nickname"] = $this->session->email;

        // setting & config
        $config_web = config_web();
        $this->data["title_web"] = $config_web->title_web." - ";
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
        $this->data["title_web"] = $this->data["title_web"]."List Buku";
        $search = [];
        $this->data["list_kategori"] = $this->Kategori_model->select_list($this->input->get("kategori"));
        $this->data["list_penerbit"] = $this->Penerbit_model->select_list($this->input->get("penerbit"));

        // search form
        if(!empty($this->input->get("judul"))){
            $search["judul"] = xss_clean($this->input->get("judul"));
        }else{
            $search["judul"] = "";
        }

        if(!empty($this->input->get("pengarang"))){
            $search["pengarang"] = xss_clean($this->input->get("pengarang"));
        }else{
            $search["pengarang"] = "";
        }

        if(!empty($this->input->get("status"))){
            $search["status"] = xss_clean($this->input->get("status"));
        }else{
            $search["status"] = "";
        }

        if(!empty($this->input->get("penerbit"))){
            $search["penerbit"] = xss_clean($this->input->get("penerbit"));
        }else{
            $search["penerbit"] = "";
        }

        if(!empty($this->input->get("kategori"))){
            $search["kategori"] = xss_clean($this->input->get("kategori"));
        }else{
            $search["kategori"] = "";
        }

        if(!empty($this->input->get("tahunterbit"))){
            $search["terbit"] = xss_clean($this->input->get("tahunterbit"));
        }else{
            $search["terbit"] = "";
        }

        if($this->input->post("deletebtn")){
            $listidbuku = $this->input->post("listidbuku");
            if(!empty($listidbuku)){
                for($i=0;$i<count($listidbuku);$i++){
                    if($this->Buku_model->get_id($listidbuku[$i])->num_rows() == 1){
                        $this->Buku_model->delete_buku($listidbuku[$i]);
                    }
                }
            }
        }

        // config & setting
        $this->data["list_data"] = "";
        if(empty($page_now) OR $page_now <= 1 OR is_numeric($page_now) == FALSE){
            $page_now = 0;
        }else{
            $page_now = $page_now - 1;
        }
        $config["base_url"] = "http://127.0.0.1:8082/belajar/arsip_perpustakaan/index.php/buku/index/";
        $config["uri_segment"] = 3;
        $config["per_page"] = 10;
        $config["use_page_numbers"] = TRUE;
        $config["page_query_string"] = FALSE;
        $config["reuse_query_string"] = TRUE;
        $offset = $page_now * $config["per_page"];
        $config["total_rows"] = $this->Buku_model->list_data($search,FALSE,0,0)->num_rows();
        $total_page = ceil($config["total_rows"]/$config["per_page"]);
        $config["first_link"] = "First";
        $config["last_link"] = "Last";
        $config["full_tag_open"] = "<ul class='pagination justify-content-center'>";
        $config["full_tag_close"] = "</ul>";
        $config["first_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["first_tag_close"] = "</span></li>";
        $config["last_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["last_tag_close"] = "</span></li>";
        $config["next_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["next_tag_close"] = "</span></li>";
        $config["prev_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["prev_tag_close"] = "</span></li>";
        $config["num_tag_open"] = "<li class='page-item'><span class='page-link'>";
        $config["num_tag_close"] = "</span></li>";
        $config["cur_tag_open"] = "<li class='page-item disabled'><span class='page-link'>";
        $config["cur_tag_close"] = "</span></li>";

        $this->pagination->initialize($config);
        $this->data["pagination"] = $this->pagination->create_links($config);
        foreach($this->Buku_model->list_data($search,TRUE,$offset,$config["per_page"])->result() as $result){
            $info_kategori = $this->Kategori_model->get_id($result->kategori)->row();
            $info_penerbit = $this->Penerbit_model->get_id($result->penerbit)->row();
            $this->data["list_data"] .= "
                <tr>
                <td><input type='checkbox' name='listidbuku[]' value='".$result->id."' ></td>
                <td>".xss_clean(htmlspecialchars($result->judul))."</td>
                <td>".xss_clean(htmlspecialchars($info_kategori->kategori))."</td>
                <td>".xss_clean(htmlspecialchars($info_penerbit->penerbit))."</td>
                <td><a href='".base_url("index.php/buku/edit/".$result->id)."' class='btn btn-info'>Edit</a></td>
                </tr>
            ";
        }
        
        if(empty($this->data["list_data"]) OR ($page_now+1) > $total_page){
            $this->data["list_data"] = "<tr><td colspan='5' align='center'>No Data</td></tr>";
        }

        $this->data["search_judul"] = $search["judul"];
        $this->data["search_pengarang"] = $search["pengarang"];
        $this->data["search_terbit"] = $search["terbit"];

        $this->load->view("header_view",$this->data);
        $this->load->view("buku_view",$this->data);
        $this->load->view("footer_view");
    }

    public function tambah(){
        $this->data["title_web"] = $this->data["title_web"]."Tambah Buku";
        $this->data["select_kategori"] = $this->Kategori_model->select_list();
        $this->data["select_penerbit"] = $this->Penerbit_model->select_list();
        $this->load->view("header_view",$this->data);

        if($this->input->post("tambahbtn")){
            $this->form_validation->set_rules("judul","Judul buku","required|alpha_numeric_spaces|min_length[4]|max_length[48]|xss_clean");
            $this->form_validation->set_rules("isbn","ISBN","required|trim|xss_clean");
            $this->form_validation->set_rules("tahunterbit","Tahun Terbit","trim|required|numeric|integer|regex_match[/[0-9]{4}/]|xss_clean");
            $this->form_validation->set_rules("pengarang","Nama Pengarang","required|alpha_numeric_spaces|min_length[3]|max_length[64]|xss_clean");
            $this->form_validation->set_rules("kategori","Kategori","trim|required|numeric|integer|xss_clean");
            $this->form_validation->set_rules("penerbit","Penerbit","trim|required|numeric|integer|xss_clean");
            $this->form_validation->set_rules("jumlah","Jumlah Buku","trim|required|numeric|integer|greater_than_equal_to[1]|less_than_equal_to[10000]|xss_clean");
            $this->form_validation->set_rules("rak_buku","Rak Buku","trim|required|xss_clean");
            $this->form_validation->set_rules("sinopsis","Sinopsis","required|min_length[12]|max_length[216]|xss_clean");

            if($this->form_validation->run() === TRUE){
                if($this->Kategori_model->get_id($this->input->post("kategori"))->num_rows() == 1){
                    if($this->Penerbit_model->get_id($this->input->post("penerbit"))->num_rows() == 1){
                        $data_arr = array(
                            "judul" => htmlspecialchars($this->input->post("judul")),
                            "terbit" => htmlspecialchars($this->input->post("tahunterbit")),
                            "isbn" => htmlspecialchars($this->input->post("isbn")),
                            "pengarang" => htmlspecialchars($this->input->post("pengarang")),
                            "penerbit" => htmlspecialchars($this->input->post("penerbit")),
                            "kategori" => htmlspecialchars($this->input->post("kategori")),
                            "jumlah" => htmlspecialchars($this->input->post("jumlah")),
                            "rak_buku" => htmlspecialchars($this->input->post("rak_buku")),
                            "sinopsis" => htmlspecialchars($this->input->post("sinopsis")),
                            "status" => 1 // 1 status active
                        );
                        $this->Buku_model->tambah_buku($data_arr);
                        $this->data["message"] = alert("success","success add book to library.");
                    }else{
                        $this->data["message"] = alert("danger","Penerbit value not valid.");
                    }
                }else{
                    $this->data["message"] = alert("danger","Kategori value not valid.");
                }
            }
        }

        $this->load->view("form_buku",$this->data);
        $this->load->view("footer_view");
    }

    public function edit($id = ""){
        $this->data["title_web"] = $this->data["title_web"]."Edit Buku";
        if(empty($id) OR $this->Buku_model->get_id(htmlspecialchars($id))->num_rows() != 1){
            redirect("buku");
        }

        // set rules form
        if($this->input->post("editbtn")){
            $this->form_validation->set_rules("judul","Judul buku","required|alpha_numeric_spaces|min_length[4]|max_length[48]|xss_clean");
            $this->form_validation->set_rules("isbn","ISBN","required|trim|xss_clean");
            $this->form_validation->set_rules("tahunterbit","Tahun Terbit","trim|required|numeric|integer|regex_match[/[0-9]{4}/]|xss_clean");
            $this->form_validation->set_rules("pengarang","Nama Pengarang","required|alpha_numeric_spaces|min_length[3]|max_length[64]|xss_clean");
            $this->form_validation->set_rules("kategori","Kategori","trim|required|numeric|integer|xss_clean");
            $this->form_validation->set_rules("penerbit","Penerbit","trim|required|numeric|integer|xss_clean");
            $this->form_validation->set_rules("jumlah","Jumlah Buku","trim|required|numeric|integer|greater_than_equal_to[1]|less_than_equal_to[10000]|xss_clean");
            $this->form_validation->set_rules("rak_buku","Rak Buku","trim|required|xss_clean");
            $this->form_validation->set_rules("sinopsis","Sinopsis","required|min_length[12]|max_length[216]|xss_clean");

            if($this->form_validation->run() === TRUE){
                if($this->Kategori_model->get_id($this->input->post("kategori"))->num_rows() == 1){
                    if($this->Penerbit_model->get_id($this->input->post("penerbit"))->num_rows() == 1){
                        $data_arr = array(
                            "judul" => htmlspecialchars($this->input->post("judul")),
                            "terbit" => htmlspecialchars($this->input->post("tahunterbit")),
                            "isbn" => htmlspecialchars($this->input->post("isbn")),
                            "pengarang" => htmlspecialchars($this->input->post("pengarang")),
                            "penerbit" => htmlspecialchars($this->input->post("penerbit")),
                            "kategori" => htmlspecialchars($this->input->post("kategori")),
                            "jumlah" => htmlspecialchars($this->input->post("jumlah")),
                            "rak_buku" => htmlspecialchars($this->input->post("rak_buku")),
                            "sinopsis" => htmlspecialchars($this->input->post("sinopsis")),
                        );
                        $this->Buku_model->edit_buku($id,$data_arr);
                        $this->data["message"] = alert("success","Edit Success.");
                    }else{
                        $this->data["message"] = alert("danger","Penerbit value not valid.");
                    }
                }else{
                    $this->data["message"] = alert("danger","Kategori value not valid.");
                }
            }
        }
        
        $info_buku = $this->Buku_model->get_id($id)->row();
        // default value
        $this->data["data_judul"] = $info_buku->judul;
        $this->data["data_terbit"] = $info_buku->terbit;
        $this->data["data_isbn"] = $info_buku->isbn;
        $this->data["data_kategori"] = $this->Kategori_model->select_list($info_buku->kategori);
        $this->data["data_penerbit"] = $this->Penerbit_model->select_list($info_buku->penerbit);
        $this->data["data_pengarang"] = $info_buku->pengarang;
        $this->data["data_jumlah"] = $info_buku->jumlah;
        $this->data["data_rakbuku"] = $info_buku->rak_buku;
        $this->data["data_sinopsis"] = $info_buku->sinopsis;

        $this->load->view("header_view",$this->data);
        $this->load->view("edit_buku",$this->data);
        $this->load->view("footer_view");

    }
}