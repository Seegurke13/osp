<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 14.11.2018
 * Time: 01:49
 */

namespace App\Service;


use App\Entity\Participant;
use App\Entity\Protocol;
use App\Entity\Tag;
use App\Model\TagModel;
use App\Repository\ParticipantRepository;
use App\Repository\ProtocolRepository;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class TagService
{
    /**
     * @var TagRepository
     */
    private $tagRepository;
    /**
     * @var Router
     */
    private $router;
    /**
     * @var ProtocolService
     */
    private $protocolService;
    /**
     * @var Security
     */
    private $security;
    /**
     * @var ParticipantRepository
     */
    private $participantRepository;
    /**
     * @var ProtocolRepository
     */
    private $protocolRepository;

    public function __construct(Security $security,
                                ParticipantRepository $participantRepository,
                                ProtocolService $protocolService,
                                TagRepository $tagRepository,
                                UrlGeneratorInterface $router,
ProtocolRepository $protocolRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->router = $router;
        $this->protocolService = $protocolService;
        $this->security = $security;
        $this->participantRepository = $participantRepository;
        $this->protocolRepository = $protocolRepository;
    }

    public function getTagsForCurrentUser(): array
    {
        $user = $this->security->getUser();
        if ($user === null) {
            return [];
        }
        $parcipant = $this->participantRepository->findByUserId($user);
        $protocols = $parcipant->getProtocols();
        $tags = [];

        foreach ($protocols as $protocol) {
            $tags = array_merge($tags, $protocol->getTags()->toArray());
        }

        $tagModels = [];

        foreach ($tags as $tag) {
            $tagModel = new TagModel();
            $tagModel->setName($tag->getName());
            $url = $this->router->generate('search_tag', ['tag' => $tag->getName()]);
            $tagModel->setUrl($url);
            $tagModels[] = $tagModel;
        }

        return $tagModels;
    }

    public function getTagFromTagName(string $tag): ?Tag
    {
        return $this->tagRepository->findOneBy(['name' => $tag]);
    }
}