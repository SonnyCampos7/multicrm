<?php

namespace Modules\Deals\Http\Forms;

use Kris\LaravelFormBuilder\Form;
use Modules\Accounts\Entities\Account;
use Modules\Deals\Entities\DealBusinessType;
use Modules\Deals\Entities\DealStage;
use Modules\Deals\Entities\DealStatus;
use Modules\Platform\Core\Helper\FormHelper;

class DealForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => trans('deals::deals.form.name'),
        ]);
        $this->add('percentage', 'select', [
            'choices' => [
                0 => 0,
                10 => 10,
                20 => 20,
                30 => 30,
                40 => 40,
                50 => 50,
                60 => 60,
                70 => 70,
                80 => 80,
                90 => 90,
                100 => 100
            ],
            'attr' => ['class' => 'select2 pmd-select2 form-control'],
            'label' => trans('deals::deals.form.percentage'),
            'empty_value' => trans('core::core.empty_select')
        ]);


        $this->add('owned_by', 'select', [
            'choices' => FormHelper::assignedToChoises(),
            'attr' => ['class' => 'select2 pmd-select2 form-control'],
            'label' => trans('core::core.form.assigned_to'),
            'empty_value' => trans('core::core.empty_select'),
            'selected' => FormHelper::assignSelectedFromModel($this->model)
        ]);


        $this->add('amount', 'number', [
            'label' => trans('deals::deals.form.amount'),
        ]);


        $this->add('closing_date', 'dateType', [
            'label' => trans('deals::deals.form.closing_date'),
        ]);


        $this->add('probability', 'number', [
            'label' => trans('deals::deals.form.probability'),
        ]);


        $this->add('expected_revenue', 'number', [
            'label' => trans('deals::deals.form.expected_revenue'),
        ]);


        $this->add('next_step', 'text', [
            'label' => trans('deals::deals.form.next_step'),
        ]);


        $this->add('deal_stage_id', 'select', [
            'choices' => DealStage::all()->pluck('name', 'id')->toArray(),
            'attr' => ['class' => 'select2 pmd-select2 form-control'],
            'label' => trans('deals::deals.form.deal_stage_id'),
            'empty_value' => trans('core::core.empty_select')
        ]);

        $this->add('deal_status_id', 'select', [
            'choices' => DealStatus::all()->pluck('name', 'id')->toArray(),
            'attr' => ['class' => 'select2 pmd-select2 form-control'],
            'label' => trans('deals::deals.form.deal_status_id'),
            'empty_value' => trans('core::core.empty_select')
        ]);

        $this->add('deal_business_type_id', 'select', [
            'choices' => DealBusinessType::all()->pluck('name', 'id')->toArray(),
            'attr' => ['class' => 'select2 pmd-select2 form-control'],
            'label' => trans('deals::deals.form.deal_business_type_id'),
            'empty_value' => trans('core::core.empty_select')
        ]);

        $this->add('account_id', 'manyToOne', [
            'search_route' => route('accounts.accounts.index', ['mode'=>'modal']),
            'relation' => 'account',
            'relation_field' => 'name',
            'model' => $this->model,
            'modal_title' => 'accounts::accounts.choose',
            'attr' => ['class' => 'form-control manyToOne'],
            'label' => trans('core::core.form.account_id'),
            'empty_value' => trans('core::core.empty_select')
        ]);


        $this->add('notes', 'textarea', [
            'label' => trans('deals::deals.form.notes'),
        ]);


        $this->add('submit', 'submit', [
            'label' => trans('core::core.form.save'),
            'attr' => ['class' => 'btn btn-primary m-t-15 waves-effect']
        ]);
    }
}
