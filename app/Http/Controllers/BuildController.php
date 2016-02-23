<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;

use App\Build;

class BuildController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.builds.index');
    }

    public function edit($id)
    {
        $build = Build::findOrFail($id);

        return view('admin.builds.edit', ['build' => $build]);
    }

    public function show($id)
    {
        $build = Build::findOrFail($id);

        return view('admin.builds.edit', ['build' => $build]);
    }

    public function destroy($id)
    {
        $build = Build::findOrFail($id);
    }

    public function create()
    {
        $build = new Build;

        return view('admin.builds.create', ['build' => $build]);
    }

    public function update($id, Request $request)
    {
        $build = Build::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $build->name = $request->name;
        $build->build_date = $request->build_date;
        $build->save();

        return redirect('/admin/builds');
    }

    public function store(Request $request)
    {
        // print_r($request);
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $build = new Build;
        $build->name = $request->name;
        $build->build_date = $request->build_date;
        $build->save();

        return redirect('/admin/builds');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $builds = Build::select(['id', 'name', 'build_date']);

        return Datatables::of($builds)
            ->addColumn('action', function ($build) {
                return '<a href="builds/'.$build->id.'/edit" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Update</a> <a href="items/'.$build->id.'/delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a>';
            })
            ->make(true);
    }
}