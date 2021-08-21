
@lang('account::account.dashboard_widgets_explanation')
<br /><br />

{!! form($dashboardWidgets) !!}

@push('scripts')
    {!! JsValidator::formRequest(\Modules\Platform\Account\Http\Requests\DashboardWidgetsRequest::class, '#dashboard_widgets_form') !!}
@endpush

