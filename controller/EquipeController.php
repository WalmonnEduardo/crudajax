<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once (__DIR__."/../config/config.php");
require_once (__DIR__."/../model/Equipe.php");
require_once (__DIR__."/../dto/EquipeDTO.php");
require_once (__DIR__."/../dao/EquipeDAO.php");
require_once (__DIR__."/../service/EquipeService.php");
require_once (__DIR__."/../dto/EquipeDTO.php");
class EquipeController
{
    private $equipe;
    private $service;
    private $acao;
    private $dao;
    private $dto;
    public function __construct()
    {
        $this->dto=new EquipeDTO();
        $this->equipe=new Equipe();
        $this->equipe->setId(isset($_POST["id"]) ? trim($_POST["id"]) : null);
		$this->equipe->setNome(isset($_POST["nome"]) ? trim($_POST["nome"]) : null);
        $this->dao=new EquipeDao();
        $this->service = new EquipeService($this->equipe,$this->dao);
        $this->acao= isset($_POST["acao"]) ? $_POST["acao"] : null;
        if($this->acao != null)
        {
            $this->verificaAcao();
        }
    }
    function verificaAcao()
    {
        switch($this->acao)
        {
            case "insert":$this->inserir(); break;
            case "delete":$this->excluir(); break;
            case "change":$this->alterar(); break;
            case "findId":$this->buscarId($this->equipe);break;
            case "selectall":$this->buscarTodos();break;
            case "selectallSel":$this->buscarTodosJson();break;
            default : print "erro fatal";
        }    
    }
    function inserir()
    {
        $this->service->validar();
        if(!isset($_SESSION["erros"]))
        {
            unset($_SESSION["nome"]);
            $this->dao->cadastroEquipe($this->equipe);
        }
        else
        {
            $_SESSION["nome"] = $this->equipe->getNome();
        }
        header("Location: ".URL_BASE."/view/equipe/inserir.php");
        exit();
    }
    function excluir()
    {	
        $this->dao->deleteEquipe($this->equipe);
        header("Location: ".URL_BASE."/view/equipe/listar.php");
        exit();
    }
    function alterar()
    {
        $this->service->validar();
        if(!isset($_SESSION["erros"]))
        {
            unset($_SESSION["nome"]);
            $this->dao->updateEquipe($this->equipe);
            header("Location: ".URL_BASE."/view/equipe/listar.php");
            exit();
        }
        else
        {
            $_SESSION["id"] = $this->equipe->getId();
            $_SESSION["nome"] = $this->equipe->getNome();
            header("Location: ".URL_BASE."/view/equipe/editar.php");
            exit();
        }
    }
    function buscarId()
    {
        return $this->dao->selectEquipe($this->equipe);
        exit();
    }
    function buscarTodos()
    {
        $equipes =  $this->dao->selectAllEquipe();
        $html = $this->dto->linhas($equipes);
        print $html;
        exit();
    }
    function buscarTodosJson()
    {
        $equipes = $this->dao->selectAllEquipe();
        $json = $this->dto->json($equipes);
        print $json;
    }
}
(new EquipeController());