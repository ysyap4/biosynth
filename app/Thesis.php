<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
	protected $table = 'thesis';
	protected $primaryKey = 'id';
    protected $fillable = [
        't_title', 't_studname', 't_sv', 't_type', 't_thesis',
    ];
}
