<?php
class poc_model extends CI_Model
{
    
 
    
    public function add_wp_popular($data) {
        
        return $this->db->insert('adp_wp_assets_popular', $data);
        
    }

    public function check_wp_popular($name, $slug, $type) {
        
        $this->db->where('name', $name);
        $this->db->where('slug', $slug);
        $this->db->where('type',  $type);
        $this->db->where('is_deleted', 0);

        return $this->db->get('adp_wp_assets_popular')->row_array();
    }
    
    public function get_wp_populars() {
        
        $this->db->limit(1000);
        $this->db->where('is_deleted', 0);

        return $this->db->get('adp_wp_assets_popular')->result();
    }
    

    public function get_wp_scanner_by_site($adp_target) {
                $this->db->order_by('id', 'desc');

        $this->db->where('adp_target', $adp_target);
        $this->db->where('is_deleted', 0);

        return $this->db->get('adp_wp_assets_scanner')->result();
        
    }
    
    public function add_wp_scanner($data) {
        
        return $this->db->insert('adp_wp_assets_scanner', $data);
        
    }
    
    public function get_adeptos_for_scanner() {
                $this->db->where('alvo_elementor_status', 0);
        $this->db->where('is_deleted', 0);

                return $this->db->get('alvos')->result();

    }
    
        public function update_adeptos_for_scanner($alvo_url) {
                $this->db->where('alvo_url', $alvo_url);
                
                $data = array(
                    'alvo_elementor_status' => 1
                    );

                return $this->db->update('alvos', $data);

    }
        
    public function check_wp_scanner($adp_target, $wp_asset_slug, 	$wp_asset_type) {
        
        $this->db->where('adp_target', $adp_target);
        $this->db->where('wp_asset_slug', $wp_asset_slug);
        $this->db->where('wp_asset_type',  $wp_asset_type);
        $this->db->where('is_deleted', 0);

        return $this->db->get('adp_wp_assets_scanner')->row_array();
    }
    
    public function update_wp_scanner($wp_asset_slug, $wp_asset_version) {
         
        $this->db->where('wp_asset_slug', $wp_asset_slug);
         
        $data= array(
             'wp_asset_version' => $wp_asset_version,
             'wp_data' => date('Y-m-d H:i:s')
        );
             
        return $this->db->update('adp_wp_assets_scanner', $data);

        
    }
    
  
    
     public function get_pocs() {
        
                $this->db->order_by('id', 'desc');
    
        $this->db->where('is_deleted', 0);

        return $this->db->get('adp_wp_assets_poc')->result();
        
    }
    
       public function get_wp_poc_by_id($wp_id) {
        
        $this->db->where('id', $wp_id);
                $this->db->order_by('id', 'desc');


        return $this->db->get('adp_wp_assets_poc')->row_array();
        
    }
    
    public function get_wp_poc_by_site($wp_slug) {
        
        $this->db->where('wp_slug', $wp_slug);
        $this->db->where('is_deleted', 0);
                $this->db->order_by('id', 'desc');

        return $this->db->get('adp_wp_assets_poc')->result();
        
    }
     
    public function add_wp_poc($data) {
        
        return $this->db->insert('adp_wp_assets_poc', $data);
        
    }
        
    public function check_wp_poc($wp_slug, $wp_version) {
        
        $this->db->where('wp_slug', $wp_slug);
        $this->db->where('wp_version', $wp_version);
  
        $this->db->where('is_deleted', 0);

        return $this->db->get('adp_wp_assets_poc')->row_array();
    }
    
    public function update_wp_poc($wp_id, $wp_data) {
         
        $this->db->where('id', $wp_id);
         
     
             
        return $this->db->update('adp_wp_assets_poc', $wp_data);

        
    }
    
      public function delete_wp_poc($adp_id) {
         
        $this->db->where('id', $adp_id);
         
        $data= array(
             'is_deleted' => 1
             );
             
        return $this->db->update('adp_wp_assets_poc', $data);

        
    }
    




    
}