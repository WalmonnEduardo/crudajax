<?php
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
if((!isset($_POST["id"])) && (!isset($_SESSION["id"])))
{
    header("Location: listar.php");
}
$_POST["id"] = $_POST["id"] ?? $_SESSION["id"];


require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../controller/RoboController.php");

$robo = (new RoboController())->buscarId()[0];
$_SESSION["nomeAtual"] = $robo->getNome();
$acao="change";
$nomeTabela = "Robo";
$tabela = "robo";
$titulo = "Editar robô";
include(__DIR__."/../components/header.php");
?>
<span id="confUrlBase" data-url-base="<?= URL_BASE ?>"></span>
<span id="confCategoria" data-categoria="<?= $robo->getCategoria()->getId() ?>"></span>
<span id="confEquipe" data-equipe="<?= $robo->getEquipe()->getId() ?>"></span>
<div class="w-full h-[80dvh] flex justify-evenly">
    <div class="h-[100%] w-1/2">
        <?php
            include_once(__DIR__."/components/form.php")
        ?>
    </div>
    <?php if(isset($_SESSION["erros"])): ?>
        <div class="h-[100%] w-1/2 bg-red-900 text-white">
            <?php foreach($_SESSION["erros"] as $e)
                print $e."<br>";    
            ?>
        </div>
    <?php endif; ?>
    <script src="./js/script.js"></script>
</div>
<?php
$rolagem = "Edição de robôs";
include(__DIR__."/../components/footer.php");
?>