<?php
require_once '../vendor/autoload.php';

use Model\PersonModel;
use Controller\HandleRequest;
use Entity\Contact;
use Entity\Address;
use Entity\Person;

foreach ($_POST as &$items) {
    $items = htmlspecialchars(strip_tags($items));
}

$personModel = new PersonModel();

$person = new Person(
    $_POST['id'],
    $_POST["name"],
    $_POST["surname"],
    $_POST["gender"],
    $_POST["documentType2"] ?: "CPF",
    $_POST["document"],
    $_POST["birthdate"],
    new Address(
        $_POST['id'],
        $_POST["postal"],
        $_POST["address"],
        $_POST["addressNumber"],
        $_POST["complement"],
        $_POST['addressId']
    ),
    new Contact(
        $_POST['id'],
        $_POST['phoneNumber'],
        $_POST['phoneId']
    )
);

if($person) {
    if (
        $person->getId()
        && (new HandleRequest())->updatePersonInfo($person)
    ) {
        header('location: ../index.php');
    } elseif((new HandleRequest())->insertNewPerson($person)) {
        header('location: ../index.php');
    } else {
        echo "
            <script>
                alert('Erro ao tentar adicionar contato, tente novamente');
                location.reload();
            </script>
        ";
    }
}
