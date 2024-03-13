<?php

namespace EvolutionSDK\Instances;

class Instance
{
    private string $name;
    private array $qrcode;
    private string $owner;
    private string $profileName;
    private string $profilePictureUrl;
    private string $profileStatus;
    private string $status;
    private string $apikey;

//    public function connect() {}
//    public function restart() {}
//    public function delete() {}
//    public function logout() {}
//    public function status() {}
//    public function webhooks() {}

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getQrcode(): array
    {
        return $this->qrcode;
    }

    public function setQrcode(array $qrcode): void
    {
        $this->qrcode = $qrcode;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
    }

    public function getProfileName(): string
    {
        return $this->profileName;
    }

    public function setProfileName(string $profileName): void
    {
        $this->profileName = $profileName;
    }

    public function getProfilePictureUrl(): string
    {
        return $this->profilePictureUrl;
    }

    public function setProfilePictureUrl(string $profilePictureUrl): void
    {
        $this->profilePictureUrl = $profilePictureUrl;
    }

    public function getProfileStatus(): string
    {
        return $this->profileStatus;
    }

    public function setProfileStatus(string $profileStatus): void
    {
        $this->profileStatus = $profileStatus;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getApikey(): string
    {
        return $this->apikey;
    }

    public function setApikey(string $apikey): void
    {
        $this->apikey = $apikey;
    }
}