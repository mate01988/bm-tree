<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserFactory
{

    private $entityManager;

    private static $version = 1;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(string $name, ?User $parent = null, bool $isLeft = false): User
    {
        $user = new User();
        $user->setName($name);
        $user->setParent($parent);
        $user->setCreditsLeft(rand(10, 1000));
        $user->setCreditsRight(rand(10, 1000));
        $user->setIsLeft($isLeft);
        $user->setVersion(self::$version);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public static function setVersion(int $version): void
    {
        self::$version = $version;
    }

}
