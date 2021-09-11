<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityGroup extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'campaign_id'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class)->withTrashed();
    }
}
