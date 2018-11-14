<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 14.11.2018
 * Time: 01:49
 */

namespace App\Service;


use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;

class TagService
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getTags(): array
    {
        $tags = $this->tagRepository->findAll();

        return $tags;
    }
}