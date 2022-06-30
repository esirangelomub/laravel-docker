<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $directories_id
     * @return Response
     */
    public function index(int $directories_id)
    {
        $collection = Directory::with(
            [
                'files' => function($query) {
                    $query->select([
                        'id',
                        'name',
                        'file_size',
                        'path',
                        'directories_id'
                    ]);
                }
            ])
            ->orderBy('id')
            ->find($directories_id,
                [
                    'id',
                    'name',
                    'path',
                    'directories_id'
                ]
            );

        return view('file.home', ['collection' => $collection]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
