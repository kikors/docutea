<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfertConfigurerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('machine', EntityType::class, array(
                'required' => false,
                'class' => 'AppBundle\Entity\Machine',
                "label" => 'Duración del Contrato (en meses): ',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
                'choices' => $options['machineList'],
            ))
            ->add('duration', NumberType::class, array(
                'required' => true,
                'empty_data' => 0,
                "label" => 'Duración del Contrato (en meses): ',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ))
            ->add('pages', NumberType::class, array(
                'required' => true,
                'empty_data' => 0,
                "label" => 'Cantidad de páginas: ',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ))

            ->add('colorPercent', NumberType::class, array(
                'required' => true,
                'empty_data' => 0,
                "label" => 'Porciento de color: ',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Machine',
            'machineList' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ofert_configurer';
    }
}
