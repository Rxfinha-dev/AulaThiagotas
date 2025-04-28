<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Biblioteca - Cadastro de Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
  <div>
        <?php include VIEWS . '/Include/menu.php' ?>
        <h1>Lista de Alunos</h1>
        <a href="/aluno/cadastro">Novo Aluno</a>
        <?=$model->getErrors() ?>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Curso</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($model->rows as $aluno): ?>
                    <tr>
                        <td><?=$aluno->Id ?> </td>
                        <td><a href="/aluno/cadastro?id=<?=$aluno->Id?>">
                        <?=$aluno->Nome?> </a></td>
                        <td><?=$sluno->Curso?> </td>
                        <td> <a href="/aluno/delete?id=<?=$aluno->Id ?>">Remover</a></td>
                    </tr>
                    <?php endforeach?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>