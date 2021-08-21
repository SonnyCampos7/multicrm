<?php

namespace Modules\Accounts\Entities;

use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Platform\Core\Entities\CachableModel;


/**
 * Modules\Accounts\Entities\AccountPaymentCondition
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $numeric_value
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|AccountPaymentCondition newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|AccountPaymentCondition newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountPaymentCondition onlyTrashed()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|AccountPaymentCondition query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentCondition whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentCondition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentCondition whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentCondition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentCondition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentCondition whereNumericValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentCondition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel withCacheCooldownSeconds($seconds)
 * @method static \Illuminate\Database\Query\Builder|AccountPaymentCondition withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountPaymentCondition withoutTrashed()
 * @mixin \Eloquent
 */
class AccountPaymentCondition extends CachableModel
{
    use SoftDeletes, BelongsToTenants;


    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
    public $table = 'accounts_dict_payment_condition';

    public $fillable = [
        'name',
        'numeric_value',
        'company_id'
    ];


    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
