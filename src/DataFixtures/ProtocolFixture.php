<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 15.11.2018
 * Time: 21:42
 */

namespace App\DataFixtures;


use App\Entity\Participant;
use App\Entity\Protocol;
use App\Entity\ProtocolContent;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class ProtocolFixture extends Fixture
{
    const PROTOCOL_CONTENT = [['punkt 1', ''],['punkt 2', 'is nich!']];
    const PARTICIPANTS = ['ich', 'du', 'er'];
    const TAGS = ['2017', '2018', 'ITA', 'FIA', 'FIS'];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tags = [];
        foreach (self::TAGS as $tag) {
            $tagE = new Tag();
            $tagE->setName($tag);
            $manager->persist($tagE);
            $tags[] = $tagE;
        }

        $protocolContents = [];
        foreach (self::PROTOCOL_CONTENT as $protocolContent) {
            $protocolContentE = new ProtocolContent();
            $protocolContentE->setName($protocolContent[0]);
            $protocolContentE->setResult($protocolContent[1]);
            $manager->persist($protocolContentE);
            $protocolContents[] = $protocolContentE;
        }

        $participants = [];
        foreach (self::PARTICIPANTS as $participant) {
            $participantE = new Participant();
            $participantE->setName($participant);
            $manager->persist($participantE);
            $participants = [$participantE];
        }

        $protocol = new Protocol();
        $protocol->setName('Erste Konferenz');
        $protocol->setCreateAt(new \DateTime());
        $protocol->setCreator(1);
        $protocol->setParticipants(new ArrayCollection($participants));
        $protocol->setProtocolContent(new ArrayCollection($protocolContents));
        $protocol->setTags(new ArrayCollection($tags));
        $manager->persist($protocol);
        $manager->flush();
    }
}