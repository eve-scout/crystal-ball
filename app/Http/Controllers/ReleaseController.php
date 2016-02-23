<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;

use App\Release;

class ReleaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.releases.index');
    }

    public function edit($id)
    {
        $release = Release::findOrFail($id);

        return view('admin.releases.edit', ['release' => $release]);
    }

    public function show($id)
    {
        $release = Release::findOrFail($id);

        return view('admin.releases.edit', ['release' => $release]);
    }

    public function destroy($id, Request $request)
    {
        $release = Release::with('items')->findOrFail($id);
        if($release->items()->count() > 0) {
            $request->session()->flash('flash_error', 'Unable to delete Release since an Item is using it.');
        }
        else {
         $release->delete();
        }

        return redirect('/admin/releases');
    }

    public function create()
    {
        $release = new Release;

        return view('admin.releases.create', ['release' => $release]);
    }

    public function update($id, Request $request)
    {
        $release = Release::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $release->name = $request->name;
        $release->release_date = $request->release_date;
        $release->save();

        return redirect('/admin/releases');
    }

    public function store(Request $request)
    {
        // print_r($request);
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $release = new Release;
        $release->name = $request->name;
        $release->release_date = $request->release_date;
        $release->save();

        return redirect('/admin/releases');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $releases = Release::select(['id', 'name', 'release_date']);

        return Datatables::of($releases)
            ->addColumn('action', function ($release) {
                return '<a href="/admin/releases/'.$release->id.'/edit" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Update</a> <a href="/admin/releases/'.$release->id.'/destroy" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a>';
            })
            ->make(true);
    }
}
