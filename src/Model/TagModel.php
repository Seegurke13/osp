<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 15.11.2018
 * Time: 14:06
 */

namespace App\Model;


class TagModel
{
    /** @var string */
    private $name;
    /** @var string */
    private $url;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}