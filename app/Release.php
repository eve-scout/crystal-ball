<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $revisionCreationsEnabled = true;

    protected $keepRevisionOf = array(
        'title',
        'release_date'
    );

    public function items()
    {
        return $this->hasMany('App\Item');
    }
}