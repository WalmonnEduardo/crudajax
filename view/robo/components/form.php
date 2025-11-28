<span id="confUrlBase" data-url-base="<?= URL_BASE ?>"></span>
<form action="../../controller/RoboController.php" method="post" class="bg-gray-700 h-[100%] w-full flex flex-col justify-center items-center">
    <div class="w-full px-5 flex items-center flex-col">
        <label for="nome" class="font-bold text-white">Nome:</label>
        <input type="text" name="nome" class="px-5 rounded-2xl w-3/4"
            value="<?= isset($_SESSION["nome"]) ? $_SESSION["nome"] : (isset($robo) ? $robo->getNome() : "") ?>">
    </div>
    <div class="w-full px-5 flex items-center flex-col">
        <label for="id_categoria" class="font-bold text-white">Categoria:</label>
        <select name="id_categoria" id="categoria" class="px-5 rounded-2xl w-3/4">
            <option value="0">Selecione</option>
            
        </select>
    </div>
    <div class="w-full px-5 flex items-center flex-col">
        <label for="id_equipe" class="font-bold text-white">Equipe:</label>
        <select name="id_equipe" id="equipe" class="px-5 rounded-2xl w-3/4">
            <option value="0">Selecione</option>
            
        </select>
    </div>
    <?php if((isset($robo) && $robo->getId() != null)&&(isset($_SESSION["id"]) && $robo->getId() != null)):?>
        <input type="hidden" name="id" class="px-5 rounded-2xl w-3/4" value="<?=isset($robo) ? $robo->getId() : ""?>"> 
    <?php endif;?>
    <input type="hidden" name="acao" value="<?=$acao?>">
    <button type="submit" class="mt-5 bg-green-800 px-4 py-2 rounded-2xl text-white">Enviar</button>
</form>
