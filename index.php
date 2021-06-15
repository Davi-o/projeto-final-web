<?php
require_once "vendor/autoload.php";

use Controller\HandleRequest;

$handleRequest = new HandleRequest();

$contactsTable = "";
foreach ($handleRequest->getAllPersons() as $person) {
    echo "
        <form
            action='view/form.php' 
            method='post' 
            id='editContact-{$person->getId()}'
        ></form>
    ";

    echo "
        <form
            action='view/delete.php' 
            method='post' 
            id='deleteContact-{$person->getId()}'
        ></form>
    ";

    $hidden = "
        <input 
            name='id' 
            type='hidden' 
            form='editContact-{$person->getId()}'
            value='{$person->getId()}' 
        />
        <input 
            name='id' 
            type='hidden' 
            form='deleteContact-{$person->getId()}'
            value='{$person->getId()}' 
        />
    ";

    $contactsTable .= "
        <tr>
            <th scope='row'>{$person->getId()}</th>
            {$hidden}
            <td>{$person->getName()}</td>
            <td>{$person->getContact()->getPhoneNumber()}</td>
            <td>{$person->getBirthdate()}</td>
            <td>
                <button type='submit' form='editContact-{$person->getId()}' class='btn btn-info'>Editar</button>
                <button type='submit' form='deleteContact-{$person->getId()}' class='btn btn-danger'>Apagar</button>
            </td>
        </tr>
    ";
}

echo
"<html>
    <header>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4' crossorigin='anonymous'></script>
        <script src='view/js/main.js'></script>
    </header>
    <body>
        <div class='container'>
            <form
                action='view/form.php'
                method='post'
                id='new-contact'
            ></form>
            <table class='table table-striped table-bordered'>
              <tr>
                <th scope='col'>Id</th>
                <th scope='col'>Nome</th>
                <th scope='col'>Telefone</th>
                <th scope='col'>Nascimento</th>
                <th scope='col'>                    
                    <button
                        type='submit'
                        form='new-contact'
                        class='btn bg-info text-white'  
                    > Adicionar um novo contato <i class='fa fa-plus'></i>
                    </button>
                </th>
              </tr>
              {$contactsTable}
            </table>
        </div>
    </body>
</html>";
