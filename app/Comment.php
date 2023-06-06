<?php

namespace App;

class Comment
{
    private User $user;
    private string $message;

    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}