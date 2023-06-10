<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistrationType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName',TextType::class,[
                'attr'=>[
                    'minlenght'=>'2',
                    'maxlenght'=>'50'
                ],
                'label'=>'Nom / Prenom ',
                'label_attr'=>[
                ],
                'constraints'=>[
                 new Assert\NotBlank(),
                 new Assert\Length(['min'=>2 , 'max'=>50 ])
                ]
            ])
            ->add('pseudo',TextType::class,[
                'attr'=>[
                    'minlenght'=>'2',
                    'maxlenght'=>'50'
                ],
                'label'=>'Pseudo (Facultatif)',
                'label_attr'=>[
                ],
                'constraints'=>[
                 new Assert\Length(['min'=>2 , 'max'=>50 ])
                ]
            ])
            ->add('email', EmailType::class,[
                'attr'=>[
                    'minlenght'=>'2',
                    'maxlenght'=>'180'
                ],
                'label'=>'Email',
                'label_attr'=>[
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Email(),
                 new Assert\Length(['min'=>2 , 'max'=>180])
                ]
            ])
            ->add('password',RepeatedType::class,[
                'type'=>PasswordType::class,
                'first_options'=>[
                  'attr'=>[
                    'minlenght'=>'2',
                    'maxlenght'=>'180'
                  ],
                  'label'=>'Mot de passe',
                  'label_attr'=>[
                  ]
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                 
                 new Assert\Length(['min'=>2 , 'max'=>180])
                ],
                'second_options'=>[
                    'attr'=>[
                        'minlenght'=>'2',
                        'maxlenght'=>'180'
                      ],
                      'label'=>'Confirmer mot de passe',
                      'label_attr'=>[
                      ]
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                 new Assert\Length(['min'=>2 , 'max'=>180])
                ],
                'invalid_message'=>'les mots de passes ne se correspondent pas.'
            ])
            ->add('Submit',SubmitType::Class,[
                'attr'=>[
                ]
            ]);
            

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
