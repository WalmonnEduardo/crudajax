<?php
require_once(__DIR__."/../../config/config.php");
$nomeTabela = "Turma";
$tabela = "turma";
$titulo = "Listar turmas";

unset($_SESSION["erros"]);
unset($_SESSION["nome"]);
unset($_SESSION["id"]);

include(__DIR__."/../components/header.php");
?>
<span id="confUrlBase" data-url-base="<?= URL_BASE ?>"></span>
<div class="w-full h-[80dvh]">
    <table class="w-full">
        
    </table>
    <script src="./js/script.js"></script>
</div>
<?php
$rolagem = "Listagem de turmas";
include(__DIR__."/../components/footer.php");
?>