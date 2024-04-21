<?php

namespace App\Entity;


class PreDBPicture
{
    
    private $id;
    private $url;
    private $credits;
    private $attachment;
    private $play;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCredits(): ?string
    {
        return $this->credits;
    }

    public function setCredits(?string $credits): self
    {
        $this->credits = $credits;

        return $this;
    }

    public function getPlay(): ?int
    {
        return $this->play;
    }

    public function setPlay(?int $play): self
    {
        $this->play = $play;

        return $this;
    }

    /**
     * Get the value of photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     */
    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set the value of attachment
     */
    public function setAttachment($attachment): self
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * Get the value of play_id
     */
    public function getPlayId()
    {
        return $this->play_id;
    }

    /**
     * Set the value of play_id
     */
    public function setPlayId($play_id): self
    {
        $this->play_id = $play_id;

        return $this;
    }
}
