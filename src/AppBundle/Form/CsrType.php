<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CsrType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'Title'))
            ->add('story', TextareaType::class, array(
                'label' => 'Short Story',
                'required' => false,
                'attr' => array('class' => 'tinymce', 'rows' => 15),
            ))
            ->add('largeImage', FileType::class, array('required' => false, 'label' => 'Foto (image file, best fit width 1280px x height 793px) ', 'data' => null))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Csr',
            'allow_extra_fields' => true
        ));
    }
}
