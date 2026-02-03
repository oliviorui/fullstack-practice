create database sistema_academico;

use sistema_academico;

create table usuarios (
    id_usuario int auto_increment,
    nome varchar(50),
    email varchar(50) unique,
    senha varchar(255),
    data_cadastro date,

    primary key (id_usuario)
);

create table disciplinas (
    id_disciplina int auto_increment,
    nome varchar(50),
    codigo varchar(5),
    descricao text,
    
    primary key (id_disciplina)
);

create table notas (
    id_nota int auto_increment,
    id_usuario int,
    id_disciplina int,
    nota decimal(4, 2),
    data_avaliacao date,
    tipo_avaliacao enum('Prova', 'Trabalho', 'Exame'),
    
    primary key (id_nota),
    foreign key (id_usuario) references usuarios(id_usuario),
    foreign key (id_disciplina) references disciplinas(id_disciplina)
);

create table logs_atividades (
    id_log int auto_increment,
    id_usuario int,
    data_hora datetime,
    descricao text,
    tipo_actividade enum('Login', 'Logout', 'Cadastro', 'Registro'),

    primary key (id_log),
    foreign key (id_usuario) references usuarios(id_usuario)
);

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


drop database sistema_academico;