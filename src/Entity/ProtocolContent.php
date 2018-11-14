<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProtocolContentRepository")
 */
class ProtocolContent
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
     * @var Protocol
     * @ORM\ManyToOne(targetEntity="Protocol", inversedBy="protocolContent")
     */
    private $protocol;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $result;

    public function __construct()
    {
        $this->setName('');
        $this->setResult('');
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

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return Protocol
     */
    public function getProtocol(): ?Protocol
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
}
