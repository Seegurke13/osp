<?php

namespace App\Twig;

use App\Model\User;
use App\Service\TagService;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension implements \Twig_Extension_GlobalsInterface
{
    /**
     * @var TagService
     */
    private $tagService;
    /**
     * @var UserInterface
     */
    private $user;
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator, TagService $tagService)
    {
        $this->tagService = $tagService;
        $this->urlGenerator = $urlGenerator;
    }

    public function getGlobals()
    {
        return [
            'tags' => $this->tagService->getTagsForCurrentUser(),
            'logoutUrl' => $this->urlGenerator->generate('app_logout', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'addUrl' => $this->urlGenerator->generate('protocol_new', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ];
    }
}
