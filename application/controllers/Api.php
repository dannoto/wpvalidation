<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('poc_model');
		$this->load->model('main_model');
	}

	public function add_popular()
	{
	    $data['name'] = htmlspecialchars($this->input->get('name'));
	    $data['slug'] = htmlspecialchars($this->input->get('slug'));
	    $data['type'] = htmlspecialchars($this->input->get('type'));
	    $data['is_deleted'] = 0;
	    
	    if ($this->poc_model->check_wp_popular($data['name'], $data['slug'], $data['type'])) {
	        
	        echo "Ja existe: ".$data['slug'];
	        
	    } else {
	        $this->poc_model->add_wp_popular($data);
	        
	        echo "Adicionado: ".$data['slug'];

	    }
	    
	 
	}
	
	public function get_adeptos_for_scanner()
	{
	    
	    print_r(json_encode($this->poc_model->get_adeptos_for_scanner()));
	   //return json_encode($this->poc_model->get_adeptos_for_scanner());
	   
	}
	
		public function get_wp_populars()
	{
	    
	    print_r(json_encode($this->poc_model->get_wp_populars()));
	   //return json_encode($this->poc_model->get_wp_populars());
	   
	}
	
	
	public function add_scanner()
	{
	    $data['adp_target'] = htmlspecialchars($this->input->get('adp_target'));
	    $data['wp_asset_slug'] = htmlspecialchars($this->input->get('wp_asset_slug'));
	    $data['wp_asset_version'] = htmlspecialchars($this->input->get('wp_asset_version'));

	    $data['wp_asset_type'] = htmlspecialchars($this->input->get('wp_asset_type'));
	    $data['wp_data'] = date('Y-m-d H:i:s') ;
	    $data['wp_owned'] = 0;
	    $data['is_deleted'] = 0;
	    
	    if ($this->poc_model->check_wp_scanner($data['adp_target'], $data['wp_asset_slug'], $data['wp_asset_type'])) {
	        
	        
	        $this->poc_model->update_wp_scanner($data['wp_asset_slug'], $data['wp_asset_version']);

	        
	        echo "Ja existe: ".$data['wp_asset_slug'];
	        
	    } else {
	        
	        $this->poc_model->add_wp_scanner($data);
	        
	        echo "Adicionado: ".$data['wp_asset_slug'];
	        
	        $this->poc_model->update_adeptos_for_scanner($data['adp_target']);

	    }

	}
	
	public function get_plugins() {
    // get popular plugins from wordpress api

    
        $slugs = array();
        $page = 1;

        while ( count( $slugs ) < 10000 ) {
        	$plugins = $this->plugin_api( $page++ );
        
        	foreach ( $plugins->plugins as $plugin ) {
        		$slugs[] = $plugin->slug;
        		
        		   if ($this->poc_model->check_wp_popular($plugin->slug, $plugin->slug, "plugin")) {
	        
            	        echo "Ja existe: ".$plugin->slug."<br>";
            	        
            	    } else {
            	        
            	        $data['name'] = $plugin->slug;
                	    $data['slug'] = $plugin->slug;
                	    $data['type'] = "plugin";
                	    $data['is_deleted'] = 0;
	    
            	        $this->poc_model->add_wp_popular($data);
            	        
            	        echo "Adicionado: ".$plugin->slug."<br>";
            
            	    }
        	}
        }
                
        // file_put_contents( 'popular-plugins.txt', implode( "\n", $slugs ) );
        // print_r($slugs);
        
      
	}
	
	function plugin_api( $page = 1 ) {
        
        	$context = stream_context_create( array(
        		'http' => array(
        			'method'  => 'POST',
        			'content' => http_build_query( array(
        				'action' => 'query_plugins',
        				'request' => array(
        					'browse' => 'popular',
        					'page' => $page,
        					'per_page' => 100,
        				)
        			) )
        		)
        	) );
        
        	return json_decode( file_get_contents( 'https://api.wordpress.org/plugins/info/1.1/', false, $context ) );
        }

  
}
