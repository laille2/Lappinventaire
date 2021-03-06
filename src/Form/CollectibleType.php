<?php

namespace App\Form;

use App\Entity\Collectible;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollectibleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('propertiesArray', CollectionType::class, [
                'entry_type' => PropertyType::class,
                'allow_add' => true,
            ])
            ->add('collectionEntities')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Collectible::class,
        ]);
    }
}
