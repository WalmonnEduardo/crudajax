<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once (__DIR__."/../model/Robo.php");
require_once (__DIR__."/../model/Categoria.php");
require_once (__DIR__."/../model/Equipe.php");
require_once (__DIR__."/../dao/RoboDAO.php");
require_once (__DIR__."/../dto/RoboDTO.php");
require_once (__DIR__."/../service/RoboService.php");
class RoboController
{
    private $robo;
    private $service;
    private $acao;
    private $dao;
    private $dto;
    public function __construct()
    {
        $this->dto=new RoboDTO();
        $this->robo=new Robo();
        $this->robo->setId(isset($_POST["id"]) ? trim($_POST["id"]) : null);
		$this->robo->setNome(isset($_POST["nome"]) ? trim($_POST["nome"]) : null);  
        $categoria = new Categoria();
        $categoria->setId(isset($_POST["id_categoria"]) ? trim($_POST["id_categoria"]) : null);
        $this->robo->setCategoria($categoria);
        $equipe = new Equipe();
        $equipe->setId(isset($_POST["id_equipe"]) ? trim($_POST["id_equipe"]) : null);
		$this->robo->setEquipe($equipe);
        
    
        $this->dao=new RoboDao();
        
        $this->acao= $_POST["acao"]??null;
        if($this->acao != null)
        {
            $this->service=new RoboService($this->robo,$this->dao);
        }
        $this->verificaAcao();
    }
    function verificaAcao()
    {
        switch($this->acao)
        {
            case "insert":$this->inserir(); break;
            case "delete":$this->excluir(); break;
            case "change":$this->alterar(); break;
            case "findId":$this->buscarId($this->robo);break;
            case "selectall":$this->buscarTodos();break;
            case "selectallSel":$this->buscarTodosJson();break;
        }    
    }
    function inserir()
    {
        $this->service->validar();
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
        if(!isset($_SESSION["erros"]))
        {
            unset($_SESSION["nome"]);
            unset($_SESSION["idEquipe"]);
            unset($_SESSION["idCategoria"]);
            $this->dao->cadastroRobo($this->robo);
        }
        else
        {
            $_SESSION["nome"] = $this->robo->getNome();
            $_SESSION["idEquipe"] = $this->robo->getEquipe()->getId();
            $_SESSION["idCategoria"] = $this->robo->getCategoria()->getId();
        }
        header("Location: ../view/robo/inserir.php");
        exit();
    }
    function excluir()
    {
    	$this->dao->deleteRobo($this->robo);
        header("Location: ../view/robo/listar.php");
    }
    function alterar()
    {
        $this->service->validar();
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
        if(!isset($_SESSION["erros"]))
        {
            $this->dao->updateRobo($this->robo);
            unset($_SESSION["nome"]);
            unset($_SESSION["id"]);
            unset($_SESSION["idCategoria"]);
            unset($_SESSION["nomeAtual"]);
            unset($_SESSION["idEquipe"]);
            header("Location: ../view/robo/listar.php");
            exit();
        }
        else
        {
            $_SESSION["id"] = $this->robo->getId();
            $_SESSION["nome"] = $this->robo->getNome();
            $_SESSION["idCategoria"] = $this->robo->getCategoria()->getId();
            $_SESSION["idEquipe"] = $this->robo->getEquipe()->getId();
            header("Location: ../view/robo/editar.php");
            exit();
        }
    }


    public function buscarId()
    {
        return $this->dao->selectRobo($this->robo);
        header("Location: ../view/robo/editar.php");
        exit();
    }
    public function buscarTodos()
    {
        $robos = $this->dao->selectAllRobo();
        $linhas = $this->dto->linhas($robos);
        print $linhas;
        
    }
    public function buscarTodosJson()
    {
        $robos = $this->dao->selectAllRoboEquipe($_POST["equipe"]);
        $json = $this->dto->json($robos);
        print $json;
    }
}
(new RoboController());