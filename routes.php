<?php
     use AulaThiagotas\Controller\{
        AlunoController,
        InicialController,
        LoginController,
        AutorController,
        CategoriaController,
        LivroController,
        EmprestimoController
    };

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch($url)
    {
        case '/':
            InicialController::index();
            break; // Corrigido

        /**
         * Rotas para o login
         */
        case '/login':
            LoginController::index();
            break;
        
        case '/logout': // Corrigido
            LoginController::logout();
            break;

        /**
         * Rotas para alunos
         */
        case '/aluno':
            AlunoController::index();
            break;

        case '/aluno/cadastro':
            AlunoController::cadastro();
            break;
        
        case '/aluno/delete':
            AlunoController::delete();
            break;

        /**
         * Rotas para os autores
         */
        case '/autor':
            AutorController::index();
            break;

        case '/autor/cadastro':
            AutorController::cadastro();
            break;
        
        case '/autor/delete':
            AutorController::delete();
            break;

        /**
         * Rotas para categorias
         */
        case '/categoria':
            CategoriaController::index();
            break;
            
        case '/categoria/cadastro':
            CategoriaController::cadastro();
            break;

        case '/categoria/delete': // Corrigido
            CategoriaController::delete();
            break;

        /**
         * Rotas para livros
         */
        case '/livro':
            LivroController::index();
            break;
        
        case '/livro/cadastro':
            LivroController::cadastro();
            break;

        case '/livro/delete':
            LivroController::delete();
            break;

        /**
         * Rotas para empréstimo
         */
        case '/emprestimo':
            EmprestimoController::index();
            break;

        case '/emprestimo/cadastro':
            EmprestimoController::cadastro();
            break;

        case '/emprestimo/delete':
            EmprestimoController::delete();
            break;

        /**
         * Rota padrão (404 - Não encontrado)
         */
        default:
            http_response_code(404);
            echo "Página não encontrada.";
            break;
    }
?>
