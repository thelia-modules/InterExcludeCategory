<?php

namespace InterExcludeCategory\Form;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints;
use Thelia\Form\BaseForm;

class InterExcludeCategoryDeleteForm extends BaseForm
{
    public function getName()
    {
        return 'interexcludecategory_delete_form';
    }

    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                'inter_exclude_category_id',
                IntegerType::class,
                [
                    'constraints' => [
                        new Constraints\NotNull(),
                    ],
                    'required' => true,
                ]
            )
        ;
    }
}
