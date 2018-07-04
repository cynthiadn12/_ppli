<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FLocation extends Model
{
    protected $table = 'tb_loc_lvl1';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loc_lvl1', 'created_at', 'updated_at'
    ];
}
