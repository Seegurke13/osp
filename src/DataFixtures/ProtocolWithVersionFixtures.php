<?php

namespace App\DataFixtures;

use App\Entity\Protocol;
use App\Entity\ProtocolVersion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProtocolWithVersionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $protocol = new Protocol();
        $protocol->setName('Protokol 1');
        $protocol->setCreateAt(new \DateTime());

        $version = new ProtocolVersion();

        $manager->persist($protocol);
//        $manager->persist($version);

        $manager->flush();
    }
}
