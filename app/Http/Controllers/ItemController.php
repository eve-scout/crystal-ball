<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Item;
use App\Build;
use App\Release;
use Yajra\Datatables\Datatables;

use DraperStudio\Parsedown\Facades\Parsedown;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.items.index');
    }

    public function edit($id)
    {
        $item = Item::with('attachments', 'tagged')->findOrFail($id);
        $item->tagNames = implode(',', $item->tagNames());

        $builds = Build::orderBy('name')->lists('name', 'id');
        $releases = Release::orderBy('name')->lists('name', 'id');
        $typeahead_tags = Item::existingTags();

        return view('admin.items.edit', ['item' => $item, 'builds' => $builds, 'releases' => $releases, 'typeahead_tags' => $typeahead_tags]);
    }

    public function show($id, Request $request)
    {
        $item = Item::with('attachments', 'tagged')->findOrFail($id);

        $builds = Build::orderBy('name')->lists('name', 'id');
        $releases = Release::orderBy('name')->lists('name', 'id');

        return view('admin.items.edit', ['item' => $item, 'builds' => $builds, 'releases' => $releases]);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
    }

    public function create()
    {
        $builds = Build::orderBy('name')->lists('name', 'id');
        $releases = Release::orderBy('name')->lists('name', 'id');
        $typeahead_tags = Item::existingTags();

        return view('admin.items.create', ['builds' => $builds, 'releases' => $releases, 'typeahead_tags' => $typeahead_tags]);
    }

    public function update($id, Request $request)
    {
        // print_r($request);
        $this->validate($request, [
            'name' => 'required|max:255',
            'itemID' => 'required|max:255'
        ]);

        $item = Item::findOrFail($id);

        $item->itemID = $request->itemID;
        $item->name = $request->name;
        $item->build_id = $request->build;
        $item->release_id = $request->release;
        $item->status = $request->status;
        $item->description = $request->description;
        $item->notes = $request->notes;
        $item->save();

        if (! empty($request->tagNames)) {
            $item->retag($request->tagNames);
        } else {
            $item->untag();
        }

        return redirect('/admin/items');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'itemID' => 'required|max:255'
        ]);

        $item = new Item;
        $item->itemID = $request->itemID;
        $item->name = $request->name;
        $item->build_id = $request->build;
        $item->release_id = $request->release;
        $item->description = $request->description;
        $item->notes = $request->notes;
        $item->save();

        if (! empty($request->tagNames)) {
            $item->tag($request->tagNames);
        }

        return redirect('/admin/items');
    }

    public function mdPreview(Request $request)
    {
        return Parsedown::text($request->content);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $items = Item::join('builds', 'items.build_id', '=', 'builds.id')
            ->join('releases', 'items.release_id', '=', 'releases.id')
            ->select(['items.id', 'items.itemID', 'items.name', 'items.description', 'items.created_at', 'items.updated_at', 'builds.name as build_name', 'releases.name as release_name']);

        return Datatables::of($items)
            ->addColumn('action', function ($item) {
                return '<a href="items/'.$item->id.'/edit" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Update</a> <a href="items/'.$item->id.'/delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a>';
            })
            ->make(true);
    }
}
