<?php
function criptografar_senha($senha) {
    return password_hash($senha, PASSWORD_DEFAULT);
}
?>
