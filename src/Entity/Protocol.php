<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $creator;

    /**
     * @var array
     */
    private $participants;

    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="protocols")
     * @var array
     */
    private $tags;

    /**
     * @var array
     * @ORM\OneToMany(targetEntity="ProtocolContent", mappedBy="protocol")
     */
    private $protocolContent;

    public function __construct()
    {
        $this->protocolContent = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->participants = new ArrayCollection();
    }

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
    public function getParticipants(): ArrayCollection
    {
        return $this->participants;
    }

    /**
     * @param array $participants
     */
    public function setParticipants(ArrayCollection $participants): void
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
    public function getProtocolContent(): ArrayCollection
    {
        return $this->protocolContent;
    }

    /**
     * @param array $protocolContent
     */
    public function setProtocolContent(ArrayCollection $protocolContent): void
    {
        $this->protocolContent = $protocolContent;
    }

    public function addProtocolContent(ProtocolContent $protocolContent)
    {
        $this->protocolContent[] = $protocolContent;
    }
}
