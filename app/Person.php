<?php

namespace app;

class Person
{
    private string $name;
    private string $surname;
    private string $personalNumber;
    private ?string $addInfo;

    public function __construct(string $name, string $surname, string $personalNumber, ?string $addInfo = null)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->personalNumber = $personalNumber;
        $this->addInfo = $addInfo;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getAddInfo(): ?string
    {
        return $this->addInfo;
    }


    public function getPersonalNumber(): string
    {
        return $this->personalNumber;
    }


    public function getSurname(): string
    {
        return $this->surname;
    }

    public function toArray(): array
    {
        return $person = [
            $this->getName(),
            $this->getSurname(),
            $this->getPersonalNumber(),
            $this->getAddInfo()
        ];

    }
}