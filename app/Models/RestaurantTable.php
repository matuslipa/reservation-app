<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantTable extends Model
{
    use HasFactory;

    /**
     * Attributes of the model.
     */
    public const ATTR_ID = 'id';

    public const ATTR_NAME = 'name';
    public const ATTR_SEATS = 'seats';

    /**
     * Relations
     */
    public const RELATION_RESERVATIONS = 'reservations';

    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_SEATS
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            self::ATTR_NAME => 'string',
            self::ATTR_SEATS => 'integer',
        ];
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
