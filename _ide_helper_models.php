<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property int $is_hide
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $count
 * @property string|null $shorthand
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsHide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereShorthand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\District
 *
 * @property int $id
 * @property string $name
 * @property int $type_id
 * @property int $is_hide
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\DistrictType $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ward[] $wards
 * @property-read int|null $wards_count
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereIsHide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedAt($value)
 */
	class District extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DistrictType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|DistrictType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistrictType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistrictType query()
 * @method static \Illuminate\Database\Eloquent\Builder|DistrictType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistrictType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistrictType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistrictType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistrictType whereUpdatedAt($value)
 */
	class DistrictType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $category_id
 * @property int $ward_id
 * @property float $price
 * @property float $discount
 * @property float $commission
 * @property string $acreage
 * @property int|null $bedroom
 * @property int|null $toilet
 * @property int|null $floor
 * @property string $description
 * @property string $owner_name
 * @property string $owner_phone
 * @property string $owner_address
 * @property int $is_cheap
 * @property int $is_featured
 * @property int $is_hide
 * @property int $is_rented
 * @property string|null $deny_reason
 * @property int $verify_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property int|null $user_update_id
 * @property int $id_by_category
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostImage[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User|null $user_update
 * @property-read \App\Models\Ward $ward
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereAcreage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBedroom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDenyReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIdByCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsCheap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsHide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsRented($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereOwnerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereOwnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereOwnerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereToilet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserUpdateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereVerifyStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereWardId($value)
 * @method static \Illuminate\Database\Query\Builder|Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Post withoutTrashed()
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostImage
 *
 * @property int $id
 * @property int|null $post_id
 * @property string $filename
 * @property string $originalFilename
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Post|null $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereOriginalFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostImage whereUpdatedAt($value)
 */
	class PostImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostRequest
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $message
 * @property int $type_id
 * @property int|null $post_id
 * @property int $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Post|null $post
 * @property-read \App\Models\PostRequestType $type
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest newQuery()
 * @method static \Illuminate\Database\Query\Builder|PostRequest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|PostRequest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PostRequest withoutTrashed()
 */
	class PostRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostRequestType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequestType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequestType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequestType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequestType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequestType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequestType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequestType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequestType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostRequestType whereUpdatedAt($value)
 */
	class PostRequestType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $fullname
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ward
 *
 * @property int $id
 * @property string $name
 * @property int $type_id
 * @property int $is_hide
 * @property int $district_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\District $district
 * @property-read \App\Models\WardType $type
 * @method static \Illuminate\Database\Eloquent\Builder|Ward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ward query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ward whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ward whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ward whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ward whereIsHide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ward whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ward whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ward whereUpdatedAt($value)
 */
	class Ward extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WardType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|WardType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WardType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WardType query()
 * @method static \Illuminate\Database\Eloquent\Builder|WardType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WardType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WardType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WardType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WardType whereUpdatedAt($value)
 */
	class WardType extends \Eloquent {}
}

