<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Action extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        $this->load->model('main_model');
    }

    // exist_adepto
    public function SGVsbG8gd29ybGQ()
    {

        header("Content-Type: application/json");


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $response = array();

            $adepto_site = $this->input->post('SGVsbG8gd29ybGQ');
            $adepto_site = parse_url($adepto_site, PHP_URL_SCHEME) . '://' . parse_url($adepto_site, PHP_URL_HOST) . "/";



            if ($this->main_model->existAdepto($adepto_site)) {

                $response = array("status" => "true", "site" => $adepto_site);
            } else {

                $response = array("status" => "false", "site" => $adepto_site);
            }

            print_r(json_encode($response));
        }
    }

    // Insert adepto
    public function aW5zZXJ0X2FkZXB0bw()
    {

        header("Content-Type: application/json");


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $response = array();


            $adepto_site = $this->input->post('SGVsbG8gd29ybGQ');



            if (strpos($adepto_site, "?") !== false) {
                $main = 0;
            } else {
                $main = $this->input->post('main');
            }



            if ($this->main_model->insertAdepto($adepto_site, $main)) {

                $response = array("status" => "true", "site" => $adepto_site);
            } else {

                $response = array("status" => "false", "site" => $adepto_site);
            }

            print_r(json_encode($response));
        }
    }

    public function YTWGGLH2895N12()
    {

        header("Content-Type: application/json");


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $response = array();

            $adepto_site = $this->input->post('SGVsbG8gd29ybGQ');
            $adepto_site = parse_url($adepto_site, PHP_URL_SCHEME) . '://' . parse_url($adepto_site, PHP_URL_HOST) . "/";


            if ($this->main_model->insertAdeptoMain($adepto_site)) {

                $response = array("status" => "true", "site" => $adepto_site);
            } else {

                $response = array("status" => "false", "site" => $adepto_site);
            }

            print_r(json_encode($response));
        }
    }

    // GetAdepto
    public function Z2V0X2FkZXB0bw()
    {
        header("Content-Type: application/json");


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $response = array();

            $adepto_site = $this->input->post('SGVsbG8gd29ybGQ');

            $adepto_site = parse_url($adepto_site, PHP_URL_SCHEME) . '://' . parse_url($adepto_site, PHP_URL_HOST) . "/";



            if ($this->main_model->getAdepto($adepto_site)) {

                $response = $this->main_model->getAdepto($adepto_site);
            } else {

                $response = array("status" => "false", "site" => $adepto_site);
            }

            print_r(json_encode($response));
        }
    }

    // Cliques no visitante
    public function Y2xpcXVlc19uby12aXRhbWVudGU()
    {

        header("Content-Type: application/json");


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $response = array();

            $adepto_site = htmlspecialchars($this->input->post('adp'));
            $link_clicado = htmlspecialchars($this->input->post('click'));
            $visitante_origem = htmlspecialchars($this->input->post('origin'));


            if ($this->main_model->cliques_no_visitante($adepto_site, $link_clicado, $visitante_origem)) {

                $response = array("status" => "true", "site" => $adepto_site);
            } else {

                $response = array("status" => "false", "site" => $adepto_site);
            }

            print_r(json_encode($response));
        }
    }

    function get_platform_label($plataforma)
    {

        if ($plataforma == "hotmart") {
            return 1;
        } else if ($plataforma == "kiwify") {
            return 2;
        } else if ($plataforma == "monetizze") {
            return 3;
        } else if ($plataforma == "clickbank") {
            return 4;
        } else if ($plataforma == "braip") {
            return 5;
        } else {
            return "Desconhecida";
        }
    }

    public function api_add_adepto()
    {

      try {
            $data = array(
                'alvo_ref'  => $this->input->post('ucode'),
                'alvo_nome' => $this->input->post('name'),
                'alvo_url'  => $this->input->post('sales_page'),
                'alvo_email'  => $this->input->post('email'),
                'alvo_plataforma'  => $this->get_platform_label($this->input->post('plataform')),
                'alvo_data' => date('Y-m-d H:i:s'),
                'alvo_owned' => 0,
                'alvo_price'  => $this->input->post('price'),
                'alvo_comissao'  => $this->input->post('commission'),
                'alvo_afiliacao_tipo'  => $this->input->post('affiliation_type'),
                'alvo_produto_nome' => $this->input->post('name'),
                'alvo_produto_link'  => $this->input->post('real_sales_page'),
                'alvo_instalado' => 0,
                'inapto'    => 0,
                'is_deleted' => 0
            );

            $exist_alvo = $this->main_model->check_alvo($data['alvo_url'], $data['alvo_email']);

            if ($exist_alvo) {


                if ($this->main_model->api_update_alvo($exist_alvo['id'], $data)) {

                    $response = array("status" => "true", "status" => "Atualizado com sucesso");
                } else {

                    $response = array("status" => "false", "status" => "Erro ao atualizar");
                }
            } else {


                if ($this->main_model->api_add_alvo($data)) {

                    $response = array("status" => "true", "status" => "Inserido com sucesso");
                } else {

                    $response = array("status" => "false", "status" => "Erro ao inserir");
                }
            }

            print_r(json_encode($response));

        } catch (Exception $e) {
           echo "Erro ao enviar ". $e;
                
        }
    }


}
