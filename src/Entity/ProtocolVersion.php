<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProtocolVersionRepository")
 */
class ProtocolVersion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $version;

    /**
     * @var Protocol
     * @ORM\ManyToOne(targetEntity="Protocol", inversedBy="protocolVersions")
     */
    private $protocol;

    /** @var string */
    private $meetingpoints;

    /** @var string */
    private $results;

    /**
     * @ORM\Column(type="datetime")
     */
    private $changeAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getChangeAt(): ?\DateTimeInterface
    {
        return $this->changeAt;
    }

    public function setChangeAt(\DateTimeInterface $changeAt): self
    {
        $this->changeAt = $changeAt;

        return $this;
    }

    /**
     * @return Protocol
     */
    public function getProtocol(): Protocol
    {
        return $this->protocol;
    }

    /**
     * @param Protocol $protocol
     */
    public function setProtocol(Protocol $protocol): void
    {
        $this->protocol = $protocol;
    }

    /**
     * @return string
     */
    public function getMeetingpoints(): string
    {
        return $this->meetingpoints;
    }

    /**
     * @param string $meetingpoints
     */
    public function setMeetingpoints(string $meetingpoints): void
    {
        $this->meetingpoints = $meetingpoints;
    }

    /**
     * @return string
     */
    public function getResults(): string
    {
        return $this->results;
    }

    /**
     * @param string $results
     */
    public function setResults(string $results): void
    {
        $this->results = $results;
    }
}
