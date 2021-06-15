<?php
require_once '../vendor/autoload.php';

use Controller\HandleRequest;

$_POST['id'] = (int) htmlspecialchars(strip_tags($_POST['id']));

if (! (new HandleRequest())->deletePersonInfo($_POST['id']) ) {
    echo "
        <script>
            alert('Erro ao tentar excluir o contato, tente novamente!');
        </script>
    ";
}

header('location: ../index.php');