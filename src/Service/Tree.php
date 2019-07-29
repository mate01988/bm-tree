<?php

namespace App\Service;


use App\Entity\User;
use App\Factory\UserFactory;


class Tree
{

    const MAX_LEVEL = 5;

    private static $level = 0;

    /**
     * @var UserFactory
     */
    private $userFactory;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }


    public function generateNode(string $name, ?User $parent = null, bool $isLeft = false): void
    {

        $user = $this->userFactory->create($name, $parent, $isLeft);

        if (self::$level >= self::MAX_LEVEL) {
            return;
        }

        $leftChild = filter_var((intval(rand(1, 10)) % 3 == 0), FILTER_VALIDATE_BOOLEAN);
        $rightChild = filter_var((intval(rand(1, 10)) % 2 == 0), FILTER_VALIDATE_BOOLEAN);

        if (true === $leftChild) {
            self::$level++;
            $this->generateNode($name . '.1', $user, true);
            self::$level--;
        }

        if (true === $rightChild) {
            self::$level++;
            $this->generateNode($name . '.2', $user, false);
            self::$level--;
        }


    }

    public function flatTree(array $users): array
    {

        $userParents = [];

        /**
         * @var $user User
         */
        foreach ($users as $user) {

            if ($user->getParent()) {
                $parentId = $user->getParent()->getId();

                if (!isset($userParents[$parentId])) {
                    $userParents[$parentId] = [];
                }
            } else {
                $parentId = 0;
            }

            $userParents[$parentId][$user->getId()] = $user;

        }

        return $userParents;
    }

}
