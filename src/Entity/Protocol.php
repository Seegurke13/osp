<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProtocolRepository")
 */
class Protocol
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    private $creator;

    private $participants;

    /**
     * @ORM\ManyToOne(targetEntity="Tag")
     * @var array
     */
    private $tags;

    /**
     * @var array
     * @ORM\OneToMany(targetEntity="ProtocolVersion", mappedBy="protocol")
     */
    private $protocolVersions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * @return array
     */
    public function getProtocolVersions(): array
    {
        return $this->protocolVersions;
    }

    /**
     * @param array $protcolVersions
     */
    public function setProtocolVersions(array $protocolVersions): void
    {
        $this->protocolVersions = $protocolVersions;
    }
}
