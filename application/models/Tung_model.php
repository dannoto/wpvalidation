<?php



class tung_model extends CI_Model
{

    public function get_adp_prospection()
    {
        $this->db->order_by('adp_active', 'DESC');
        $this->db->limit('100');
        return $this->db->get('adeptos_main')->result();
    }


    public function get_adp($adp_id)
    {
        $this->db->where('id', $adp_id);
        return $this->db->get('adeptos_main')->row_array();
    }

    public function get_target($adp_id)
    {
        $this->db->where('id', $adp_id);
        return $this->db->get('alvos')->row_array();
    }

    
    public function update_adp($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('adeptos_main', $data);
    }

    public function update_adp_proportion_all($data)
    {
        $this->db->where('adp_active', 1);
        return $this->db->update('adeptos_main', $data);
    }
    

    public function get_adp_prospection_credentials()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('is_deleted', 0);

        return $this->db->get('alvos_credenciais')->result();
    }

    public function search_adp_prospection($query)
    {
        $this->db->like('adp_site', $query);

        $this->db->order_by('adp_active', 'DESC');
        $this->db->limit('100');
        return $this->db->get('adeptos_main')->result();
    }

    public function get_adp_data($helper_code)
    {
        $this->db->where('adp_active', 1);
        $this->db->where('adp_helper_code', $helper_code);
        $data = $this->db->get('adeptos_main')->row_array();

        if ($data) {
            return $data['adp_colligate'];
        } else {
            return false;
        }
    }

    public function get_adp_target() {
        $this->db->order_by('id', 'desc');
        $this->db->where('is_deleted', 0);
        $this->db->where('inapto', 0);

        return $this->db->get('alvos')->result();
    }

    public function get_adp_target_inapto() {
        $this->db->order_by('id', 'desc');
        $this->db->where('is_deleted', 0);
        $this->db->where('inapto', 1);
        return $this->db->get('alvos')->result();
    }

    public function search_adp_target($query) {
        $this->db->like('alvo_nome', $query);
        $this->db->where('is_deleted', 0);
        $this->db->where('inapto', 0);

        $this->db->order_by('id', 'desc');
        return $this->db->get('alvos')->result();
    }

}
