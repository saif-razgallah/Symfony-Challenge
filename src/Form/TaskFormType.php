<?php

namespace App\Form;
use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class TaskFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('subject')
            ->add('description')
            ->add('status',ChoiceType::class, ['attr' => ['class' => 'form-control'],
                                            'choices' => [
                                                'En attente' => 'enattente',
                                                'En Cours' => 'encours',
                                                'Terminé' => 'terminee',
                                                ]
                                            ])
            ->add('user_affect')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
