<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $directories_id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(int $directories_id)
    {
        $collection = Directory::with(
            [
                'parent_directories' => function($query) {
                    $query
                        ->select([
                            'id',
                            'name',
                            'path',
                            'directories_id'
                        ])
                        ->orderBy('name');

                    if (!empty(session('search'))) {
                        $query
                            ->where('name', 'like', '%' . session('search') . '%')
                            ->orWhere('path', 'like', '%' . session('search') . '%');
                    }
                },
                'files' => function($query) {
                    $query->select([
                            'id',
                            'name',
                            'file_size',
                            'path',
                            'directories_id'
                        ])
                        ->orderBy('name');

                    if (!empty(session('search'))) {
                        $query
                            ->where('name', 'like', '%' . session('search') . '%')
                            ->orWhere('path', 'like', '%' . session('search') . '%');
                    }
                }
            ])
            ->find($directories_id,
                [
                    'id',
                    'name',
                    'path',
                    'directories_id'
                ]
            );

        return view('file.home', [
            'title' => 'Directories/Files from ' . $collection->name,
            'collection' => $collection,
            'search' => session('search')
        ]);
    }

    public function search(int $directories_id)
    {
        return redirect('/files/' . $directories_id)->with('search', request()->input('search'));
    }

    /**
     * @param int $directories_id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(int $directories_id)
    {
        return view('file.save', [
            'method' => 'POST',
            'url' => $directories_id . '/files',
            'data' => [
                'name' => null,
                'path' => null,
                'file_size' => null,
                'directories_id' => $directories_id
            ],
            'title' => 'New File',
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

        $model = new File();
        $model->name = $request->input('name');
        $model->file_size = $request->input('file_size');
        $model->path = $request->input('path');
        $model->directories_id = $request->input('directories_id') ?? null;
        $model->save();

        $to = $request->input('directories_id') . '/files';

        return redirect($to)->with('info', 'File saved successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $directories_id
     * @param int $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $directories_id, int $id)
    {
        $data = File::find($id, [
            'id',
            'name',
            'file_size',
            'path',
            'directories_id'
        ]);

        return view('file.save', [
            'method' => 'PUT',
            'url' => $directories_id . '/files/' . $id,
            'data' => [
                'name' => $data->name,
                'file_size' => $data->file_size,
                'path' => $data->path,
                'directories_id' => $directories_id
            ],
            'title' => 'Edit File',
            'btn_label' => 'Edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $directories_id
     * @param int $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $directories_id, int $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $data = $request->all(['name', 'path', 'file_size', 'directories_id']);
        File::where('id', $id)->update($data);

        $to = $request->input('directories_id') . '/files';

        return redirect($to)->with('info', 'File edited successfully!');
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param int $directories_id
     * @param int $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(int $directories_id, int $id)
    {
        return view('file.save', [
            'method' => 'DELETE',
            'url' => $directories_id . '/files/' . $id,
            'data' => [
                'name' => null,
                'path' => null,
                'directories_id' => null
            ],
            'title' => 'Delete File',
            'btn_label' => 'Delete'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $directories_id
     * @param int $id
     * @return void
     */
    public function destroy(int $directories_id, int $id)
    {
        File::destroy($id);
        $to = $directories_id . '/files';
        return redirect($to)->with('info', 'File deleted successfully!');
    }
}
