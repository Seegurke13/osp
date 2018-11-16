<?php

namespace App\Form;

use App\Entity\Protocol;
use App\Entity\ProtocolContent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProtocolType extends AbstractType
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('participants',CollectionType::class, array(
                'entry_type' => ParticipantType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ))
        ;

        $builder->add('tags', CollectionType::class, array(
            'entry_type' => TagType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'label' => 'Tags'
        ));

        $builder->add('protocolContent', CollectionType::class, array(
            'entry_type' => ProtocolContentType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'label' => 'Inhalt',
            'entry_options' => array('label' => false),
            'by_reference' => false,
        ));

//        $builder->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Protocol::class,
            'empty_data' => null,
        ]);
    }
}
