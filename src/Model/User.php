<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 12.11.2018
 * Time: 15:09
 */

namespace App\Model;


class User
{
    /**
     * @var string
     */
    private $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setUid(string $id): void
    {
        $this->id = $id;
    }
}