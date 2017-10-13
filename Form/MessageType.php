<?php

namespace Lilworks\MessageBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $user = $options["user"];

        $builder
            ->add('messageSubject')
            ->add('message')
            ->add('getCopy')
        ;
        if(!$user){
            $builder->add('email',EmailType::class,array(
                'required'=>true
            ));
        }else{
            $builder->add('email',EmailType::class,array(
                'required'=>true,
                'data'=>$user->getEmail()
            ));
        }
        $builder->add('send', SubmitType::class, array(
            'attr' => array('class' => 'send'),
        ));

    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lilworks\MessageBundle\Entity\Message',
            'user'=>null,
            'translation_domain' => 'lilworks_message'
        ));
    }
}
