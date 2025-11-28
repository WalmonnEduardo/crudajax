<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once (__DIR__."/../config/config.php");
require_once (__DIR__."/../model/Turma.php");
require_once (__DIR__."/../dao/TurmaDAO.php");
require_once (__DIR__."/../service/TurmaService.php");
require_once (__DIR__."/../dto/TurmaDTO.php");

class TurmaController
{
    private ?Turma $turma;
    private ?string $acao;
    private ?TurmaDAO $dao;
    private ?TurmaService $service;
    private ?TurmaDTO $dto;
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }

        $this->dto=new TurmaDTO();
        $this->turma=new Turma();
        $this->turma->setId(isset($_POST["id"]) ? trim($_POST["id"]) : null);
		$this->turma->setNome(isset($_POST["nome"]) ? trim($_POST["nome"]) : null);
        $this->dao=new TurmaDAO();
        if(isset($_POST["acao"]))
        {
            $this->service=new TurmaService($this->turma,$this->dao);
        }
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
            case "findId":$this->buscarId($this->turma);break;
            case "selectall":$this->buscarTodos();break;
            case "selectallSel":$this->buscarTodosJson();break;
        }    
    }
    function inserir()
    {
        $this->service->validar();
        if(!isset($_SESSION["erros"]))
        {
            unset($_SESSION["nome"]);
            $this->dao->cadastroTurma($this->turma);
        }
        else
        {
            $_SESSION["nome"] = $this->turma->getNome();
        }
        header("Location: ".URL_BASE."/view/turma/inserir.php");
        exit();
    }
    function excluir()
    {
        $this->dao->deleteTurma($this->turma);
        header("Location: ".URL_BASE."/view/turma/listar.php");
        exit();
    }
    function alterar()
    {
        $this->service->validar();
        if(!isset($_SESSION["erros"]))
        {
            unset($_SESSION["nome"]);
            $this->dao->updateTurma($this->turma);
            header("Location: ".URL_BASE."/view/turma/listar.php");
            exit();
        }
        else
        {
            $_SESSION["id"] = $this->turma->getId();
            $_SESSION["nome"] = $this->turma->getNome();
            header("Location: ".URL_BASE."/view/turma/editar.php");
            exit();
        }
    }
    function buscarId()
    {
        return $this->dao->selectTurma($this->turma);
        exit();
    }
    function buscarTodos()
    {	
        $turmas = $this->dao->selectAllTurma();
        $linhas = $this->dto->linhas($turmas);
        print $linhas;
        exit();
    }
    public function buscarTodosJson()
    {
        $turmas = $this->dao->selectAllTurma();
        $json = $this->dto->json($turmas);
        print $json;
    }
}
(new TurmaController());