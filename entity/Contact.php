<?php
namespace Entity;

class Contact
{
    private int $id;
    private int $personId;
    private string $phoneNumber;

    public function __construct(
        int $personId,
        string $phoneNumber,
        ?int $id
    )
    {
        !$id ?: $this->id = $id;
        $this->personId = $personId;
        $this->phoneNumber = $phoneNumber;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPersonId(): int
    {
        return $this->personId;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }



}
