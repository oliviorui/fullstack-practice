$(document).ready(function() {
    $.validator.addMethod("somenteLetras", function(valor, elemento) {
        return this.optional(elemento) || /^[A-Za-zÀ-ÿ\s]+$/.test(valor);
    });

    $.validator.addMethod("senhaForte", function(valor, elemento) {
        return this.optional(elemento) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/.test(valor);
    });

    // Validação do formulário de login
    $("#login").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            senha: {
                required: true,
                minlength: 8,
                maxlength: 12,
                senhaForte: true
            }
        },
        messages: {
            email: {
                required: "Por favor, insira um e-mail válido.",
                email: "Por favor, insira um e-mail válido.",
            },
            senha: {
                required: "Por favor, insira sua senha.",
                minlength: "A senha deve ter pelo menos 8 caracteres.",
                maxlength: "A senha não deve ter mais de 12 caracteres.",
                senhaForte: "A senha deve conter maiúsculas, minúsculas e números."
            }
        }
    });
    
    // Validação do formulário de cadastro
    $("#cadastro").validate({
        rules: {
            nome: {
                required: true,
                somenteLetras: true
            },
            email: {
                required: true,
                email: true
            },
            senha: {
                required: true,
                minlength: 6,
                maxlength: 12,
                senhaForte: true
            }
        },
        messages: {
            nome: {
                required: "Por favor, insira o seu nome.",
                somenteLetras: "Por favor, apenas letras!"
            },
            email: {
                required: "Por favor, insira um e-mail válido.",
                email: "Por favor, insira um e-mail válido.",
            },
            senha: {
                required: "Por favor, insira sua senha.",
                minlength: "A senha deve ter pelo menos 6 caracteres.",
                maxlength: "A senha não deve ter mais de 12 caracteres.",
                senhaForte: "A senha deve conter maiúsculas, minúsculas e números."
            }
        }
    });

    $("#novaNota").validate({
        rules: {
            disciplina: {
                required: true
            },
            nota: {
                required: true,
                min: 0,
                max: 20
            }
        },
        messages: {
            disciplina: {
                required: "Por favor, escolha a disciplina."
            },
            nota: {
                required: "Por favor, insira uma nota válida.",
                min: "Valor mínimo: 0",
                max: "Valor máximo: 20"
            }
        }
    });
});