<?php

require_once __DIR__ . '/bootstrap.php';

use App\Entities\User;

$userRepository = $entityManager->getRepository(User::class);
$userFromDataBase = $userRepository->getUser(8516);

echo 'Привет, я польльзователь ' . $userFromDataBase->getUsername() . ' c id ' . $userFromDataBase->getId() . "\n";


$randomUserFromDataBase = $userRepository->getUser(rand(1, 1000));

if (empty($randomUserFromDataBase)) {
    echo 'Пользователь не найден!' . "\n";
} else {
    echo 'Привет, я польльзователь ' . $randomUserFromDataBase->getUsername() . "\n";
}


