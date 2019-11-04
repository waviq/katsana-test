<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $guarded = [];

    public function position() {
        return $this->hasMany(Position::class,'trip_id');
    }
}
