<?php

namespace App\Form;

use App\Entity\Membre;
use App\Entity\Responsable;
use App\Entity\Sexe;
use App\Entity\Voix;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Doctrine\ORM\EntityRepository;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('appelation')
            ->add('adresse')
            ->add('telephone')
            ->add('dateAnniversaire')
            ->add('sexe', EntityType::class, [
                'class' => Sexe::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('sexe')->orderBy('sexe.nom', 'ASC');
                },
                'choice_label' => 'nom'
            ])
            ->add('voix', EntityType::class, [
                'class' => Voix::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('voix')->orderBy('voix.id', 'ASC');
                },
                'choice_label' => 'abbreviation'
            ])
            ->add('responsable', EntityType::class, [
                'class' => Responsable::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('res')->orderBy('res.abbreviation', 'ASC');
                },
                'choice_label' => 'abbreviation'
            ])
            ->add('talents')
            ->add('confirme')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}