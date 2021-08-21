<?php

namespace Modules\ContactWebsites\Entities;

use Bnb\Laravel\Attachments\HasAttachment;
use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Modules\Contacts\Entities\Contact;
use Modules\Platform\Core\Traits\Commentable;

/**
 * Modules\ContactWebsites\Entities\ContactWebsite
 *
 * @property int $id
 * @property int|null $type_id
 * @property string|null $url
 * @property int $contact_id
 * @property int $is_active
 * @property int $is_default
 * @property int $company_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bnb\Laravel\Attachments\Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Platform\Core\Entities\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read Contact $contact
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactWebsite whereUrl($value)
 * @mixin \Eloquent
 */
class ContactWebsite extends Model
{

    use BelongsToTenants, Commentable, HasAttachment;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
    public $table = 'contact_websites';
    public $fillable = [
        'url',
        'type_id',
        'is_default',
        'is_active',
        'contact_id',
        'notes',
    ];
    protected $mustBeApproved = false;

    protected $dates = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();
    }


    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }


}
