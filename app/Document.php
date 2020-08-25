<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * Disable autoincrementing id
     * @var
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'meta',
        'actions',
        'actor',
        'payload',
    ];

    /**
     * Default attributes for document.
     *
     * @var array
     */
    protected $attributes = ['status' => 'draft'];
}
