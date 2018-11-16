<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 15.11.2018
 * Time: 21:43
 */

namespace App\DataFixtures;


use App\Entity\ProtocolContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProtocolContentFixture extends Fixture
{
    const PROTOCOL_CONTENT = [['punkt 1', ''],['punkt 2', 'is nich!']];
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
//    public function load(ObjectManager $manager)
//    {
//        foreach (self::PROTOCOL_CONTENT as $protocolContent) {
//            $protocolContentE = new ProtocolContent();
//            $protocolContentE->setName($protocolContent[0]);
//            $protocolContentE->setResult($protocolContent[1]);
//            $manager->persist($protocolContentE);
//        }
//        $manager->flush();
//    }
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
    }
}