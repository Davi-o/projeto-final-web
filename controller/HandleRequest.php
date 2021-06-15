<?php

namespace Controller;

use Entity\Person;
use Model\PersonModel;

class HandleRequest
{
    private PersonModel $personModel;

    public function __construct()
    {
        $this->personModel = new PersonModel();
    }

    public function getAllPersons(): array
    {
        return $this->personModel->getAllPersons();
    }

    public function getOnePerson(int $personId): Person
    {
        return $this->personModel->getOnePerson($personId);
    }

    public function deletePersonInfo(int $personId): bool
    {
        return $this->personModel->deletePerson($personId);
    }

    public function updatePersonInfo(Person $person): bool
    {
       return $this->personModel->update($person);
    }

    public function insertNewPerson(Person $person): bool
    {
        return $this->personModel->insertNewPerson($person);
    }
}
