<?php

namespace App\Form;

use App\Entity\{Picture, PreDBPicture};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\{TextType, FormType, FileType, EmailType, HiddenType, SubmitType, ChoiceType, TextareaType};

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        extract($options['data']);

        foreach($plays as $play) {
            $playsArray[$play->getName()] = $play->getId();
        }
        
        $builder
        // ->add(
        //     $builder->create('picture', FormType::class, [
        //         'row_attr' => [
        //             'class' => 'container__form-section'
        //         ],
        //         'label' => 'Votre identité',
        //         'label_attr' => [
        //             'class' => 'container__form-section-title'
        //         ],
        //         'action' => '/submit',
        //     ])
                ->add('attachment', FileType::class)
                ->add('credits', TextType::class)
                ->add('play_id', ChoiceType::class, [
                    // 'mapped' => false,
                    "choices" => $playsArray,
                    ])
        //     )
        
        // ->add('save', SubmitType::class, [
        //     'attr' => [
        //         'class' => 'container__form-button'
        //     ],
        //     'row_attr' => [
        //         'class' => 'container__form-section'
        //     ],
        //     'label' => 'Envoyer ma demande',
        //     'validation_groups' => ['picture'],
        // ])
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => PreDBPicture::class,
        ]);
    }
}
