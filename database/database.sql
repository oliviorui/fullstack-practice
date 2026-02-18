CREATE DATABASE sistema_academico;
USE sistema_academico;

-- =========================
-- TABELA DE USUÁRIOS
-- =========================
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('usuario', 'admin') DEFAULT 'usuario',
    data_cadastro DATE,

    PRIMARY KEY (id_usuario)
);

-- =========================
-- TABELA DE DISCIPLINAS
-- =========================
CREATE TABLE disciplinas (
    id_disciplina INT AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    codigo VARCHAR(5) NOT NULL,
    descricao TEXT,
    
    PRIMARY KEY (id_disciplina)
);

-- =========================
-- TABELA DE NOTAS
-- =========================
CREATE TABLE notas (
    id_nota INT AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_disciplina INT NOT NULL,
    nota DECIMAL(4,2),
    data_avaliacao DATE,
    tipo_avaliacao ENUM('Prova', 'Trabalho', 'Exame'),
    
    PRIMARY KEY (id_nota),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_disciplina) REFERENCES disciplinas(id_disciplina) ON DELETE CASCADE
);

-- =========================
-- TABELA DE LOGS
-- =========================
CREATE TABLE logs_atividades (
    id_log INT AUTO_INCREMENT,
    id_usuario INT,
    data_hora DATETIME,
    descricao TEXT,
    tipo_actividade ENUM('Login', 'Logout', 'Cadastro', 'Registro', 'Admin'),

    PRIMARY KEY (id_log),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE SET NULL
);

-- =========================
-- DISCIPLINAS PADRÃO
-- =========================
INSERT INTO disciplinas (nome, codigo, descricao) VALUES
('Algoritmos e Estruturas de Dados', 'AED01', 'Estudo de algoritmos, estruturas de dados e complexidade computacional.'),
('Base de Dados', 'BD02', 'Modelagem, normalização e implementação de bancos de dados relacionais.'),
('Programação Orientada a Objetos', 'POO03', 'Conceitos de programação orientada a objetos usando linguagens como Java e Python.'),
('Redes de Computadores', 'RC04', 'Fundamentos de redes, protocolos, segurança e administração de redes.'),
('Engenharia de Software', 'ES05', 'Processos de desenvolvimento de software, metodologias ágeis e boas práticas.'),
('Sistemas Operacionais', 'SO06', 'Princípios de sistemas operacionais, gerenciamento de memória, processos e arquivos.'),
('Desenvolvimento Web', 'DW07', 'Criação de aplicações web usando HTML, CSS, JavaScript e frameworks.'),
('Segurança da Informação', 'SI08', 'Conceitos de segurança, criptografia, ataques cibernéticos e proteção de dados.'),
('Ética e Legislação em TI', 'EL13', 'Aspectos éticos e legais relacionados ao uso da tecnologia da informação.'),
('Gestão de Projetos de TI', 'GP14', 'Metodologias para planejamento, execução e monitoramento de projetos de tecnologia.');

-- =========================
-- USUÁRIO ADMIN PADRÃO
-- senha: admin123  (já criptografada)
-- =========================
INSERT INTO usuarios (nome, email, senha, tipo, data_cadastro) VALUES
('Administrador', 'admin@sistema.com', '$2y$10$TwQm5ZRkaoA8Z7Q3NMMb/u/8tGN4nHylBTdgrRUc/UO8.UFHe5StK', 'admin', CURDATE());

DROP DATABASE sistema_academico;