<?php
class main_model extends CI_Model
{


    public function existAdepto($adepto_site)
    {

        $this->db->where('adp_site', $adepto_site);
        return $this->db->get('adeptos_main')->row_array();
    }
    public function check_alvo($adepto_site, $adepto_email)
    {

        $this->db->where('alvo_email', $adepto_email);
        $this->db->where('alvo_url', $adepto_site);
        $this->db->where('is_deleted', 0);

        return $this->db->get('alvos')->row_array();
    }

    public function register_payload_log($alvo_payload, $alvo_url, $alvo_email, $alvo_language, $alvo_type = "email")
    {

        $data = array(
            'log_payload' => $alvo_payload,
            'log_type' => $alvo_type,
            'log_url' => $alvo_url,
            'log_email' => $alvo_email,
            'log_language' => $alvo_language,
            'log_data' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('logs', $data);
    }

    public function update_alvo_owned($id, $status)
    {
        $this->db->where('id', $id);

        $data = array(
            'alvo_owned' => $status
        );

        return $this->db->update('alvos', $data);
    }


    public function is_alvo_owned($adepto_site)
    {

        $this->db->where('alvo_url', $adepto_site);
        $this->db->where('alvo_owned', 1);

        return $this->db->get('alvos')->row_array();
    }

    public function get_logs_by_domain($alvo_url)
    {

        $this->db->where('log_url', $alvo_url);
        return $this->db->get('logs')->result();
    }

    public function existCredenciais($adepto_site)
    {
        $this->db->where('alvo_url', $adepto_site);
        $this->db->where('alvo_reputation', 1);

        return $this->db->get('alvos_credenciais')->row_array();
    }

    public function updateElementor($id, $elementorVersion, $status)
    {

        $this->db->where('id', $id);

        $data = array(
            'alvo_elementor' => $elementorVersion,
            'alvo_elementor_status' => $status
        );

        return $this->db->update('alvos', $data);
    }
    public function updateAlvo($alvo_id, $alvo_data)
    {

        $this->db->where('id', $alvo_id);
        return $this->db->update('alvos', $alvo_data);
    }

    public function getAdepto($adp_site)
    {
        $this->db->select('adp_id, adp_proportion, adp_active'); // Seleciona apenas os campos adp_id e adp_proportion
        $this->db->where('adp_site', $adp_site);
        return $this->db->get('adeptos_main')->row_array();
    }


    public function insertAdepto($adepto_site, $main)
    {

        $data = array(
            'adepto_data' => date('Y-m-d H:i:s'),
            'adepto_site' => $adepto_site,
            'adepto_proporcao' => 10,
            'adepto_vendas' => 0,
            'link_afiliado' => "-",
            'adepto_active' => 0,
            'main' => $main
        );

        return $this->db->insert('adeptos', $data);
    }

    public function insertAdeptoMain($adp_site)
    {

        $data = array(
            'adp_data' => date('Y-m-d H:i:s'),
            'adp_site' => $adp_site,
            'adp_install' => 0,
            'adp_proportion' => 0,
            'adp_sell' => 0,
            'adp_id' => "",
            'adp_active' => 0,
            'adp_classification' => 0,
            'adp_helper_code' => mt_rand(),
            'adp_colligate' => ""
        );

        return $this->db->insert('adeptos_main', $data);
    }

    public function cliques_no_visitante($adepto_site, $link_clicado, $visitante_origem)
    {

        $data = array(
            'data' => date('Y-m-d H:i:s'),
            'produtor_site' => $adepto_site,
            'link_clicado' => $link_clicado,
            'visitante_origem' => $visitante_origem,
        );

        return $this->db->insert('cliques_no_visitantes', $data);
    }


    // ============
    public function inaptoalvo($alvo_id)
    {
        $this->db->where('id', $alvo_id);

        $data = array(
            'inapto' => 1
        );

        return $this->db->update('alvos', $data);
    }

    public function deletecredential($alvo_id)
    {
        $this->db->where('id', $alvo_id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('alvos_credenciais', $data);
    }

    public function deletealvo($alvo_id)
    {
        $this->db->where('id', $alvo_id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('alvos', $data);
    }

    public function checkAlvo($alvo_url, $alvo_email)
    {

        $this->db->where('alvo_url', $alvo_url);
        $this->db->where('alvo_email', $alvo_email);
        $this->db->where('is_deleted', 0);

        return $this->db->get('alvos')->row_array();
    }

    public function addAlvo($alvo_url, $alvo_email, $alvo_nome, $alvo_ref, $alvo_plataforma, $alvo_produto_link)
    {
        $data = array(
            'alvo_url' => $alvo_url,
            'alvo_email' => $alvo_email,
            'alvo_nome' => $alvo_nome,
            'alvo_ref' => $alvo_ref,
            'alvo_plataforma' => $alvo_plataforma,
            'alvo_data' => date('Y-m-d h:i:s'),
            'alvo_produto_link' => $alvo_produto_link
        );

        return $this->db->insert('alvos', $data);
    }
    public function getAlvos()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('alvos')->result();
    }

    public function getAlvo($alvo_id)
    {
        $this->db->where('id', $alvo_id);
        return $this->db->get('alvos')->row_array();
    }

    public function getAlvosElementor()
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit(10);
        $this->db->where('alvo_elementor_status', 0);
        return $this->db->get('alvos')->result();
    }

    public function countCredenciaisByUrl($alvo_url)
    {
        $this->db->where('alvo_url', $alvo_url);
        $this->db->where('alvo_reputation', 1);
        return $this->db->get('alvos_credenciais')->result();
    }

    public function addCountAlvoEnvios($alvo_url, $alvo_email)
    {
        $this->db->set('alvo_envios', 'alvo_envios+1', FALSE);
        $this->db->where('alvo_url', $alvo_url);
        $this->db->where('alvo_email', $alvo_email); // substitua $alvo_url pelo alvo_url do alvo específico que você deseja atualizar
        return $this->db->update('alvos');
    }


    public function addCountAlvoPaginaAbertura($alvo_url, $alvo_email)
    {
        $this->db->set('alvo_pagina_abertura', 'alvo_pagina_abertura+1', FALSE);
        $this->db->where('alvo_url', $alvo_url);
        $this->db->where('alvo_email', $alvo_email); // substitua $alvo_url pelo alvo_url do alvo específico que você deseja atualizar
        return $this->db->update('alvos');
    }

    public function addCountAlvoPaginaLogin($alvo_url, $alvo_email)
    {
        $this->db->set('alvo_login_abertura', 'alvo_login_abertura+1', FALSE);
        $this->db->where('alvo_url', $alvo_url);
        $this->db->where('alvo_email', $alvo_email); // substitua $alvo_url pelo alvo_url do alvo específico que você deseja atualizar
        return $this->db->update('alvos');
    }

    public function addCountAlvoEmail($alvo_url, $alvo_email)
    {
        $this->db->set('alvo_email_abertura', 'alvo_email_abertura+1', FALSE);
        $this->db->where('alvo_url', $alvo_url);
        $this->db->where('alvo_email', $alvo_email); // substitua $alvo_url pelo alvo_url do alvo específico que você deseja atualizar
        return $this->db->update('alvos');
    }

    public function addAlvoCredenciais($adepto_url, $adepto_email, $adepto_login, $adepto_password, $alvo_reputation)
    {

        $data = array(
            'alvo_url' => $adepto_url,
            'alvo_email' => $adepto_email,
            'alvo_login' => $adepto_login,
            'alvo_password' => $adepto_password,
            'alvo_data' => date('Y-m-d h:i:s'),
            'alvo_reputation' => $alvo_reputation,

        );

        return $this->db->insert('alvos_credenciais', $data);
    }

    public function getAlvoByRef($alvo_ref)
    {
        $this->db->where('alvo_ref', $alvo_ref);
        return $this->db->get('alvos')->row_array();
    }

    public function checkSession()
    {
        if ($this->session->userdata('session_user')) {
        } else {
            redirect(base_url('painel/login'));
        }
    }


    public function api_add_alvo($data)
    {
        return $this->db->insert('alvos', $data);
    }

    public function api_update_alvo($id, $data)
    {

        $this->db->where('id', $id);
        return $this->db->update('alvos', $data);
    }
}
