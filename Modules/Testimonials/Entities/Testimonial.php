<?php

namespace Modules\Testimonials\Entities;

use Bnb\Laravel\Attachments\HasAttachment;
use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Contacts\Entities\Contact;
use Modules\Platform\Core\Traits\Commentable;
use Modules\Products\Entities\Product;
use Modules\Testimonials\Entities\TestimonialStatusType;
use Modules\Testimonials\Entities\TestimonialNpsType;
use Modules\Testimonials\Entities\TestimonialVipType;
use Modules\Testimonials\Entities\TestimonialUsageType;

/**
 * Modules\Testimonials\Entities\Testimonial
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $contact_id
 * @property int|null $company_id
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bnb\Laravel\Attachments\Attachment[] $attachments
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Platform\Core\Entities\Comment[] $comments
 * @property-read \Modules\Contacts\Entities\Contact|null $contact
 * @property-read \Modules\Products\Entities\Product|null $product
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial newQuery()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Testimonials\Entities\Testimonial onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Testimonials\Entities\Testimonial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Testimonials\Entities\Testimonial withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Testimonials\Entities\Testimonial withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $testimonial_title
 * @property string|null $testimonial
 * @property string|null $testimonial_video
 * @property string|null $testimonial_video_comment
 * @property string|null $tr_personalbenefit
 * @property string|null $tr_professionalbenefit
 * @property string|null $tr_problem
 * @property string|null $th_goal
 * @property string|null $th_lifebefore
 * @property string|null $th_lifeafter
 * @property string|null $th_evidenceafter
 * @property string|null $th_experience
 * @property string|null $likedmost
 * @property string|null $likedleast
 * @property int|null $grade
 * @property string|null $tomake10
 * @property int|null $NPS
 * @property string|null $sig_name
 * @property string|null $sig_tagline
 * @property string|null $sig_email
 * @property string|null $sig_site
 * @property string|null $sig_profession
 * @property string|null $sig_country
 * @property string|null $sig_city
 * @property \Illuminate\Support\Carbon|null $sig_date
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property int|null $usage_id
 * @property int|null $nps_id
 * @property int|null $vip_id
 * @property int|null $status_id
 * @property int|null $product_group_id
 * @property-read int|null $attachments_count
 * @property-read int|null $comments_count
 * @property-read TestimonialNpsType|null $nps
 * @property-read \Modules\Testimonials\Entities\TestimonialProductGroup|null $productGroup
 * @property-read TestimonialStatusType|null $status
 * @property-read TestimonialUsageType|null $usage
 * @property-read TestimonialVipType|null $vip
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereLikedleast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereLikedmost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereNPS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereNpsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereProductGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereSigCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereSigCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereSigDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereSigEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereSigName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereSigProfession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereSigSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereSigTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereTestimonial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereTestimonialTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereTestimonialVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereTestimonialVideoComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereThEvidenceafter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereThExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereThGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereThLifeafter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereThLifebefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereTomake10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereTrPersonalbenefit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereTrProblem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereTrProfessionalbenefit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereUsageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereVipId($value)
 */
class Testimonial extends Model
{

    use SoftDeletes, BelongsToTenants, Commentable, HasAttachment;

    protected $mustBeApproved = false;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
    public $table = 'testimonials';

    public $fillable = [
        'product_id',
        'contact_id',
        'company_id',
        'comment',
        'testimonial_title',
        'tr_personalbenefit',
        'tr_professionalbenefit',
        'tr_problem',
        'th_goal',
        'th_lifebefore',
        'th_lifeafter',
        'th_evidenceafter',
        'th_experience',
        'likedmost',
        'likedleast',
        'grade',
        'nps_id',
        'testimonial',
        'testimonial_video',
        'testimonial_video_comment',
        'usage_id',
        'NPS',
        'sig_name',
        'sig_tagline',
        'sig_email',
        'sig_site',
        'sig_profession',
        'sig_country',
        'sig_city',
        'sig_date',
        'vip_id',
        'published_at',
        'status_id',
    ];


    protected $dates = ['deleted_at', 'created_at', 'updated_at', 'published_at', 'sig_date'];


    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(TestimonialStatusType::class);
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nps()
    {
        return $this->belongsTo(TestimonialNpsType::class);
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vip()
    {
        return $this->belongsTo(TestimonialVipType::class);
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usage()
    {
        return $this->belongsTo(TestimonialUsageType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productGroup()
    {
        return $this->belongsTo(TestimonialProductGroup::class);
    }
}
