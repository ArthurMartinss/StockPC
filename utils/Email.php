<?php
class Email{	
	
	public static function enviar_email($destinatario, $assunto, $mensagem, $remetente="Equipe@stockpc.store"){
        $smtpHost = "smtp.hostinger.com";
        $smtpPort = 465;
        $smtpUser = "Equipe@stockpc.store"; 
        $smtpPassword = "!Equipe01"; 

        $headers = "From: $remetente\r\n";
        $headers .= "Reply-To: $remetente\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        return mail($destinatario, $assunto, $mensagem, $headers, "-f $remetente");
    }
}

?>