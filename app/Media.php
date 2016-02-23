<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Media extends Model implements StaplerableInterface
{
    use EloquentTrait;

    protected $fillable = ['attachment', 'name'];

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('attachment', [
            'styles' => [
                // 'medium' => '300x300',
                // 'thumb' => '100x100'
            ],
            'storage' => 's3',
            's3_client_config' => [
                'region' => env('AWS_REGION', ''),
                'scheme' => 'https',
                'key' => env('AWS_KEY', ''),
                'secret' => env('AWS_SECRET', ''),
            ],
            's3_object_config' => [
                'Bucket' => env('AWS_BUCKET', '')
            ]
        ]);

        parent::__construct($attributes);
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}