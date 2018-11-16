<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 15.11.2018
 * Time: 21:34
 */

namespace App\DataFixtures;


use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixture extends Fixture
{
    const TAGS = ['2017', '2018', 'ITA', 'FIA', 'FIS'];
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
//        foreach (self::TAGS as $tag) {
//            $tagE = new Tag();
//            $tagE->setName($tag);
//            $manager->persist($tagE);
//        }
//
//        $manager->flush();
    }
}