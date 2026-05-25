<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class RegistrationRequest
{
    #[Assert\NotBlank(message: 'Champ obligatoire')]
    private ?string $fullName = null;

    #[Assert\NotBlank(message: 'Champ obligatoire')]
    #[Assert\Email(message: 'Cette adresse email est invalide.')]
    private ?string $email = null;

    #[Assert\NotBlank(message: 'Champ obligatoire')]
    #[Assert\Regex(message: 'Le mot de passe doit contenir 8 caracteres, une majuscule, une minuscule, un chiffre et @, - ou _.', pattern: '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@\-_]).{8,}$/')]
    private ?string $password = null;

    #[Assert\NotBlank(message: 'Champ obligatoire')]
    private ?string $phone = null;

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }
}
