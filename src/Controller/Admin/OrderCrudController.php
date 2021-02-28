<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateTimeField::new('createdAt', 'Passée le'),
            #TextField::new('user.fullName', 'Utilisateur'),
            #TextEditorField::new('delivery', 'Adresse de livraison')->onlyOnDetail(),
            #MoneyField::new('total', 'Total produit')->setCurrency('EUR'),#il n'existe pas on va crer la fonction dans Order
            ChoiceField::new('Status')->setChoices([
                'Non payée'=>0,
                'Payée'=>1,
                'Préparation en cours'=>2,
                'Livraison en cours'=>3
            ]),
            #ArrayField::new('Details', 'Produits achetés')


        ];
    }
}
