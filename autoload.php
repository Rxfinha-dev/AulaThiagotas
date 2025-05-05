<?php

spl_autoload_register(function ($nome_da_classe)
{
    $arquivo = BASE_DIR. "/" . $nome_da_clase. ".php";

    if(file_exists($arquivo)){
        include $arquivo;
    }else{
        throw new Exception("Arquivo não encontrado");
    }
});

?>