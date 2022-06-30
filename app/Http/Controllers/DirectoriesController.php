<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DirectoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $query = Directory::whereNull('directories_id')
            ->orderBy('id');

        if (!empty(session('search'))) {
            $query
                ->where('name', 'like', '%' . session('search') . '%')
                ->orWhere('path', 'like', '%' . session('search') . '%');
        }

        $directories = $query->get([
            'id',
            'name',
            'path',
            'directories_id'
        ]);

        return view('directory.home', [
            'directories' => $directories,
            'search' => session('search')
        ]);
    }

    /**
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function search()
    {
        return redirect('/')->with('search', request()->input('search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param mixed $directories_id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(mixed $directories_id = null)
    {
        return view('directory.save', [
            'method' => 'POST',
            'url' => '/',
            'data' => [
                'name' => null,
                'path' => null,
                'directories_id' => $directories_id
            ],
            'title' => 'New Directory',
            'btn_label' => 'Save'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $model = new Directory();
        $model->name = $request->input('name');
        $model->path = $request->input('path');
        $model->directories_id = $request->input('directories_id') ?? null;
        $model->save();

        $to = '/';
        if (!empty($request->input('directories_id'))) {
            $to = $request->input('directories_id') . '/files';
        }

        return redirect($to)->with('info', 'Directory saved successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $data = Directory::find($id, [
            'id',
            'name',
            'path',
            'directories_id'
        ]);

        return view('directory.save', [
            'method' => 'PUT',
            'url' => $id,
            'data' => [
                'name' => $data->name,
                'path' => $data->path,
                'directories_id' => $data->directories_id
            ],
            'title' => 'Edit Directory',
            'btn_label' => 'Edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $data = $request->all(['name', 'path', 'directories_id']);
        Directory::where('id', $id)->update($data);

        $to = '/';
        if (!empty($request->input('directories_id'))) {
            $to = $request->input('directories_id') . '/files';
        }

        return redirect($to)->with('info', 'Directory edited successfully!');
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete($id)
    {
        return view('directory.save', [
            'method' => 'DELETE',
            'url' => $id,
            'data' => [
                'name' => null,
                'path' => null,
                'directories_id' => null
            ],
            'title' => 'Delete Directory',
            'btn_label' => 'Delete'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Directory::destroy($id);
        return redirect('/')->with('info', 'Directory deleted successfully!');
    }
}
