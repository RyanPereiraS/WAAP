<?php
    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');
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
        $mail->Username = "$email";
        $mail->Password = "$pass";
        $mail->Port = 587;

        $mail->setFrom($mail);
        $mail->addAddress("$_POST[email]");

        $mail->isHTML(true);
        $mail->Subject = 'ONG Aprovada!';
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
                                                <a href='https://zello.com/' target='_blank'><img src='https://i.imgur.com/qWGv8I4.png' alt='Logotipo WAAP. Clique em ' ativar='' imagens'='' para='' ver='' logotipo'='' border='0' class='CToWUd'></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align='center' bgcolor='#ececec' style='padding:10px 30px'>
                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sens-serif;font-weight:300;color:#3e3e3e;font-size:1.3em;margin:8px 0px 8px 0px'>Equipe <span class='il'>WAAP</span>!
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor='#ececec' style='padding:10px 30px'>
                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sens-serif;font-weight:300;color:#6b6b6b;margin:7px 0px 7px 0px;font-size:1.1em'>
                                                Seja bem-vindo a equipe $_POST[nome], mal podemos esperar para trabalhar junto a você e sua ONG $_POST[ong] .<br>
                                                Assim que você fizer login novamente no site seu painel já estara disponivel esperando por você.
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        <td bgcolor='#ececec' style='padding:10px 30px'>
                                            <div style='font-family:Roboto,Tahoma,Arial,Helvetica,sens-serif;font-weight:300;color:#6b6b6b;margin:15px 0px 15px 0px;font-size:1.1em'><br>O serviço <span class='il'>WAAP</span> gratuito é o mais adequado para uso pessoal e profissional. </div>
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
        $mail->AltBody = 'Equipe WAAP';

        if($mail->send()) {
            echo 'Email enviado com sucesso';
        } else {
            echo 'Email nao enviado';
        }
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }

    
