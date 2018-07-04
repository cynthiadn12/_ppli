<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    protected $table = 'tb_fish';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fish_name','pict', 'type', 'size', 'description', 'created_at', 'updated_at'
    ];
}
