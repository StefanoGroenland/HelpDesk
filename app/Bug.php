<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bugs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id',
        'titel',
        'prioriteit',
        'status',
        'naam_contactpersoon',
        'naam_medewerker',
        'behandeld_door',
        'beschrijving',
        'soort'
    ];
    protected $guarded = ['id'];
}
