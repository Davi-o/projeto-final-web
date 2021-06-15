<?php
require_once '../vendor/autoload.php';

use Controller\HandleRequest;

$handleRequest = new HandleRequest();
$person = null;
if (isset($_POST['id'])) {
    $person = $handleRequest->getOnePerson($_POST['id']);
}

$personData = [
    'name' => '',
    'surname' => '',
    'gender' => '',
    'type' => '',
    'document' => '',
    'birthdate' => '',
    'address' => '',
    'postalCode' => '',
    'addressNumber' => '',
    'complement' => '',
    'phoneNumber' => '',
    'id' => 0,
    'addressId' => 0,
    'phoneNumberId' => 0
];

if(isset($person)) {
    $personData['id'] = $person->getId();
    $personData['name'] = $person->getName();
    $personData['surname'] = $person->getSurname();
    $personData['gender'] = $person->getGender();
    $personData['type'] = $person->getType();
    $personData['document'] = $person->getDocument();
    $personData['birthdate'] = $person->getBirthDate();
    $personData['addressId'] = $person->getPersonAddress()->getId();
    $personData['address'] = $person->getPersonAddress()->getAddress();
    $personData['postalCode'] = $person->getPersonAddress()->getPostalCode();
    $personData['addressNumber'] = $person->getPersonAddress()->getNumber();
    $personData['complement'] = $person->getPersonAddress()->getComplement();
    $personData['phoneNumberId'] = $person->getContact()->getId();
    $personData['phoneNumber'] = $person->getContact()->getPhoneNumber();
}

$genderInput = "
    <select class='form-select' name='gender' id='gender'>
        <option >Escolha</option>
";
foreach (['Cis','Trans','NB'] as $gender) {
    if($personData['gender'] == $gender) {
        $genderInput .= "<option selected value=$gender>$gender</option>";
    } else {
        $genderInput .= "<option value=$gender>$gender</option>";
    }

}
$genderInput .= "
    </select>
";

$personTypeRadioButtons = "
    <div class='form-check-inline'>
        <div class='form-check'>
            <input class='form-check-input' type='radio' name='documentType1' id='cpf' value='option1' checked>
            <label class='form-check-label p-2' for='documentType1'>
                Fisica
            </label>
        </div>
        <div class='form-check'>
            <input class='form-check-input' type='radio' name='documentType2' id='cnpj' value='option2'>
            <label class='form-check-label p-2' for='documentType2'>
                Juridica
            </label>
        </div>
    </div>
";

if ($personData['type'] == "CNPJ") {
    $personTypeRadioButtons = "
        <div class='form-check-inline'>
            <div class='form-check'>
                <input class='form-check-input' type='radio' name='documentType1' id='cpf' value='CPF'>
                <label class='form-check-label p-2' for='documentType1'>
                    Fisica
                </label>
            </div>
            <div class='form-check'>
                <input class='form-check-input' type='radio' name='documentType2' id='cnpj' value='CNPJ' checked>
                <label class='form-check-label p-2' for='documentType2'>
                    Juridica
                </label>
            </div>
        </div>
    ";
}

$hiddenInputs = "
    <input type='hidden' name='id' value={$personData['id']}>
    <input type='hidden' name='addressId' value={$personData['addressId']}>
    <input type='hidden' name='phoneId' value={$personData['phoneNumberId']}>
";

echo "
<html>
    <head>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4' crossorigin='anonymous'></script>
        <script src='js/main.js'></script>
    </head>
    <body>
        <div class='container'>
            <form class='form-control' method='POST' action='handlePost.php'>
                {$hiddenInputs}
                  <div class='form-group col-xs-5'>
                    <div class='input-group'>
                        <div class='mb-3 m-auto'>
                            <label for='name' class='form-label'>Nome</label>
                            <input type='text' class='form-control' name='name' id='name' value='{$personData['name']}' required>
                        </div>
                        <div class='mb-3 m-auto'>
                            <label for='surname' class='form-label'>Sobrenome</label>
                            <input type='text' class='form-control' name='surname' id='surname' value='{$personData['surname']}' required>
                        </div>
                        <div class='m-auto p-3'>
                            <label for='gender' class='form-label'>Pessoa: </label>
                            {$genderInput}
                        </div>
                        <div class='form-group'>
                            <div class='mb-3 m-auto input-group'>
                                {$personTypeRadioButtons}
                            </div>
                            <div class='mb-3 m-auto'>
                                <label for='document' class='form-label'>Documento</label>
                                <input type='text' class='form-control' name='document' id='document' value='{$personData['document']}' required>
                            </div>
                        </div>
                        <div class='form-group row'>
                          <div class='col-10'>
                            <input class='form-control' name='birthdate' type='date' value='{$personData['birthdate']}' id='example-date-input'>
                          </div>
                        </div>
                        <div class='form-group mb-3 m-auto'>
                            <label for='postal' class='form-label'>CEP</label>
                            <input type='text' class='form-control' name='postal' id='postal' value={$personData['postalCode']}>
                        </div>
                        <div class='mb-3 m-auto'>
                            <label for='address' class='form-label'>Endereco</label>
                            <input type='text' class='form-control' name='address' id='address' value={$personData['address']}>
                        </div>
                        <div class='mb-3 m-auto'>
                            <label for='addressNumber' class='form-label'>Numero</label>
                            <input type='text' class='form-control' name='addressNumber' id='addressNumber' value={$personData['addressNumber']}>
                        </div>
                        <div class='mb-3 m-auto'>
                            <label for='complement' class='form-label'>Complemento</label>
                            <input type='text' class='form-control' name='complement' id='complement' value={$personData['complement']}>
                        </div>
                        <div class='mb-3 m-auto'>
                            <label for='phoneNumber' class='form-label'>Telefone</label>
                            <input type='text' class='form-control' name='phoneNumber' id='phoneNumber' value={$personData['phoneNumber']}>
                        </div>
                    </div>
                    <button type='submit' class='btn btn-primary m-3'>Submit</button>
                </div>
            </form>
        </div>
    </body>
</html>
";
