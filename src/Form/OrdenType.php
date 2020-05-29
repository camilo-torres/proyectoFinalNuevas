<?php

namespace App\Form;

use App\Entity\Orden;
use App\Entity\Producto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OrdenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productos', EntityType::class,[
                'class' => producto::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('producto')
                        ->orderBy('producto.nombreProducto', 'ASC');
                },
                'choice_label' => 'nombreProducto',]
            )
            ->add('totalOrden')
            ->add('estado')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orden::class,
        ]);
    }
}
