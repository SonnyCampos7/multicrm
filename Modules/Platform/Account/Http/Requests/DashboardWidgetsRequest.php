<?php

namespace Modules\Platform\Account\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class DashboardWidgetsRequest
 * @package Modules\Platform\Account\Http\Requests
 */
class DashboardWidgetsRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

        ];
    }
}
