<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\Yaml\Tests\A;

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
     * @ORM\ManyToMany(targetEntity="Participant", inversedBy="protocols", cascade={"persist"})
     * @JoinTable(name="protocol_participants",
     *      joinColumns={@JoinColumn(name="protocol_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="participant_id", referencedColumnName="id")}
     *      )
     * @var Collection
     */
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="protocols",cascade={"persist"})
     * @JoinTable(name="protocol_tags",
     *      joinColumns={@JoinColumn(name="protocol_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     * @var array
     */
    private $tags;

    /**
     * @var array
     * @ORM\OneToMany(targetEntity="ProtocolContent", mappedBy="protocol",cascade={"persist"})
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
    public function getTags(): ?Collection
    {
        return $this->tags;
    }

    /**
     * @param ArrayCollection $tags
     */
    public function setTags(Collection $tags): void
    {
        $this->tags = $tags;
    }

    public function hasTag(Tag $tag): bool
    {
        return $this->tags->contains($tag);
    }

    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);
    }

    /**
     * @return array
     */
    public function getParticipants(): Collection
    {
        return ($this->participants !== null ? $this->participants : new ArrayCollection());
    }

    /**
     * @param array $participants
     */
    public function setParticipants(Collection $participants): void
    {
        $this->participants = $participants;
    }

    /**
     * @return int
     */
    public function getCreator(): string
    {
        return $this->creator;
    }

    /**
     * @param int $creator
     */
    public function setCreator(string $creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @return array
     */
    public function getProtocolContent(): ?Collection
    {
        return $this->protocolContent;
    }

    /**
     * @param array $protocolContent
     */
    public function setProtocolContent(Collection $protocolContent): void
    {
        $this->protocolContent = $protocolContent;
    }

    public function addProtocolContent(ProtocolContent $protocolContent)
    {
        $this->protocolContent[] = $protocolContent;
    }
}
