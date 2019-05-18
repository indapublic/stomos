<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * @ORM\Table(name="tasks")
 */
class Task
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id()
     * @ORM\Column(name="uid", type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $uid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=100, nullable=false)
     */
    protected $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    protected $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    protected $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="completed", type="boolean", options={"default": 0})
     */
    protected $completed = false;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->uid = Uuid::uuid4();
    }

    /**
     * @return UuidInterface
     */
    public function getUid(): UuidInterface
    {
        return $this->uid;
    }

    /**
     * @param string $username
     *
     * @return Task
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $email
     *
     * @return Task
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $description
     *
     * @return Task
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param bool $completed
     *
     * @return Task
     */
    public function setCompleted(bool $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->completed;
    }
}