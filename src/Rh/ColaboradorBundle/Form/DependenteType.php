<?php

namespace Rh\ColaboradorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class DependenteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, array('constraints' => new NotBlank()))
            ->add('dataNascimento', BirthdayType::class, array('constraints' => array(new NotBlank(), new Type('\DateTime')),
                'widget'=>'single_text','format'=>'yyyy-MM-dd',))
            ->add('parentesco', TextType::class, array('constraints' => new NotBlank()))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rh\ColaboradorBundle\Entity\Dependente'
        ));
    }
}
