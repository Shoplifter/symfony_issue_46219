<?php
namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('division', TextType::class, [
                'required' => true,
            ])
            ->add('salary', MoneyType::class, [
                'required' => false,
                'currency' => false,
            ])
            ->add('user', UserType::class, [
                'required' => true,
            ])
        ;
        $builder->get('salary')->addModelTransformer(new CallbackTransformer(
            function($value){
                return $value / 100;
            },
            function($value){
                return $value * 100;
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
