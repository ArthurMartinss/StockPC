<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $destinatario = "stockpc.cad@gmail.com";
    $assunto = isset($_POST["assunto"]) ? $_POST["assunto"] : "";
    $mensagem = isset($_POST["mensagem"]) ? $_POST["mensagem"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";

    $smtpHost = "smtp.gmail.com";
    $smtpPort = 587;
    $smtpUser = "stockpc.cad@gmail.com"; 
    $smtpPassword = "stockpc@cadastro1"; 

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $emailEnviado = mail($destinatario, $assunto, $mensagem, $headers, "-f $email");
}
?>

    
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="email">Endereço de E-mail:</label>
    <input type="text" id="email" name="email" style="color:black; border:1px solid #000;" required>

    <label for="assunto">Assunto:</label>
    <input type="text" id="assunto" name="assunto" style="color:black; border:1px solid #000;" required>

    <label for="mensagem">Mensagem:</label>
    <textarea id="mensagem" name="mensagem" rows="4" required></textarea>

    <input type="submit" value="Enviar">
</form>

<?php
if (isset($emailEnviado)) {
    if ($emailEnviado) {
        echo "<p id='success-message'>E-mail enviado com sucesso.</p>";
    } else {
        echo "<p id='error-message'>Ocorreu um erro ao enviar o e-mail.</p>";
    }
}
?>
    
    <script>
    
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            var errorMessage = document.getElementById('error-message');
            
            if (successMessage) {
                successMessage.style.display = 'none';
            }
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 4000); 
    </script>