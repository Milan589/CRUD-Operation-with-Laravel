<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use App\Models\Backend\Tag;
use Illuminate\Http\Request;
use App\Models\User;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['records'] = Tag::all();
        return view('backend.brand.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required',
                'slug' => 'required'
            ]
        );
        try {
            $request->request->add(['created_by' => auth()->user()->id]);
            $records = Brand::create($request->all());
            if ($records) {
                $request->session()->flash('success', 'Record added successfully!!');
            } else {
                $request->session()->flash('error', 'Failed to add records');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }

        return redirect()->route('backend.brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['record'] = Brand::find($id);
        return view('backend.brand.show', compact('data'));
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
