<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant
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
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Protocol", mappedBy="participants")
     * @JoinTable(name="protocol_tags",
     *      joinColumns={@JoinColumn(name="protocol_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="participant_id", referencedColumnName="id")}
     *      )
     */
    private $protocols;

    public function __construct()
    {
        $this->protocols = new ArrayCollection();
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

    /**
     * @return Collection
     */
    public function getProtocols(): ?Collection
    {
        return $this->protocols;
    }

    /**
     * @param Collection $protocols
     */
    public function setProtocols(Collection $protocols): void
    {
        $this->protocols = $protocols;
    }
}
