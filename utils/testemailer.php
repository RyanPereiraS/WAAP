<?php
    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');
    require_once('config.php');
    require_once('config.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $mail;
        $mail->Password = $pass;
        $mail->Port = 587;

        $mail->setFrom($mail);
        $mail->addAddress("$_POST[email]");

        $mail->isHTML(true);
        $mail->Subject = 'WAAP';
        $mail->Body="
        <div><div class='adM'>
        </div><table width='100%'>
            <tbody><tr>
                <td align='center'>
                    <table border='0' cellpadding='2' cellspacing='0' style='border:2px solid #ececec'>
                        <tbody><tr>
                            <td>
                                <table width='460' cellpadding='0' cellspacing='0' border='0'>
                                    <tbody><tr>
                                        <td bgcolor='#fff' align='middle' style='padding:10px 30px'>
                                            <div style='margin:7px 0px 7px 0px'>
                                                <a href='https://waap.com/' target='_blank'><img src='https://i.imgur.com/qWGv8I4.png' alt='Logotipo WAAP. Clique em ' ativar='' imagens'='' para='' ver='' logotipo'='' border='0' class='CToWUd'></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align='center' bgcolor='#ececec' style='padding:10px 30px'>
                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sens-serif;font-weight:300;color:#3e3e3e;font-size:1.3em;margin:8px 0px 8px 0px'>
                                                Bem-vindo ao <span class='il'>WAAP</span>!
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor='#ececec' style='padding:10px 30px'>
                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sens-serif;font-weight:300;color:#6b6b6b;margin:7px 0px 7px 0px;font-size:1.1em'>
                                                Confirme o seu endereço de e-mail para completar a sua inscrição.<br>
                                                Você se registrou com o nome:
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor='#ececec' style='padding:10px 30px'>
                                            <div>
                                                <table border='0' cellspacing='0' cellpadding='0'>
                                                    <tbody><tr>
                                                        <td width='110'>
                                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sens-serif;font-weight:300;color:#6b6b6b;font-size:1.1em;margin-right:12px;white-space:nowrap'>
                                                                <u></u>Nome de usuário:<u></u>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sens-serif;font-weight:300;font-size:1.1em;margin-right:12px'><b>$_POST[nome]</b></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='110'>
                                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sens-serif;font-weight:300;color:#6b6b6b;font-size:1.1em;margin-right:12px;white-space:nowrap'>
                                                                <u></u>E-mail:<u></u>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sens-serif;font-weight:300;color:#6b6b6b;font-size:1.1em'><a href='mailto:$_POST[email]' target='_blank'>$_POST[email]</a></div>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor='#ececec' align='center' style='padding:30px 30px 12px 30px'>
                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sans-serif'>
                                                <a style='display:inline-block;background-color:#37abc8;color:#ffffff;font-size:1.2em;font-weight:300;text-decoration:none;padding:13px 25px 13px 25px;border-radius:10px' href='http://$host:$port/waap_oficial/web3/cadastro/validar/index.php?token=$_POST[token]'>Confirme sua conta</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor='#ececec' style='padding:10px 30px'>
                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sens-serif;font-weight:300;color:#6b6b6b;margin:15px 0px 15px 0px;font-size:1.1em'><br>O serviço <span class='il'>WAAP</span> gratuito é o mais adequado para uso pessoal e de entidades. </div>
                                        </td>
                                    </tr>
                                    
                                    
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody></table><div class='yj6qo'></div><div class='adL'>
        </div></div>
        ";
        $mail->AltBody = 'Bem-Vindo ao WAAP';

        if($mail->send()) {
            echo 'Email enviado com sucesso';
        } else {
            echo 'Email nao enviado';
        }
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }

    
