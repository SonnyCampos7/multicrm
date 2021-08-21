<?php

namespace Modules\Deals\Entities;

use Bnb\Laravel\Attachments\HasAttachment;
use Cog\Contracts\Ownership\Ownable;
use Cog\Laravel\Ownership\Traits\HasMorphOwner;
use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Accounts\Entities\Account;
use Modules\Calls\Entities\Call;
use Modules\Campaigns\Entities\Campaign;
use Modules\Contacts\Entities\Contact;
use Modules\Orders\Entities\Order;
use Modules\Platform\Companies\Entities\Company;
use Modules\Platform\Core\Helper\ActivityLogHelper;
use Modules\Platform\Core\Traits\Commentable;
use Modules\Quotes\Entities\Quote;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Modules\Deals\Entities\Deal
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $owned_by_type
 * @property int|null $owned_by_id
 * @property float|null $amount
 * @property string|null $closing_date
 * @property float|null $probability
 * @property float|null $expected_revenue
 * @property string|null $next_step
 * @property int|null $deal_stage_id
 * @property int|null $deal_business_type_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $account_id
 * @property int|null $company_id
 * @property-read \Modules\Accounts\Entities\Account|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bnb\Laravel\Attachments\Attachment[] $attachments
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Campaigns\Entities\Campaign[] $campaigns
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Platform\Core\Entities\Comment[] $comments
 * @property-read \Modules\Platform\Companies\Entities\Company|null $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Contacts\Entities\Contact[] $contacts
 * @property-read \Modules\Deals\Entities\DealBusinessType|null $dealBusinessType
 * @property-read \Modules\Deals\Entities\DealStage|null $dealStage
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Orders\Entities\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $ownedBy
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Deals\Entities\Deal onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereClosingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereDealBusinessTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereDealStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereExpectedRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereNextStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereNotOwnedBy(\Cog\Contracts\Ownership\CanBeOwner $owner)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereOwnedBy(\Cog\Contracts\Ownership\CanBeOwner $owner)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereOwnedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereOwnedByType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereProbability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Deals\Entities\Deal withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Deals\Entities\Deal withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Deals\Entities\Deal query()
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Deals\Entities\Deal[] $owner
 * @property int|null $percentage
 * @property int|null $deal_status_id
 * @property int|null $psaps
 * @property int|null $positions
 * @property int|null $remotes
 * @property int|null $command_posts
 * @property string|null $es_inet
 * @property string|null $ngcs
 * @property int|null $network_contract_term
 * @property int|null $deal_network_id
 * @property int|null $deal_che_id
 * @property string|null $che_desc
 * @property int|null $deal_cad_id
 * @property string|null $cad_desc
 * @property int|null $deal_radio_id
 * @property string|null $radio_desc
 * @property int|null $deal_mapping_id
 * @property string|null $mapping_desc
 * @property int|null $che_range
 * @property int|null $che_maintenance
 * @property-read int|null $activity_count
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Call[] $calls
 * @property-read int|null $calls_count
 * @property-read int|null $campaigns_count
 * @property-read int|null $comments_count
 * @property-read int|null $contacts_count
 * @property-read \Modules\Deals\Entities\DealStatus|null $dealStatus
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Quote[] $quotes
 * @property-read int|null $quotes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereCadDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereCheDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereCheMaintenance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereCheRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereCommandPosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereDealCadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereDealCheId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereDealMappingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereDealNetworkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereDealRadioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereDealStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereEsInet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereMappingDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereNetworkContractTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereNgcs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal wherePositions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal wherePsaps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereRadioDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereRemotes($value)
 */
class Deal extends Model implements Ownable
{
    use SoftDeletes, HasMorphOwner, LogsActivity, Commentable, HasAttachment, BelongsToTenants;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
    protected static $logAttributes = [
        'name',
        'ownedBy.name',
        'amount',
        'closing_date',
        'probability',
        'expected_revenue',
        'next_step',
        'dealStage.name',
        'dealBusinessType.name',
        'notes',
        'percentage'
    ];
    public $table = 'deals';
    public $fillable = [
        'name',
        'amount',
        'closing_date',
        'probability',
        'expected_revenue',
        'next_step',
        'deal_stage_id',
        'deal_business_type_id',
        'notes',
        'account_id',
        'percentage',
        'company_id'
    ];
    protected $mustBeApproved = false;


    protected $dates = ['deleted_at', 'created_at', 'updated_at', 'closing_date'];

    /**
     * @param Model $model
     * @param string $attribute
     * @return  array
     */
    protected static function getRelatedModelAttributeValue(Model $model, string $attribute): array
    {
        return ActivityLogHelper::getRelatedModelAttributeValue($model, $attribute);
    }


    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dealStage()
    {
        return $this->belongsTo(DealStage::class);
    }

    public function dealStatus()
    {
        return $this->belongsTo(DealStatus::class);
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dealBusinessType()
    {
        return $this->belongsTo(DealBusinessType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contacts()
    {
        return $this->belongsToMany(Contact::class);
    }

    public function calls()
    {
        return $this->belongsToMany(Call::class);
    }

    public function quotes()
    {
        return $this->belongsToMany(Quote::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
