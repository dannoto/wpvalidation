<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->model('main_model');
    }

    public function index()
    {



        $user_email = htmlspecialchars($this->input->post('user_email'));
        $user_password = htmlspecialchars($this->input->post('user_password'));

        if ($user_email == "tungstenio@tungstenio.com" && $user_password == date('Hii')) {

            $this->session->set_userdata('session_user', array("user_email" => "tungstenio@tungstenio.com", "user_password" => "$user_password"));

            $response = array('status' => 'true', "message" => "Logado com sucesso.");
        } else {

            $response = array('status' => 'false', "message" => "Falhou");
        }

        print_r(json_encode($response));
    }
}
