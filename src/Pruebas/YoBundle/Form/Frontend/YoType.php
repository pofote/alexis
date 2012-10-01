<?php

namespace Pruebas\YoBundle\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class YoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
        ->add('empresa')
                ->add('nombre','email');
    }

    public function getName() {
        return 'pruebas_yobundle_yotype';
    }

}

?>
