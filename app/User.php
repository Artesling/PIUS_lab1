<?php

namespace App;

use DateTime;

class User
{
    private string $id;
    private string $name;
    private string $email;
    private string $password;
    private DateTime $createDate;

    public function __construct($id, $name, $email, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createDate = new DateTime('now');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreateDate(): string
    {
        return $this->createDate->format('Y-m-d H:i:s');
    }
}