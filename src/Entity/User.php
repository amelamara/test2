<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class User implements UserInterface
{
    const MAX_ADVICED_DAILY_CALORIES = 2500;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\Column
     */
    private string $username;

    /**
     * @ORM\Column
     */
    private string $fullname;

    /**
     * @ORM\Column
     */
    private string $email;

    /**
     * @ORM\Column
     */
    private string $avatarUrl;

    /**
     * @ORM\Column
     */
    private string $profileHtmlUrl;

    #[Pure]
    public function __construct($username, $fullname, $email, $avatarUrl, $profileHtmlUrl)
    {
        $this->username = $username;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->avatarUrl = $avatarUrl;
        $this->profileHtmlUrl = $profileHtmlUrl;
        $this->foodRecords = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername(): mixed
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getFullname(): mixed
    {
        return $this->fullname;
    }

    /**
     * @return mixed
     */
    public function getEmail(): mixed
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getAvatarUrl(): mixed
    {
        return $this->avatarUrl;
    }

    /**
     * @return mixed
     */
    public function getProfileHtmlUrl(): mixed
    {
        return $this->profileHtmlUrl;
    }


    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return '';
    }






    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string|null The encoded password if any
     */
    public function getPassword(){}

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt(){}
}