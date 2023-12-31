<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Address extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    protected $table = 'address';

    protected $fillable = [
        'address',
        'user_id',
        'status',
        'name',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
