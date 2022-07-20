<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Category;
use App\Models\Backend\Option;
use App\Models\Backend\Product;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Tag;
use App\Models\Backend\OptionProduct;
use App\Models\Backend\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends BackendBaseController
{
    // optimization of code
    protected $base_route = 'backend.product.';
    protected $base_view = 'backend.product.';
    protected $module = 'Product';

    public function __construct()
    {
        $this->model = new Product();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['records'] =  $this->model->all();
        return view($this->__LoadDataToView($this->base_view . 'index'), compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data['categories']=Category::all();
        $data['categories'] = Category::pluck('title', 'id');
        $data['subcategories'] = Subcategory::pluck('title', 'id');
        $data['tags'] = Tag::pluck('title', 'id');
        $data['attributes'] = Option::pluck('title', 'id');
        return view($this->__LoadDataToView($this->base_view . 'create'), compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'title' => 'required',
                'slug' => 'required',
                'price' => 'required',
            ]
        );
        DB::beginTransaction();
        try {
            $request->request->add(['stock' => $request->quantity]);
            $request->request->add(['created_by' => auth()->user()->id]);
            $record =  $this->model->create($request->all());
            if ($record) {
                $record->tags()->attach($request->input('tag_id'));
                $option_ids = $request->input('attribute_id');
                $option_values = $request->input('attribute_value');

                //for option_product_table
                $product_option_data['product_id'] = $record->id;
                for ($i = 0; $i < count($option_values); $i++) {
                    if (!empty($option_ids[$i]) && !empty($option_values[$i])) {
                        $product_option_data['option_id'] = $option_ids[$i];
                        $product_option_data['attribute_value'] = $option_values[$i];
                        OptionProduct::create($product_option_data);
                    }
                }
                //process to store image
                $product_image_data['product_id'] = $record->id;
                $image_titles = $request->input('image_title');
                $image_files = $request->file('image_file');

                for ($i = 0; $i < count($image_files); $i++) {
                    $product_image_data['image_title'] = $image_titles[$i];
                    $pimage = $image_files[$i];
                    $image_name = uniqid() . '_' . $pimage->getClientOriginalName();
                    $pimage->move('images/products/', $image_name);
                    $product_image_data['image_name'] = $image_name;
                    ProductImage::create($product_image_data);
                }
                $request->session()->flash('success', $this->module . ' record added successfully!!');
            } else {
                $request->session()->flash('error', $this->module . ' failed to add records');
            }
            DB::commit();
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
            DB::rollback();
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
        $data['record'] =  $this->model->find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route . 'index');
        }
        return view($this->__LoadDataToView($this->base_view . 'show'), compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories'] = Category::pluck('title', 'id');
        $data['record'] =  $this->model->find($id);
        if (!$data['record']) {
            request()->session()->flash('error', 'Error: Invalid Request');
            return redirect()->route($this->base_route . 'index');
        }
        return view($this->__LoadDataToView($this->base_view . 'edit'), compact('data'));
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
            return redirect()->route($this->base_route . 'index');
        }
        try {
            $request->request->add(['updated_by' => auth()->user()->id]);
            $record = $data['record']->update($request->all());
            if ($record) {
                $request->session()->flash('success', $this->module . ' updated successfully!!');
            } else {
                $request->session()->flash('error', $this->module . ' failed to add records');
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
    public function destroy($id)
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
