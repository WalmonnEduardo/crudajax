<?php
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
unset($_SESSION["erros"]);
unset($_SESSION["nome"]);
unset($_SESSION["id"]);
require_once(__DIR__."/../../config/config.php");

$nomeTabela = "Robô";
$tabela = "robo";
$titulo = "Listar robôs";
include(__DIR__."/../components/header.php");
?>
<span id="confUrlBase" data-url-base="<?= URL_BASE ?>"></span>

<div class="w-full h-[80dvh]">
    <table class="w-full">
        
    </table>
    <script src="./js/script.js"></script>
</div>
<?php
$rolagem = "Listagem de robôs";
include(__DIR__."/../components/footer.php");
?>