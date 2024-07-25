<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Attributes of the model.
     */
    public const ATTR_ID = 'id';

    public const ATTR_NAME = 'name';
    public const ATTR_EMAIL = 'email';

    public const ATTR_PASSWORD = 'password';

    /**
     * Relations
     */
    public const RELATION_RESERVATIONS = 'reservations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_EMAIL,
        self::ATTR_PASSWORD,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::ATTR_PASSWORD,
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            self::ATTR_NAME=> 'string',
            self::ATTR_EMAIL =>'string',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getReservations(): Collection
    {
        return $this->getRelationValue(self::RELATION_RESERVATIONS);
    }
}
