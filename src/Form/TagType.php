<?php

namespace App\Form;

use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $product = $event->getData();
            $form = $event->getForm();
            if (!$product || null === $product->getId()) {
                $form->add('name', TextType::class, [
                    'label' => false,
                    'attr' => [
                        'class' => ''
                    ],
                ]);
            } else {
                $form->add('name', TextType::class, [
                        'label' => false,
                        'attr' => [
                            'readonly' => true,
                            'class' => 'form-remove-action tag'
                        ],
                    ]
                );
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tag::class,
        ]);
    }
}
