<?php
class Login extends CI_Controller{
    public $data = array();

    public function __construct(){
        parent::__construct();

        // check session jika valid maka redirect ke home
        if(!empty($this->session->email) AND !empty($this->session->password) AND $this->User_model->login($this->session->email,$this->session->password) == 1){
            redirect("home");
        }

        // config & setting
        $config_web = config_web();
        $this->data["site"] = $config_web->site;
        $this->data["message"] = "";
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }

    public function index(){
        if($this->input->post("loginbtn")){
            if(recaptcha($_POST["g-recaptcha-response"]) == 1){
                // set rules form login
                $this->form_validation->set_rules("email","email","trim|required|valid_email|xss_clean");
                $this->form_validation->set_rules("password","password","trim|required|min_length[6]");
                if($this->form_validation->run() === TRUE){
                    if($this->User_model->login($this->input->post("email"),$this->input->post("password")) == 1){
                        $this->session->set_userdata("email",$this->input->post("email"));
                        $this->session->set_userdata("password",$this->input->post("password"));
                        redirect("home");
                    }else{
                        $this->data["message"] = alert("danger","Email/password is wrong, try again.");
                        $this->load->view("login_view",$this->data);
                    }
                }else{
                    $this->load->view("login_view",$this->data);
                }
            }else{
                $this->data["message"] = alert("danger","Recaptcha Must checked.");
                $this->load->view("login_view",$this->data);
            }
        }else{
            $this->load->view("login_view",$this->data);
        }
        $this->load->view("footer_view");
    }
}