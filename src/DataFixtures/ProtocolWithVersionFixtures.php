<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use App\Entity\Protocol;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class ProtocolWithVersionFixtures extends Fixture
{
    const PROTOCOL_CONTENT = [['punkt 1', ''],['punkt 2', 'is nich!']];

    public function load(ObjectManager $manager)
    {
        $protocol = new Protocol();
        $protocol->setName('Protokol 1');
        $protocol->setCreateAt(new \DateTime());

        $participant = new Participant();
        $participant->setName('ich');

        $participants = new ArrayCollection([$participant]);
        $protocol->setParticipants($participants);
        $protocol->setCreator(1);
        $manager->persist($protocol);
        $manager->persist($participant);
//        $manager->persist($version);

        $manager->flush();
    }
}
