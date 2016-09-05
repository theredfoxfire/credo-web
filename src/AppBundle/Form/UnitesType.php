<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UnitesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'Name'))
            ->add('subtitle', null, array('label' => 'Sub name'))
            ->add('category', null, array('empty_data' => '-- Please select business category --', 'placeholder' => 'Please select business category'))
            ->add('story', TextareaType::class, array(
                'label' => 'Short Story',
                'required' => false,
                'attr' => array('class' => 'tinymce', 'rows' => '15'),
            ))
            ->add('largeImage', FileType::class, array('required' => false, 'label' => 'Foto (image file, best fit width 1280px x height 793px Max size 2MB) ', 'data' => null))
            ->add('webUrl', null, array('required' => false, 'label' => 'Website Address'))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Unites',
            'allow_extra_fields' => true
        ));
    }
}
