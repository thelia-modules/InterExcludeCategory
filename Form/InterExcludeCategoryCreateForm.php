<?php

namespace InterExcludeCategory\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints;
use Thelia\Form\BaseForm;
use Thelia\Model\CategoryQuery;

class InterExcludeCategoryCreateForm extends BaseForm
{
    public function getName()
    {
        return 'interexcludecategory_create_form';
    }

    protected function buildForm()
    {
        $categoryArray = [];
        $categories = (new CategoryQuery)->find();

        /** @var \Thelia\Model\Category $$category */
        foreach ($categories as $category) {
            $categoryArray[$category->getId()] = $category
                ->getTranslation($this->getRequest()->getSession()->getLang()->getLocale())
                ->getTitle();
        }

        $this->formBuilder
            ->add(
                'first_category_id',
                ChoiceType::class,
                [
                    'constraints' => [
                        new Constraints\NotNull(),
                    ],
                    'required' => true,
                    'choices' => $categoryArray,
                    'multiple' => true,
                    'label' => $this->translator->trans('Select the first category'),
                    'label_attr' => ['for' => 'first_category'],
                ]
            )
            ->add(
                'second_category_id',
                ChoiceType::class,
                [
                    'constraints' => [
                        new Constraints\NotNull(),
                    ],
                    'required' => true,
                    'choices' => $categoryArray,
                    'multiple' => true,
                    'label' => $this->translator->trans('Select the second category'),
                    'label_attr' => ['for' => 'second_category_id'],
                ]
            )
        ;
    }
}
