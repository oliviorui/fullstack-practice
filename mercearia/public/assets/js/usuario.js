$(document).ready(function() {
    $.validator.addMethod("somenteLetras", function(valor, elemento) {
        return this.optional(elemento) || /^[A-Za-zÀ-ÿ\s]+$/.test(valor);
    });

    $.validator.addMethod("emailValido", function(valor, elemento) {
        return this.optional(elemento) || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor);
    });

    $.validator.addMethod("senhaForte", function(valor, elemento) {
        return this.optional(elemento) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*^?&])[A-Za-z\d@#$!%*&?&]{8,}$/.test(valor);
    });
    

    // Validação do formulário de login
    $("#form-login").validate({
        rules: {
            username: {
                required: true,
                minlength: 5,
                somenteLetras: true
            },
            password: {
                required: true,
                minlength: 8,
                senhaForte: true
            }
        },
        messages: {
            username: {
                required: "Por favor, insira seu nome de usuário.",
                minlength: "O nome de usuário deve ter pelo menos 5 caracteres.",
                somenteLetras: "Digite apenas letras."
            },
            password: {
                required: "Por favor, insira sua senha.",
                minlength: "A senha deve ter pelo menos 8 caracteres.",
                senhaForte: "A senha deve conter maiúsculas, minúsculas, caracteres especiais e números."
            }
        }
    });

    // Validação do formulário de login
    $("#login").validate({
        rules: {
            email: {
                required: true,
                email: true,
                emailValido: true
            },
            senha: {
                required: true,
                minlength: 8,
                senhaForte: true
            }
        },
        messages: {
            email: {
                required: "Por favor, insira um e-mail válido.",
                email: "Por favor, insira um e-mail válido.",
                emailValido: "Insira um e-mail válido!"
            },
            senha: {
                required: "Por favor, insira sua senha.",
                minlength: "A senha deve ter pelo menos 8 caracteres.",
                senhaForte: "A senha deve conter maiúsculas, minúsculas, caracteres especiais, e números."
            }
        }
    });

    // Validação do formulário de cadastro de cliente
    $("#form-cadastro-cliente").validate({
        rules: {
            nome_cliente: {
                required: true,
                minlength: 3,
                somenteLetras: true
            },
            email_cliente: {
                required: true,
                emailValido: true
            },
            telefone_cliente: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            }
        },
        messages: {
            nome_cliente: {
                required: "Por favor, insira o nome do cliente.",
                minlength: "O nome do cliente deve ter pelo menos 3 caracteres.",
                somenteLetras: "Digite apenas letras."
            },
            email_cliente: {
                required: "Por favor, insira o e-mail do cliente.",
                emailValido: "Insira um e-mail válido."
            },
            telefone_cliente: {
                required: "Por favor, insira o telefone do cliente.",
                digits: "Por favor, insira um número de telefone válido.",
                minlength: "O telefone deve ter pelo menos 10 caracteres.",
                maxlength: "O telefone não pode ter mais de 15 caracteres."
            }
        }
    });

    // Validação do formulário de cadastro de produto
    $("#form-cadastro-produto").validate({
        rules: {
            nome_produto: {
                required: true,
                minlength: 3
            },
            preco_produto: {
                required: true,
                number: true,
                min: 0.01
            },
            quantidade_produto: {
                required: true,
                digits: true,
                min: 1
            }
        },
        messages: {
            nome_produto: {
                required: "Por favor, insira o nome do produto.",
                minlength: "O nome do produto deve ter pelo menos 3 caracteres."
            },
            preco_produto: {
                required: "Por favor, insira o preço do produto.",
                number: "O preço deve ser um número válido.",
                min: "O preço deve ser maior que 0."
            },
            quantidade_produto: {
                required: "Por favor, insira a quantidade do produto.",
                digits: "A quantidade deve ser um número inteiro.",
                min: "A quantidade deve ser maior que 0."
            }
        }
    });

    // Validação do gerenciamento de dados internos
    $("#form-gerenciamento-dados").validate({
        rules: {
            nome_empresa: {
                required: true,
                minlength: 3
            },
            email_empresa: {
                required: true,
                emailValido: true
            }
        },
        messages: {
            nome_empresa: {
                required: "Por favor, insira o nome da empresa.",
                minlength: "O nome da empresa deve ter pelo menos 3 caracteres."
            },
            email_empresa: {
                required: "Por favor, insira o e-mail da empresa.",
                emailValido: "Insira um e-mail válido."
            }
        }
    });
});