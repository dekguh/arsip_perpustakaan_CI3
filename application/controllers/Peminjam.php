<?php
class Peminjam extends CI_Controller{
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

    public function update($id = 0){
        if(!empty($id) AND $id >= 1 AND $this->Peminjam_model->get_id($id)->num_rows() == 1){
            $this->data["list_data"] = "";
            $this->data["title_web"] = $this->data["title_web"]."Update Status";
            $info_peminjam =  $this->Peminjam_model->get_id($id)->row();
            $this->data["info_peminjam"] = $info_peminjam;

            if($info_peminjam->status != 3){
                // set rules
                $this->form_validation->set_rules("status","status","required|trim|greater_than_equal_to[1]|less_than_equal_to[3]");
                if($this->form_validation->run() === TRUE){
                    $data_arr = array("status" => $this->input->post("status"));
                    $this->Peminjam_model->update_peminjam($id,$data_arr);
                    redirect("peminjam");
                }

                $this->load->view("header_view",$this->data);
                $this->load->view("edit_peminjam",$this->data);
                $this->load->view("footer_view");
            }else{
                redirect("peminjam");
            }
        }else{
            redirect("peminjam");
        }
    }

    public function index($page_now = 1){
        $serch = [];
        $this->data["list_data"] = "";
        $this->data["title_web"] = $this->data["title_web"]."List Peminjam";

        if(!empty($this->input->get("nama"))){
            $search["nama"] = $this->input->get("nama");
        }else{
            $search["nama"] = "";
        }

        if(!empty($this->input->get("nim"))){
            $search["nim"] = $this->input->get("nim");
        }else{
            $search["nim"] = "";
        }

        if(!empty($this->input->get("status")) AND is_numeric($this->input->get("status")) == TRUE){
            $search["status"] = $this->input->get("status");
        }else{
            $search["status"] = "";
        }

        if(empty($page_now) OR $page_now <= 1){
            $page_now = 0;
        }else{
            $page_now = $page_now - 1;
        }

        $this->data["select_status"] = peminjam_select_status($select = "");
        $this->data["search_nama"] = $search["nama"];
        $this->data["search_nim"] = $search["nim"];

        if($this->input->post("deletebtn")){
            $listidpeminjam = $this->input->post("listidpeminjam");
            if(!empty($listidpeminjam)){
                for($i=0;$i<count($listidpeminjam);$i++){
                    if($this->Peminjam_model->get_id($listidpeminjam[$i])->num_rows() == 1){
                        $this->Peminjam_model->delete_peminjam($listidpeminjam[$i]);
                    }
                }
            }
        }

        // setting & pagination
        $config["base_url"] = "http://127.0.0.1:8082/belajar/arsip_perpustakaan/index.php/peminjam/index/";
        $config["total_rows"] = $this->Peminjam_model->list_data($search,FALSE)->num_rows();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["use_page_numbers"] = TRUE;
        $config["reuse_query_string"] = TRUE;
        $total_page = ceil($config["total_rows"]/$config["per_page"]);
        $offset = $page_now * $config["per_page"];
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

        foreach($this->Peminjam_model->list_data($search,TRUE,$offset,$config["per_page"])->result() as $result){
            $info_buku = $this->Buku_model->get_id($result->buku)->row();
            $status = peminjam_status($result->status);
            $this->data["list_data"] .= "
            <tr>
                <td><input type='checkbox' name='listidpeminjam[]' value='".$result->id."'></td>
                <td>".htmlspecialchars($result->nama)."</td>
                <td>".htmlspecialchars($result->nim)."</td>
                <td>".htmlspecialchars($info_buku->judul)."</td>
                <td>".date("d/m/Y h:i a",$result->end_date)."</td>
                <td>$status</td>
                <td><a class='btn btn-warning' href='".base_url("index.php/peminjam/update/".$result->id)."'>Update</a></td>
            </tr>
            ";
        }

        if(empty($this->data["list_data"]) OR ($page_now+1) > ($page_now+1)){
            $this->data["list_data"] = "<tr><td colspan='6' align='center'>No Data</td></tr>";
        }

        $this->load->view("header_view",$this->data);
        $this->load->view("peminjam_view",$this->data);
        $this->load->view("footer_view");

    }

    public function tambah(){
        $this->data["title_web"] = $this->data["title_web"]."Tambah Peminjam";

        $this->load->view("header_view",$this->data);

        // set rules form
        if($this->input->post("tambahbtn")){
            $this->form_validation->set_rules("nama","Nama","required|alpha_numeric_spaces|min_length[4]|max_length[64]|xss_clean");
            $this->form_validation->set_rules("nim","NIM","required|trim|integer|numeric|min_length[9]|max_length[9]|xss_clean");
            $this->form_validation->set_rules("kelas","Kelas","required|alpha_numeric_spaces|xss_clean");
            $this->form_validation->set_rules("buku","Buku","required|trim|integer|numeric|xss_clean");
            $this->form_validation->set_rules("end_date","End Date","trim|required|xss_clean");

            if($this->form_validation->run() === TRUE){
                if($this->Buku_model->get_id($this->input->post("buku"))->num_rows() == 1){
                    $end_date = explode("-",$this->input->post("end_date"));
                    $end_date = mktime(23,59,59,$end_date[1],$end_date[2],$end_date[0]);
                    if($end_date > mktime(23,59,59,date("m"),date("d"),date("Y"))){
                        $this->data["message"] = alert("success","success added ".htmlspecialchars($this->input->post("nama")).".");
                        $data_arr = array(
                            "nama" => $this->input->post("nama"),
                            "nim" => $this->input->post("nim"),
                            "buku" => $this->input->post("buku"),
                            "status" => 1,
                            "end_date" => $end_date
                        );
                        $this->Peminjam_model->tambah_peminjam($data_arr);
                    }else{
                        $this->data["message"] = alert("danger","End date must greater than today.");
                    }
                }else{
                    $this->data["message"] = alert("danger","Value id buku not valid.");
                }
            }
        }

        $this->load->view("form_peminjam",$this->data);
        $this->load->view("footer_view");

    }
}