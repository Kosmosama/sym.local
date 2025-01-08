<?php

namespace App\Form;

use App\Entity\Imagen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImagenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre:',
                'label_attr' => ['class' => 'etiqueta'],
                'required' => true,
            ])
            ->add('descripcion', TextType::class, [
                'label' => 'Descripción:',
                'required' => false,
                'label_attr' => ['class' => 'etiqueta']
            ])
            ->add('categoria', NumberType::class, [
                'label' => 'Categoría:',
                'label_attr' => ['class' => 'etiqueta', 'value' => '1'],
                'data' => '1',
            ])
            ->add('numVisualizaciones', NumberType::class, [
                'label' => 'Número de Visualizaciones:',
                'required' => false,
                'label_attr' => ['class' => 'etiqueta']
            ])
            ->add('numLikes', NumberType::class, [
                'label' => 'Número de Likes:',
                'required' => false,
                'label_attr' => ['class' => 'etiqueta']
            ])
            ->add('numDownloads', NumberType::class, [
                'label' => 'Número de Descargas:',
                'required' => false,
                'label_attr' => ['class' => 'etiqueta']
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Las contraseñas deben coincidir.',
                'required' => true,
                'first_options' => [
                    'label' => 'Password',
                    'label_attr' => ['class' => 'etiqueta']
                ],
                'second_options' => [
                    'label' => 'Repetir Password',
                    'label_attr' => ['class' => 'etiqueta']
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Imagen::class,
        ]);
    }
}
