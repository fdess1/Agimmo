<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bnType', null, ['label'=>'Type de bien'])
            ->add('nomUsage', null, ['label'=>"Nom d'usage du bien"])
            ->add('descrAcces', null, ['label'=>"Description d'accès"])
            ->add('ad1', null, ['label'=>'adresse 1'])
            ->add('ad2', null, ['label'=>'adresse 2'])
            ->add('ad3', null, ['label'=>'adresse 3'])
            ->add('cp', null, ['label'=>'Code postal'])
            ->add('ville', null, ['label'=>'Ville'])
            ->add('codePays', null, ['label'=>'Code pays'])
            ->add('prix', null, ['label'=>'Montant du loyer (€)'])
            ->add('surfaceHabitable', null, ['label'=>'Surface habitable'])
            ->add('nbloyesParAn', null, ['label'=>'nb de loyers annuels'])
            ->add('typeChauffage', null, ['label'=>'type de chauffage'])
            ->add('hautDebit', null, ['label'=>'Haut débit'])
            // ->add('bnidProprio', null, ['label'=>'propriétaire'])
            ->add('proprietaire', null, [
                "multiple"=>false,
                "expanded"=>true
            ])
            ->add('photo', null, ['label'=>'photo'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
