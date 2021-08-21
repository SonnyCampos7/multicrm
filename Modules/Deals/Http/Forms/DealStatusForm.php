<?php

namespace Modules\Deals\Http\Forms;

use Kris\LaravelFormBuilder\Form;
use Modules\Deals\Entities\DealBusinessType;
use Modules\Deals\Entities\DealStage;
use Modules\Deals\Entities\DealStatus;
use Modules\Platform\Core\Helper\FormHelper;

class DealStatusForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => trans('deals::deals.status.form.name'),
        ]);

        $this->add('owned_by', 'select', [
            'choices' => FormHelper::assignedToChoises(),
            'attr' => ['class' => 'select2 pmd-select2 form-control'],
            'label' => trans('core::core.form.assigned_to'),
            'empty_value' => trans('core::core.empty_select'),
            'selected' => FormHelper::assignSelectedFromModel($this->model)
        ]);

        $this->add('step_name', 'text', [
            'label' => trans('deals::deals.status.form.step_name'),
        ]);

        $this->add('description', 'textarea', [
            'label' => trans('deals::deals.status.form.description'),
        ]);


        $this->add('submit', 'submit', [
            'label' => trans('core::core.form.save'),
            'attr' => ['class' => 'btn btn-primary m-t-15 waves-effect']
        ]);
    }
}
