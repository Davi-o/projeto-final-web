<?php

namespace Model;


use Database\Connection;
use Entity\Address;
use Entity\Contact;
use Entity\Person;
use Enum\Queries;

class PersonModel
{

    private Connection $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function deletePerson(string $id): bool
    {
        $this->deleteAddress($id);
        $this->deleteContact($id);

        $statement = $this->connection->prepare(Queries::DELETE_PERSON);
        $statement->bindValue(':id',$id);

        return $statement->execute();
    }

    public function deleteAddress(int $personId): bool
    {
        $statement = $this->connection->prepare(Queries::DELETE_ADDRESS);

        $statement->bindValue(':id', $personId);

        return $statement->execute();
    }

    public function deleteContact(int $personId): bool
    {
        $statement = $this->connection->prepare(Queries::DELETE_CONTACT);

        $statement->bindValue(':id', $personId);

        return $statement->execute();
    }

    public function update(Person $person): bool
    {
        $statement = $this->connection->prepare(Queries::UPDATE_PERSON);

        $statement->bindValue(':name', $person->getName());
        $statement->bindValue(':surname', $person->getSurname());
        $statement->bindValue(':gender', $person->getGender());
        $statement->bindValue(':type', $person->getType());
        $statement->bindValue(':document',$person->getDocument());
        $statement->bindValue(':birthdate',$person->getBirthDate());
        $statement->bindValue(':id',$person->getId());

        if ($statement->execute()) {
            return $this->updateAddress($person) && $this->updateContact($person);
        }

        return false;
    }

    private function updateAddress(Person $person): bool
    {
        $statement = $this->connection->prepare(Queries::UPDATE_ADDRESS);

        $statement->bindValue(':postal_code', $person->getPersonAddress()->getPostalCode());
        $statement->bindValue(':address', $person->getPersonAddress()->getAddress());
        $statement->bindValue(':number', $person->getPersonAddress()->getNumber());
        $statement->bindValue(':complement', $person->getPersonAddress()->getComplement());
        $statement->bindValue(':id', $person->getPersonAddress()->getId());

        return $statement->execute();
    }

    private function updateContact(Person $person): bool
    {
        $statement = $this->connection->prepare(Queries::UPDATE_CONTACT);

        $statement->bindValue(':phone_number', $person->getContact()->getPhoneNumber());
        $statement->bindValue(':id', $person->getContact()->getId());

        return $statement->execute();
    }

    public function insertNewPerson(Person $person): bool
    {
        $statement = $this->connection->prepare(Queries::INSERT_INTO_PERSON);

        $statement->bindValue(':name', $person->getName());
        $statement->bindValue(':surname', $person->getSurname());
        $statement->bindValue(':gender', $person->getGender());
        $statement->bindValue(':type', $person->getType());
        $statement->bindValue(':document', $person->getDocument());
        $statement->bindValue(':birthdate', $person->getBirthDate());

        if ($statement->execute()) {
            return $this->insertNewAddress($person, $this->connection->lastInsertId())
                   && $this->insertNewContact($person, $this->connection->lastInsertId());
        }

        return false;
    }

    private function insertNewAddress(Person $person, string $personId): bool
    {
        $statement = $this->connection->prepare(Queries::INSERT_INTO_ADDRESS);

        $statement->bindValue(':person_id', $personId);
        $statement->bindValue(':postal_code', $person->getPersonAddress()->getPostalCode());
        $statement->bindValue(':address', $person->getPersonAddress()->getAddress());
        $statement->bindValue(':number', $person->getPersonAddress()->getNumber());
        $statement->bindValue(':complement', $person->getPersonAddress()->getComplement());

        return $statement->execute();
    }

    private function insertNewContact(Person $person, string $personId): bool
    {
        $statement = $this->connection->prepare(Queries::INSERT_INTO_CONTACT);

        $statement->bindValue(':person_id', $personId);
        $statement->bindValue(':phone_number', $person->getContact()->getPhoneNumber());

        return $statement->execute();
    }

    public function getOnePerson(int $personId): Person
    {
        $statement = $this->connection->prepare(Queries::SELECT_ONE);
        $statement->bindValue(":id", $personId);
        $statement->execute();

        $fetch = $statement->fetch();

        $contact = new Contact(
            $fetch['personId'],
            $fetch['phoneNumber'],
            $fetch['phoneNumberId']
        );

        $address = new Address(
            $fetch['personId'],
            $fetch['postalCode'],
            $fetch['address'],
            $fetch['addressNumber'],
            $fetch['complement'],
            $fetch['addressId']
        );

        return new Person(
            $fetch['personId'],
            $fetch['personName'],
            $fetch['personSurname'],
            $fetch['gender'],
            $fetch['type'],
            $fetch['document'],
            $fetch['birthdate'],
            $address,
            $contact
        );
    }

    public function getAllPersons(): ?array
    {
        $statement = $this->connection->prepare(Queries::SELECT_ALL);
        $statement->execute();
        $response = [];
        while ($fetch = $statement->fetch()) {
            $contact = new Contact(
                $fetch['personId'],
                $fetch['phoneNumber'],
                $fetch['phoneNumberId']
            );

            $address = new Address(
                $fetch['personId'],
                $fetch['postalCode'],
                $fetch['address'],
                $fetch['addressNumber'],
                $fetch['complement'],
                $fetch['addressId']
            );

            $response[] = new Person(
                $fetch['personId'],
                $fetch['personName'],
                $fetch['personSurname'],
                $fetch['gender'],
                $fetch['document'],
                $fetch['type'],
                $fetch['birthdate'],
                $address,
                $contact
            );
        }

        return $response ?? null;
    }

}
