<?php

namespace App\Form;

use App\Entity\Protocol;
use App\Entity\ProtocolContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProtocolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('participants',CollectionType::class, array(
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ))
        ;

        $builder->add('tags', CollectionType::class, array(
            'entry_type' => TextType::class,
            'allow_add' => true,
            'allow_delete' => true,
        ));

        $builder->add('protocolContent', CollectionType::class, array(
            'entry_type' => ProtocolContentType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Protocol::class,
        ]);
    }
}
