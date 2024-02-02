<?php


require_once __DIR__ . '/bootstrap.php';

use App\Entities\User;

$userRepository = $entityManager->getRepository(User::class);

$res = $userRepository->activateUser(7490);
if ($res) {
    echo "Юзер активирован!\n";
} else {
    echo "Не вышло, юзер активен!\n";
}