<?php
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
unset($_SESSION["nome"]);
unset($_SESSION["nomeAtual"]);
unset($_SESSION["idEquipe"]);
unset($_SESSION["idTurma"]);
unset($_SESSION["idRobo"]);
unset($_SESSION["data"]);
require_once(__DIR__."/../../config/config.php");
$nomeTabela = "Estudante";
$tabela = "estudante";
$titulo = "Listar Estudantes";
include(__DIR__."/../components/header.php");
?>
<span id="confUrlBase" data-url-base="<?= URL_BASE ?>"></span>
<div class="w-full h-[80dvh]">
    <table class="w-full">
    </table>
    <script src="./js/script.js"></script>
</div>
<?php
$rolagem = "Listagem de estudantes";
include(__DIR__."/../components/footer.php");
?>