<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProtocolRepository")
 */
class Protocol
{
    public function __construct()
    {
        $this->protocolContent = new ArrayCollection();
        $this->protocolVersions = new ArrayCollection();
        $this->tags = new ArrayCollection();

        $this->creator = -1;
    }

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

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $creator;

    /**
     * @var array
     */
    private $participants;

    /**
     * @ORM\Column(type="array")
     * @var array
     */
    private $tags;

    /**
     * @var array
     * @ORM\OneToMany(targetEntity="ProtocolContent", mappedBy="protocol")
     */
    private $protocolContent;

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
     * @param array $protocolVersions
     */
    public function setProtocolVersions(array $protocolVersions): void
    {
        $this->protocolVersions = $protocolVersions;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags(): ArrayCollection
    {
        return $this->tags;
    }

    /**
     * @param ArrayCollection $tags
     */
    public function setTags(ArrayCollection $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return array
     */
    public function getParticipants(): array
    {
        return $this->participants;
    }

    /**
     * @param array $participants
     */
    public function setParticipants(array $participants): void
    {
        $this->participants = $participants;
    }

    /**
     * @return int
     */
    public function getCreator(): int
    {
        return $this->creator;
    }

    /**
     * @param int $creator
     */
    public function setCreator(int $creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @return array
     */
    public function getProtocolContent(): array
    {
        return $this->protocolContent;
    }

    /**
     * @param array $protocolContent
     */
    public function setProtocolContent(array $protocolContent): void
    {
        $this->protocolContent = $protocolContent;
    }

    public function addProtocolContent(ProtocolContent $protocolContent)
    {
        $this->protocolContent[] = $protocolContent;
    }
}
