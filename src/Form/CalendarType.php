<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', EntityType::class,
                [
                    'label' => 'Choisir une prestation',
                    'class' => Product::class,
                    'query_builder' => function(ProductRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->innerJoin('p.categorie', 'c', 'with', 'c.name = :name')
                            ->setParameter('name','service');
                    },
                    'choice_label' => 'name',
                    'choice_value' => function (Product $entity) {
                        return $entity ? $entity->getName() : '';
                    },
                    'multiple'=> true,
                    'expanded'=>true
                ])
            ->add('start', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => "Choisir une date "

            ])
            //->add('end',DateTimeType::class,[
            //    'date_widget'=>'single_text'
            //])
            ->add('description', TextType::class, [
                'label' => "Des spécifications : "
            ])
            //->add('all_day')
            //->add('background_color', ColorType::class)
            //->add('border_color',ColorType::class)
            //->add('text_color',ColorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
