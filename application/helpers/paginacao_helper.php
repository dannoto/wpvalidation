<?php

function paginar($url, $contar, $limite) {

  $config['base_url'] = base_url().$url."";
  $config['total_rows'] = $contar;
  $config['per_page'] = $limite;
  $config['use_page_numbers'] = TRUE;
  $config['next_link'] = 'Próxima <span class="lnr lnr-arrow-right"></span>';
  $config['prev_link'] = '<span class="lnr lnr-arrow-left"></span> Anterior';
  $config['full_tag_open'] = '<ul class="uk-pagination uk-flex-center uk-margin-remove-bottom">';
  $config['full_tag_close'] = '</ul>';
  $config['num_tag_open'] = '<li>';
  $config['num_tag_close'] = '</li>';
  $config['cur_tag_open'] = '<li class="uk-active"><span>';
  $config['cur_tag_close'] = '</span></li>';
  $config['prev_tag_open'] = '<li>';
  $config['prev_tag_close'] = '</li>';
  $config['next_tag_open'] = '<li>';
  $config['next_tag_close'] = '</li>';
  $config['first_link'] = '<span class="lnr lnr-arrow-left"></span> Primeira Pagina';
  $config['last_link'] = 'Última Pagina <span class="lnr lnr-arrow-right"></span>';
  $config['first_tag_open'] = '<li>';
  $config['first_tag_close'] = '</li>';
  $config['last_tag_open'] = '<li>';
  $config['last_tag_close'] = '</li>';

  return $config;
}