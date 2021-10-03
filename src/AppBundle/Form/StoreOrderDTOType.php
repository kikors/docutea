<?php

namespace AppBundle\Form;

use AppBundle\StaticsClass\Provinces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StoreOrderDTOType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nombre / Razón social',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('cif', TextType::class, [
                'required' => true,
                'label' => 'CIF',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('address', TextType::class, [
                'required' => true,
                'label' => 'Dirección',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('town', TextType::class, [
                'required' => true,
                'label' => 'Población',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('province', ChoiceType::class, array(
                'required' => false,
                "label" => 'Provincia',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
                'choices' => Provinces::Provinces,
            ))
            ->add('cp', TextType::class, [
                'required' => true,
                'label' => 'Código Postal',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('phone', TextType::class, [
                'required' => true,
                'label' => 'Teléfono',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Correo Electrónico',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('contactName', TextType::class, [
                'required' => true,
                'label' => 'Nombre de Contacto',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('deliveryAddress', TextType::class, [
                'required' => true,
                'label' => 'Dirección',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('deliveryTown', TextType::class, [
                'required' => true,
                'label' => 'Población',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('deliveryProvince', ChoiceType::class, array(
                'required' => false,
                "label" => 'Provincia',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
                'choices' => Provinces::Provinces,
            ))
            ->add('deliveryCp', TextType::class, [
                'required' => true,
                'label' => 'Código Postal',
                "attr" => array(
                    'class' => 'form-control'
                ),
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ])
            ->add('aceptarComunicacion', CheckboxType::class, [
                'data' => false,
                'label' => 'Aceptar Comunicacion',
                "label_attr" => array(
                    'class' => ' control-label'
                ),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Application\Service\Dto\StoreOrderDTO'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_setore_order';
    }
}
