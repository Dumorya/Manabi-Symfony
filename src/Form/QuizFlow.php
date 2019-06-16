<?php
/**
 * Created by PhpStorm.
 * User: Clara
 * Date: 06/06/2019
 * Time: 20:27
 */

namespace App\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class QuizFlow extends FormFlow {

    protected function loadStepsConfig() {
        return [
            [
                'label' => 'question1',
                'form_type' => QuizQuestion1Form::class,
            ],
            [
                'label' => 'question2',
                'form_type' => QuizQuestion2Form::class,
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveEngine();
                },
            ],
            [
                'label' => 'confirmation',
            ],
        ];
    }

}