<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    use \Conner\Tagging\Taggable;

    protected $revisionCreationsEnabled = true;

    protected $keepRevisionOf = array(
        'name',
        'itemID',
        'description',
        'notes',
        'status'
    );

    public function release()
    {
        return $this->belongsTo('App\Release');
    }

    public function build()
    {
        return $this->belongsTo('App\Build');
    }

    public function attachments()
    {
        return $this->hasMany('App\Media');
    }
}   