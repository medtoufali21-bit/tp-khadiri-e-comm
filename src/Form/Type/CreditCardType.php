<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CreditCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cardNumber', TextType::class, ['label' => 'Numero de carte'])
            ->add('expirationMonth', ChoiceType::class, [
                'choices' => \array_combine(\range(1, 12), \range(1, 12)),
                'label' => 'Mois',
            ])
            ->add('expirationYear', ChoiceType::class, [
                'choices' => \array_combine(\range(2026, 2032), \range(2026, 2032)),
                'label' => 'Annee',
            ])
            ->add('cvv', TextType::class, ['attr' => ['maxlength' => 3]])
            ->add('fullName', TextType::class, ['label' => 'Nom sur la carte']);
    }
}
