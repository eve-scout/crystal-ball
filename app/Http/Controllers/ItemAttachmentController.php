<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Item;
use App\Media;
use App\Build;
use App\Release;
use Yajra\Datatables\Datatables;

class ItemAttachmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    }

    public function edit($id)
    {
    }

    public function show($id)
    {
    }

    public function destroy($itemId, $mediaId)
    {
        $media = Media::findOrFail($mediaId);

        $media->delete();
    }

    public function create($itemId)
    {
    }

    public function update($itemId, $id, Request $request)
    {
        $media = Media::findOrFail($id);
        $media->name = $request->value;
        $media->save();

        return response()->json($media);
    }

    public function store($itemId, Request $request)
    {
        $media = new Media;
        $media->attachment = $request->attachment;
        $media->name = $media->attachment->originalFilename();

        if (! $media->attachment->getUploadedFile()->isImage())
        {
            $config = $media->attachment->getConfig();

            $options = array();
            $options['styles'] = ['original' => ''];
            $options['storage'] = $config->storage;
            $options['s3_client_config'] = $config->s3_client_config;
            $options['s3_object_config'] = $config->s3_object_config;
            $options['path'] = $config->path;
            $options['public_path'] = $config->public_path;
            $options['base_path'] = $config->base_path;
            $options['storage'] = $config->storage;
            $options['image_processing_library'] = $config->image_processing_library;
            $options['default_url'] = $config->default_url;
            $options['default_style'] = $config->default_style;

            $attachmentConfig = new \Codesleeve\Stapler\AttachmentConfig('attachment', $options);

            $media->attachment->setConfig($attachmentConfig);
        }

        $item = Item::findOrFail($itemId);

        $item->attachments()->save($media);

        $response = $media->toArray();
        $response['attachment'] = $media->attachment->jsonSerialize();

        return response()->json($response);
    }
}
