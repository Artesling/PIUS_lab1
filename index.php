<?php

require 'vendor/autoload.php';

use App\Comment;
use App\User;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

function createForm(User $user): array
{
    return [
        'id' => $user->getId(),
        'name' => $user->getName(),
        'email' => $user->getEmail(),
        'password' => $user->getPassword()
    ];
}

function validation($validator, $constraint, User $user): void
{
    $form = createForm($user);

    $violations = $validator->validate($form, $constraint);

    if (count($violations) > 0)
        foreach ($violations as $error)
            echo "{$error->getPropertyPath()}: {$error->getMessage()}" . PHP_EOL;
    else
        echo "Successful" . PHP_EOL;
}

// task 1

$users = [
    new User('', 'Artem', 'artesling754@gmail.com', '1337asdzxc'),
    new User('1', '', 'artesling754@gmail.com', '1337asdzxc'),
    new User('1', 'Artem', '@gmail.com', '1337asdzxc'),
    new User('1', 'Artem', 'artesling754@gmail.com', '@asdSobaka123'),
    new User('1', 'Artem', 'artesling754@gmail.com', '1337asdzxc')
];

$validator = Validation::createValidator();

$constraint = new Collection([
    'id' => [
        new NotBlank()
    ],
    'name' => [
        new NotBlank()
    ],
    'email' => [
        new Email(['message' => 'The mail {{ value }} is not a valid email.'])
    ],
    'password' => [
        new NotBlank(),
        new Length(['min' => 8])
    ],
]);

for ($i = 0; $i < count($users); $i++) {
    echo "Validation of the user #$i:" . PHP_EOL;

    validation($validator, $constraint, $users[$i]);

    if ($i != count($users) - 1)
        echo PHP_EOL;
}

// task 2

$comments = [
    new Comment(
        new User('1', 'Artem', 'artesling754@gmail.com', '1337asdzxc'),
        'Hi everyone!'
    ),
    new Comment(
        new User('2', 'Gleb', 'Gleb@sxope.com', '@Test123'),
        'Where I am?'
    )
];

$insertTime = readline("Insert time: ");

foreach ($comments as $comment) {
    if ($comment->getUser()->getCreateDate() > $insertTime)
        echo "{$comment->getUser()->getName()}: {$comment->getMessage()}" . PHP_EOL;
}