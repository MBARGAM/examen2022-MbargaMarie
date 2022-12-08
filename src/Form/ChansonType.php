<?php

namespace App\Form;

use App\Entity\Chanson;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChansonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class,
            [
                'label'=> 'Titre de la chanson',
                'required'=>true
            ])
            ->add('nomAlbum',TextType::class,
            [
                'label'=> 'Nom de l album',
                'required'=>true
            ])
            ->add('paroles',TextareaType::class,
            [
                'label'=>'les paroles',
                'required'=> true
            ])
            ->add('auteur',TextType::class,
            [
                'label'=> 'auteur',
                'required'=> true

            ])
            ->add('dateSortie',DateType::class,
                [
                    'label'=> 'Date de sortie',
                    'required'=>true
                ]

             )
            ->add('genre',EntityType::class,
            [
                'label'=> 'Genre',
                'class'=>Genre::class,
                'choice_label'=> function($genre){
                   return $genre->getNom();
                }
            ])

            ->add('submit',SubmitType::class,
                [
                    'label'=> 'Soumettre',

                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chanson::class,
        ]);
    }
}
