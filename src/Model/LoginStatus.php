<?php

namespace App\Model;

class LoginStatus
{
    /**
     * @var bool
     */
    private $isLogged = false;
    /**
     * @var string
     */
    private $username = '';
    /**
     * @var string[]
     */
    private $roles = [];

    /**
     * @return bool
     */
    public function isLogged(): bool
    {
        return $this->isLogged;
    }

    /**
     * @param bool $isLogged
     * @return LoginStatus
     */
    public function setIsLogged(bool $isLogged): LoginStatus
    {
        $this->isLogged = $isLogged;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return LoginStatus
     */
    public function setUsername(string $username): LoginStatus
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param string[] $roles
     * @return LoginStatus
     */
    public function setRoles(array $roles): LoginStatus
    {
        $this->roles = $roles;
        return $this;
    }


}
