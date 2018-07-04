<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'tb_vendor';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comp_title','comp_name', 'address', 'npwp', 'sap_num', 'created_at', 'updated_at'
    ];
}
