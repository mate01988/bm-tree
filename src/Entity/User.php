<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="users", indexes={
 *     @ORM\Index(name="idx_is_left", columns={"is_left"}),
 *     @ORM\Index(name="idx_version", columns={"version"}),
 * })
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User[]
     * @ORM\OneToMany(targetEntity="User", mappedBy="parent")
     */
    private $children;

    /**
     * @var null|User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $creditsLeft = 0;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $creditsRight = 0;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $isLeft = 0;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $version = 0;

    /**
     * User constructor.
     *
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param User[] $children
     * @return User
     */
    public function setChildren(array $children): User
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getParent(): ?User
    {
        return $this->parent;
    }

    /**
     * @return bool
     */
    public function hasParent(): bool
    {
        return (null !== $this->parent);
    }

    /**
     * @param User|null $parent
     * @return User
     */
    public function setParent(?User $parent): User
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreditsLeft(): int
    {
        return $this->creditsLeft;
    }

    /**
     * @param int $creditsLeft
     * @return User
     */
    public function setCreditsLeft(int $creditsLeft): User
    {
        $this->creditsLeft = $creditsLeft;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreditsRight(): int
    {
        return $this->creditsRight;
    }

    /**
     * @param int $creditsRight
     * @return User
     */
    public function setCreditsRight(int $creditsRight): User
    {
        $this->creditsRight = $creditsRight;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLeft(): bool
    {
        return $this->isLeft;
    }

    /**
     * @param bool $isLeft
     * @return User
     */
    public function setIsLeft(bool $isLeft): User
    {
        $this->isLeft = $isLeft;
        return $this;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return User
     */
    public function setVersion(int $version): User
    {
        $this->version = $version;
        return $this;
    }


}
