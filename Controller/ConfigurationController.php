<?php

namespace InterExcludeCategory\Controller;

use InterExcludeCategory\InterExcludeCategory;
use InterExcludeCategory\Model\InterExcludeCategory as InterExcludeCategoryModel;
use InterExcludeCategory\Model\InterExcludeCategoryQuery;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Form\Exception\FormValidationException;

class ConfigurationController extends BaseAdminController
{
    protected $currentRouter = InterExcludeCategory::ROUTER;

    public function viewAction()
    {
        if (null !== $response = $this->checkAuth(
            AdminResources::MODULE,
            'InterExcludeCategory',
            AccessManager::VIEW
        )) {
            return $response;
        }

        $interExcludeCategories = InterExcludeCategoryQuery::create()
            ->find();

        return $this->render('module-config', ['interExcludeCategories' => $interExcludeCategories]);
    }

    public function createAction()
    {
        $form =$this->createForm('interexcludecategory_create_form');

        try {
            $this->validateForm($form);
            $data = $form->getForm()->getData();

            foreach ($data['first_category_id'] as $firstCategoryId) {
                foreach ($data['second_category_id'] as $secondCategoryId) {
                    $interExcludeCategory = InterExcludeCategoryQuery::create()
                        ->filterByFirstCategoryId($firstCategoryId)
                        ->filterBySecondCategoryId($secondCategoryId)
                        ->findOne();

                    if (null === $interExcludeCategory) {
                        (new InterExcludeCategoryModel)
                            ->setFirstCategoryId($firstCategoryId)
                            ->setSecondCategoryId($secondCategoryId)
                            ->save();
                    }
                }
            }
        } catch (FormValidationException $ex) {
            $error_msg = $this->createStandardFormValidationErrorMessage($ex);
        } catch (\Exception $ex) {
            $error_msg = $ex->getMessage();
        }

        return $this->generateRedirectFromRoute('interexcludecategory.config.view');
    }

    public function deleteAction()
    {
        $form =$this->createForm('interexcludecategory_delete_form');

        try {
            $this->validateForm($form);
            $data = $form->getForm()->getData();

            if (null !== $interExcludeCategory = InterExcludeCategoryQuery::create()
                    ->findOneById($data['inter_exclude_category_id'])
            ) {
                $interExcludeCategory->delete();
            }
        } catch (FormValidationException $ex) {
            $error_msg = $this->createStandardFormValidationErrorMessage($ex);
        } catch (\Exception $ex) {
            $error_msg = $ex->getMessage();
        }

        return $this->generateRedirectFromRoute('interexcludecategory.config.view');
    }
}
