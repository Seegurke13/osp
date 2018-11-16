<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 15.11.2018
 * Time: 21:38
 */

namespace App\DataFixtures;


use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ParticipantFixture extends Fixture
{
    const PARTICIPANTS = ['ich', 'du', 'er'];
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
//        foreach (self::PARTICIPANTS as $participant) {
//            $participantE = new Participant();
//            $participantE->setName($participant);
//            $manager->persist($participantE);
//        }
//        $manager->flush();
    }
}