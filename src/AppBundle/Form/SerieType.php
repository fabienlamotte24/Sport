<?php

namespace AppBundle\Form;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use AppBundle\Form\ActivitesType;
use AppBundle\Entity\Activites;

class SerieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbRepetitions', IntegerType::class, array(
                'label' => 'Nombre répétition',
                'required' => true
            ))
            ->add('activitesId', EntityType::class, array(
                'class' => Activites::class,
                'label' => 'Activité:',
                'choice_label' => 'activite',
                'choice_value' => 'id'
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Serie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_serie';
    }


}
