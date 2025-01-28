<?php

include_once 'src/config/Database.php';
include_once 'src/entities/pessoa/entity/Pessoa.php';

class PessoaController {
    private $pessoa;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->pessoa = new Pessoa($db);
    }

    public function handleRequest() {
        $uri = explode('/', trim($_SERVER['REQUEST_URI'], '/')); // Divide a URI
        $resource = explode('?', $uri[count($uri) - 1]); // Pega o último recurso da URI
        $method = $_SERVER['REQUEST_METHOD'];
        $input = json_decode(file_get_contents('php://input'), true);
        $idPessoa = $_GET['id'] ?? null; // Captura o ID se passado na query string

        if ($resource[0] === 'pessoas' && $method === 'GET') {
            // Lista todas as pessoas
            $stmt = $this->pessoa->getAll();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);

        } elseif ($resource[0] === 'pessoa') {
            switch ($method) {
                case 'GET':
                    if ($idPessoa) {
                        // Busca uma pessoa específica
                        $stmt = $this->pessoa->getById($idPessoa);
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($row) {
                            echo json_encode($row);
                        } else {
                            echo json_encode(['message' => 'Pessoa não encontrada']);
                        }
                    } else {
                        echo json_encode(['message' => 'ID não fornecido em GET']);
                    }
                    break;

                case 'POST':
                    $this->pessoa->nome = $input['nome'];
                    $this->pessoa->cpf = $input['cpf'];
                    $this->pessoa->idade = $input['idade'];
                    $this->pessoa->profissao = $input['profissao'];

                    if ($this->pessoa->create()) {
                        echo json_encode(['message' => 'Pessoa criada com sucesso']);
                    } else {
                        echo json_encode(['message' => 'Erro ao criar pessoa']);
                    }
                    break;

                case 'PUT':
                    if ($idPessoa) {
                        $this->pessoa->idPessoa = $idPessoa;
                        $this->pessoa->nome = $input['nome'];
                        $this->pessoa->cpf = $input['cpf'];
                        $this->pessoa->idade = $input['idade'];
                        $this->pessoa->profissao = $input['profissao'];

                        if ($this->pessoa->update()) {
                            echo json_encode(['message' => 'Pessoa atualizada com sucesso']);
                        } else {
                            echo json_encode(['message' => 'Erro ao atualizar pessoa']);
                        }
                    } else {
                        echo json_encode(['message' => 'ID não fornecido']);
                    }
                    break;

                case 'DELETE':
                    if ($idPessoa) {
                        $this->pessoa->idPessoa = $idPessoa;

                        if ($this->pessoa->delete()) {
                            echo json_encode(['message' => 'Pessoa deletada com sucesso']);
                        } else {
                            echo json_encode(['message' => 'Erro ao deletar pessoa']);
                        }
                    } else {
                        echo json_encode(['message' => 'ID não fornecido']);
                    }
                    break;

                default:
                    echo json_encode(['message' => 'Método não suportado']);
                    break;
            }
        } else {
            echo json_encode(['message' => 'Recurso não encontrado | ID='.$idPessoa.' - '.$resource]);
        }
    }
}