<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Attributes of the model.
     */
    public const ATTR_ID = 'id';

    public const ATTR_USER_ID = 'user_id';

    public const ATTR_RESTAURANT_TABLE_ID = 'restaurant_table_id';
    public const ATTR_RESERVATION_TIME = 'reservation_time';

    /**
     * Relations
     */
    public const RELATION_USER = 'user';
    public const RELATION_RESTAURANT_TABLE = 'restaurantTable';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTR_USER_ID,
        self::ATTR_RESERVATION_TIME,
        self::ATTR_RESTAURANT_TABLE_ID
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \App\Models\User
     */
    public function getUser(): User
    {
        return $this->getRelationValue(self::RELATION_USER);
    }

    /**
     * @return \App\Models\RestaurantTable
     */
    public function getRestaurantTable(): RestaurantTable
    {
        return $this->getRelationValue(self::RELATION_RESTAURANT_TABLE);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurantTable(): BelongsTo
    {
        return $this->belongsTo(RestaurantTable::class);
    }
}
