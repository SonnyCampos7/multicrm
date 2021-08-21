<?php

namespace Modules\Platform\Account\Http\Forms;

use Kris\LaravelFormBuilder\Form;

/**
 * Class DashboardWidgetsForm
 * @package Modules\Platform\Account\Http\Forms
 */
class DashboardWidgetsForm extends Form
{

    public function buildForm()
    {

        $this->add('enabled_dash_count', 'checkbox', [
            'label' => trans('account::account.form.enabled_dash_count'),
        ]);
        $this->add('enabled_dash_leads_overview', 'checkbox', [
            'label' => trans('account::account.form.enabled_dash_leads_overview'),
        ]);
        $this->add('enabled_dash_income_vs_expenses', 'checkbox', [
            'label' => trans('account::account.form.enabled_dash_income_vs_expenses'),
        ]);
        $this->add('enabled_dash_new_tickets', 'checkbox', [
            'label' => trans('account::account.form.enabled_dash_new_tickets'),
        ]);
        $this->add('enabled_dash_tickets_overview', 'checkbox', [
            'label' => trans('account::account.form.enabled_dash_tickets_overview'),
        ]);

        $this->add('submit', 'submit', [
            'label' => trans('account::account.form.save'),
            'attr' => ['class' => 'btn btn-primary m-t-15 waves-effect']
        ]);
    }
}
