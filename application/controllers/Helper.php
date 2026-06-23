<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Helper extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->model('tung_model');
    }

    public function index()
    {
        $response = array();

        $helper_code = htmlspecialchars($this->input->get('helper_code'));

        $adp_colligate = $this->tung_model->get_adp_data($helper_code);

        if ($adp_colligate) {

            $response = array('status' => 'true', "message" => "Adepto encontrado.", "response" => $adp_colligate);

        } else {

            $response = array('status' => 'false', "message" => "Adepto não encontrado.");

        }


        print_r(json_encode($response));

    }
}
