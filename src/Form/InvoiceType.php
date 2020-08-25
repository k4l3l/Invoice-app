<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clientName', TextType::class)
            ->add('matter', TextType::class)
            ->add('issuer', ChoiceType::class, [
                'choices' => [
                    'Atanas Mihnev' => 'Atanas Mihnev',
                    'Elvis Metodiev' => 'Elvis Metodiev',
                    'Kiril Chuchukov' => 'Kiril Chuchukov',
                ],
            ])
            ->add('invoiceId', NumberType::class)
            ->add('description', TextType::class)
            ->add('price', MoneyType::class)
            ->add('dateIssued', TextType::class)
            ->add('currency', ChoiceType::class, [
                'mapped' => false,
                'choices' => [
                    'Euro' => 'Euro',
                    'US dollars' => 'US dollars',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Invoice',
        ]);
    }
}
