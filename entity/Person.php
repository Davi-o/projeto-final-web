<?php
namespace Entity;

class Person
{
    private ?int $id = 0;
    private string $name;
    private string $surname;
    private string $gender;
    private string $type;
    private string $document;
    private string $birthDate;
    private Address $address;
    private Contact $contact;

    public function __construct(
        ?int $id,
        string $name,
        string $surname,
        string $gender,
        string $type,
        string $document,
        string $birthDate,
        ?Address $address,
        ?Contact $contact
    )
    {
        !$id ?: $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->gender = $gender;
        $this->type = $type;
        $this->document = $document;
        $this->birthDate = $birthDate;
        !$address ?: $this->address = $address;
        !$contact ?: $this->contact = $contact;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function getPersonAddress(): Address
    {
        return $this->address;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }
}
