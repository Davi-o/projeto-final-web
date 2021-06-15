<?php
namespace Entity;

class Address
{
    private int $id;
    private int $personId;
    private string $postalCode;
    private string $address;
    private string $number;
    private string $complement;

    public function __construct(
        int $personId,
        string $postalCode,
        string $address,
        string $number,
        string $complement,
        ?int $id
    )
    {
        !$id ?: $this->id = $id;
        $this->personId = $personId;
        $this->postalCode = $postalCode;
        $this->address = $address;
        $this->number = $number;
        $this->complement = $complement;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPersonId(): int
    {
        return $this->personId;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getComplement(): string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): void
    {
        $this->complement = $complement;
    }



}
