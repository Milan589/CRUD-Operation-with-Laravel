<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['records'] = Tag::all();
        return view('backend.tag.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tag.create');
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
            $records = Tag::create($request->all());
            if ($records) {
                $request->session()->flash('success', 'Record added successfully!!');
            } else {
                $request->session()->flash('error', 'Failed to add records');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }

        return redirect()->route('backend.tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['record'] = Tag::find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route('backend.tag.index');
        }
        return view('backend.tag.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['record'] = Tag::find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route('backend.tag.index');
        }
        return view('backend.tag.edit', compact('data'));
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
        $request->validate(
            [
                'title' => 'required',
                'slug' => 'required'
            ]
        );
        $data['record'] = Tag::find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route('backend.tag.index');
        }
        try {
            $request->request->add(['updated_by' => auth()->user()->id]);
            $record = $data['record']->update($request->all());
            if ($record) {
                $request->session()->flash('success', 'Tag updated successfully!!');
            } else {
                $request->session()->flash('error', 'Failed to add records');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }

        return redirect()->route('backend.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['record'] = Tag::find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route('backend.tag.index');
        }
        if ($data['record']->delete()) {
            request()->session()->flash('success', "Successfully Deleted");
            return redirect()->route('backend.tag.index');
        } else {
            request()->session()->flash('error', "Error: Delete failed");
            return redirect()->route('backend.tag.index');
        }
    }
    // to display deleted data
    public function trash()
    {
        $data['records'] = Tag::onlyTrashed()->get();
        return view('backend.tag.trash', compact('data'));
    }

    // to restore data
    public function restore(Request $request, $id)
    {
        $data['record'] = Tag::onlyTrashed()->where('id', $id)->first();
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route('backend.tag.index');
        }
        try {
            if ($data['record']) {
                $data['record']->restore();
                $request->session()->flash('success', 'Tag restored successfully!!');
            } else {
                $request->session()->flash('error', 'Failed to restore records');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }

        return redirect()->route('backend.tag.index');
    }
    
    //permanent delete from database
    public function permanentDelete($id)
    {
        $data['record'] = Tag::onlyTrashed()->where('id',$id)->first();
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route('backend.tag.index');
        }
        if ($data['record']->forceDelete()) {
            request()->session()->flash('success', "Successfully Deleted");
            return redirect()->route('backend.tag.index');
        } else {
            request()->session()->flash('error', "Error: Delete failed");
            return redirect()->route('backend.tag.index');
        }
    }
}
