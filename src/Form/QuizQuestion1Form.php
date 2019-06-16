<?php
/**
 * Created by PhpStorm.
 * User: Clara
 * Date: 06/06/2019
 * Time: 20:38
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class QuizQuestion1Form extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $validValues = [2, 4];
        $builder->add('translation', ChoiceType::class, [
            'choices' => array_combine($validValues, $validValues),
            'placeholder' => '',
        ]);
    }

    public function getBlockPrefix() {
        return 'quizQuestion1';
    }

}