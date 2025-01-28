CREATE DATABASE esquemadados;

DROP TABLE esquemadados.pessoa;

CREATE TABLE IF NOT EXISTS `esquemadados`.`Pessoa` (
  `idPessoa` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `idade` INT(2) NOT NULL,
  `profissao` VARCHAR(45) NOT NULL,
PRIMARY KEY (`idPessoa`));

INSERT INTO `esquemadados`.`Pessoa` (`nome`, `cpf`, `idade`, `profissao`) VALUES
('Ana Carolina Silva', '123.456.789-01', 28, 'Engenheira Civil'),
('Bruno Henrique Santos', '234.567.890-12', 35, 'Professor'),
('Carla Mendes Oliveira', '345.678.901-23', 42, 'Médica'),
('Daniel Rocha Costa', '456.789.012-34', 19, 'Estudante'),
('Eduarda Lima Ferreira', '567.890.123-45', 31, 'Advogada'),
('Fernando Souza Almeida', '678.901.234-56', 26, 'Programador'),
('Gabriela Ramos Pereira', '789.012.345-67', 38, 'Designer Gráfico'),
('Henrique Matos Silva', '890.123.456-78', 50, 'Empresário'),
('Isabela Castro Moura', '901.234.567-89', 24, 'Jornalista'),
('João Pedro Nascimento', '012.345.678-90', 22, 'Fotógrafo'),
('Larissa Gomes Andrade', '111.222.333-44', 29, 'Arquiteta'),
('Marcelo Vieira Barbosa', '222.333.444-55', 44, 'Contador'),
('Natália Almeida Brito', '333.444.555-66', 27, 'Enfermeira'),
('Otávio Augusto Reis', '444.555.666-77', 36, 'Analista de Sistemas'),
('Paula Cristina Duarte', '555.666.777-88', 32, 'Psicóloga');

SELECT * FROM Pessoa;

SHOW TABLE STATUS LIKE 'Pessoa';