<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OverviewType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('overview', TextareaType::class, array(
                'label' => 'Brief overview about contact us',
                'required' => false,
                'attr' => array(
                  'class' => 'form-control',
                  'rows' => '6',
                  'placeholder' => 'MESSAGE'
                ),
            ))
            ->add('mainAddress', TextareaType::class, array(
                'label' => 'Address',
                'required' => false,
                'attr' => array(
                  'class' => 'form-control',
                  'rows' => '6',
                  'placeholder' => 'MESSAGE'
                ),
            ))
            ->add('longitude', TextType::class, array(
                'label' => 'Google Map Longitude',
                'required' => false,
                'attr' => array(
                  'class' => 'form-control',
                  'rows' => '6',
                  'placeholder' => 'longitude'
                ),
            ))
            ->add('latitude', TextType::class, array(
                'label' => 'Google Map Latitude',
                'required' => false,
                'attr' => array(
                  'class' => 'form-control',
                  'rows' => '6',
                  'placeholder' => 'latitude'
                ),
            ))
            ->add('largeImage', FileType::class, array('required' => false, 'label' => 'Foto (image file, best fit width 1280px x height 793px)', 'data' => null))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Overview'
        ));
    }
}
