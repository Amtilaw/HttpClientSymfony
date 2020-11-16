<?php

namespace App\Form;

use App\Entity\HttpEntite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ApiRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',ChoiceType::class, [
                'choices'  => [
                    'POST' => 'POST',
                    'GET' => 'GET',
                    'UPDATE' => 'UPDATE',
                ],
                'required' => true,
                'label' => 'Methode',
            ])
            ->add('url', null, [
                'label' => 'Url api ',
            ])
            ->add('key', null, [
                'label' => 'key',
                'required' => false,
            ])
            ->add('value', null, [
                'label' => 'value ',
                'required' => false,
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HttpEntite::class,
        ]);
    }
}
