<?php
namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity("email")]
#[UniqueEntity("mobilePhone")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 190)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 190)]
    private ?string $firstName = null;

    #[ORM\Column(type: 'string', length: 190)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 190)]
    private ?string $lastName = null;

    #[ORM\Column(type: 'string', length: 60, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Assert\Length(max: 60)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 60, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 60)]
    private ?string $mobilePhone = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(?string $mobilePhone): self
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }
}
