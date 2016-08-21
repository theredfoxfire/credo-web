<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CareerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
              'label' => false,
              'attr' => array(
                'class' => 'form-control',
                'size' => '56',
                'placeholder' => 'NAME'
              ),
            ))
            ->add('email', EmailType::class, array(
                'label' => false,
                'attr' => array(
                  'class' => 'form-control',
                  'size' => '56',
                  'placeholder' => 'EMAIL'
                ),
            ))
            ->add('title', TextType::class, array(
                'label' => false,
                'attr' => array(
                  'class' => 'form-control',
                  'size' => '56',
                  'placeholder' => 'SUBJECT'
                ),
            ))
            ->add('message', TextareaType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array(
                  'class' => 'form-control',
                  'rows' => '6',
                  'placeholder' => 'MESSAGE'
                ),
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Career'
        ));
    }
}
