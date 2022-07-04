<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends BackendBaseController
{
    // optimization of code
    protected $base_route = 'backend.subcategory.';
    protected $base_view = 'backend.subcategory.';
    protected $module= 'Subcategory';

    public function __construct(){
        $this->model =new Subcategory();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['records'] =  $this->model->all();
        return view($this->__LoadDataToView($this->base_view .'index'), compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data['categories']=Category::all();
        $data['categories'] = Category::pluck('title','id');
        return view($this->__LoadDataToView($this->base_view .'create'),compact('data'));
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
                'slug' => 'required',
                'rank'=> 'required'
            ]
        );
        try {
            $request->request->add(['created_by' => auth()->user()->id]);
            $records =  $this->model->create($request->all());
            if ($records) {
                $request->session()->flash('success', $this->module .' record added successfully!!');
            } else {
                $request->session()->flash('error', $this->module .' failed to add records');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }

        return redirect()->route($this->base_route .'index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['record'] =  $this->model->find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route .'index');
        }
        return view($this->__LoadDataToView($this->base_view .'show'), compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories'] = Category::pluck('title','id');
        $data['record'] =  $this->model->find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route .'index');
        }
        return view($this->__LoadDataToView($this->base_view .'edit'), compact('data'));
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
        $data['record'] =  $this->model->find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route .'index');
        }
        try {
            $request->request->add(['updated_by' => auth()->user()->id]);
            $record = $data['record']->update($request->all());
            if ($record) {
                $request->session()->flash('success', $this->module .' updated successfully!!');
            } else {
                $request->session()->flash('error', $this->module .' failed to add records');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }

        return redirect()->route($this->base_route .'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['record'] =  $this->model->find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route .'index');
        }
        if ($data['record']->delete()) {
            request()->session()->flash('success', $this->module ." successfully Deleted");
            return redirect()->route($this->base_route .'index');
        } else {
            request()->session()->flash('error', $this->module ." error: Delete failed");
            return redirect()->route($this->base_route .'index');
        }
    }
    // to display deleted data
    public function trash()
    {
        $data['records'] =  $this->model->onlyTrashed()->get();
        return view($this->__LoadDataToView($this->base_view .'trash'), compact('data'));
    }

    // to restore data
    public function restore(Request $request, $id)
    {
        $data['record'] =  $this->model->onlyTrashed()->where('id', $id)->first();
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route .'index');
        }
        try {
            if ($data['record']) {
                $data['record']->restore();
                $request->session()->flash('success', $this->module .' restored successfully!!');
            } else {
                $request->session()->flash('error', $this->module .' failed to restore records');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }

        return redirect()->route($this->base_route .'index');
    }
    
    //permanent delete from database
    public function permanentDelete($id)
    {
        $data['record'] =  $this->model->onlyTrashed()->where('id',$id)->first();
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route .'index');
        }
        if ($data['record']->forceDelete()) {
            request()->session()->flash('success', $this->module ." successfully Deleted");
            return redirect()->route($this->base_route .'index');
        } else {
            request()->session()->flash('error', $this->module ." error: Delete failed");
            return redirect()->route($this->base_route .'index');
        }
    }
}
