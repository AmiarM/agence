<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'label'=>'Titre',
                'attr'=>[
                    'placeholder'=>'Le titre du bien'
                ]
            ])
            ->add('description',TextareaType::class,[
                'label'=>'Description',
                'attr'=>[
                    'placeholder'=>'Description du bien'
                ]
            ])
            ->add('surface',NumberType::class,[
                'label'=>'Surface',
                'attr'=>[
                    'placeholder'=>'Surface'
                ]
            ])
            ->add('rooms', NumberType::class, [
            'label' => 'Pièces',
            'attr' => [
                'placeholder' => 'Surface'
            ]
        ])
            ->add('bedrooms', NumberType::class, [
            'label' => 'Chambres',
            'attr' => [
                'placeholder' => 'Surface'
            ]
        ])
            ->add('floor', NumberType::class, [
            'label' => 'Etage',
            'attr' => [
                'placeholder' => 'Surface'
            ]
        ])
            ->add('price',MoneyType::class,[
                'label'=>'Prix',
                'attr'=>[
                    'placeholder'=>'prix'
                ]
            ])
            ->add('heat',ChoiceType::class,[
                'choices' => [
                    $this->getChoices()
                ]
            ])
            ->add('city',TextType::class,[
                'label'=>'Ville',
                'attr'=>[
                    'placeholder'=>'Ville du bien'
                ]
            ])
            ->add('address',TextType::class,[
                'label'=>'Adresse',
                'attr'=>[
                    'placeholder'=>'Adresse du bien'
                ]
            ])
            ->add('postal_code')
            ->add('sold')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain'=>'forms'
        ]);
    }


    public function getChoices(){
        $input=[];
        $choices=Property::HEAT;
        foreach ($choices as $key => $value) {
            $input[$value]=$key;
        }
        return $input;
    }
}