<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends BackendBaseController
{
    protected $module = 'Setting';
    protected  $base_view = 'backend.setting.';
    protected  $base_route = 'backend.setting.';
    // protected  $file_path = 'images' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'setting' . DIRECTORY_SEPARATOR;


    public function __construct(){
        // $this->model =new  Setting();
        $this->model = new Setting();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['records'] = Setting::orderby('created_at', 'desc')->get();
        return view($this->__loadDataToView($this->base_view . 'index'), compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Setting::count() > 0) {
            request()->session()->flash('error', $this->module . 'already exists');
            return redirect()->route($this->base_route . 'index');
        }
        return view($this->__loadDataToView($this->base_view . 'create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->request->add(['created_by' => Auth::user()->id]);
            if ($request->hasFile('image_file')) {
                $file = $request->file('image_file');
                $file_name = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . DIRECTORY_SEPARATOR . $this->file_path, $file_name);
                $request->request->add(['image' => $file_name]);
            }
            $record = $this->model->create($request->all());
            if ($record) {
                $request->session()->flash('success', $this->module . 'Created Successfully.');
            } else {
                $request->session()->flash('error', $this->module . 'Creation Failed!!');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }
        return redirect()->route($this->base_route . 'index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['record'] = $this->model->find($id);
        return view($this->__loadDataToView($this->base_view . 'show'), compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['settings'] = $this->model->pluck('name', 'id');
        $data['record'] = $this->model->find($id);
        if ($data['record']) {
            return view($this->__loadDataToView($this->base_view. 'edit'), compact('data'));
        } else {
            request()->session()->flash('error', 'Invalid Request');
            return redirect()->route($this->base_route . 'index');
        }
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

        try {
            $data['record'] = $this->model->find($id);
            $request->request->add(['updated_by' => Auth::user()->id]);
            if ($request->hasFile('image_file')) {
                $file = $request->file('image_file');
                $file_name = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . DIRECTORY_SEPARATOR . $this->file_path, $file_name);
                $request->request->add(['image' => $file_name]);
                unlink(public_path() . DIRECTORY_SEPARATOR . $this->file_path . $data['record']->image);
            }
            if ($data['record']->update($request->all())) {
                $request->session()->flash('success', $this->module . 'Created Successfully.');
            } else {
                $request->session()->flash('error', $this->module . 'Updated failed.');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }
        return redirect()->route($this->base_route . 'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data['record'] =  $this->model->find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route . 'index');
        }
        if ($data['record']->delete()) {
            request()->session()->flash('success', $this->module . " successfully Deleted");
            return redirect()->route($this->base_route . 'index');
        } else {
            request()->session()->flash('error', $this->module . " error: Delete failed");
            return redirect()->route($this->base_route . 'index');
        }
    }

    // to display deleted data
    public function trash()
    {
        $data['records'] =  $this->model->onlyTrashed()->get();
        return view($this->__LoadDataToView($this->base_view . 'trash'), compact('data'));
    }

    // to restore data
    public function restore(Request $request, $id)
    {
        $data['record'] =  $this->model->onlyTrashed()->where('id', $id)->first();
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route . 'index');
        }
        try {
            if ($data['record']) {
                $data['record']->restore();
                $request->session()->flash('success', $this->module . ' restored successfully!!');
            } else {
                $request->session()->flash('error', $this->module . ' failed to restore records');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }
        return redirect()->route($this->base_route . 'index');
    }

    //permanent delete from database
    public function permanentDelete($id)
    {
        $data['record'] =  $this->model->onlyTrashed()->where('id', $id)->first();
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route . 'index');
        }
        if ($data['record']->forceDelete()) {
            request()->session()->flash('success', $this->module . " successfully Deleted");
            return redirect()->route($this->base_route . 'index');
        } else {
            request()->session()->flash('error', $this->module . " error: Delete failed");
            return redirect()->route($this->base_route . 'index');
        }
    }
}
