<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\Category;

use Illuminate\Support\Str;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asets=Aset::getAllAset();
        // return $asets;
        return view('backend.aset.index')->with('asets',$asets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::where('is_parent',1)->get();
        // return $category;
        return view('backend.aset.create')->with('categories',$category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'status'=>'required|in:active,inactive',
        ]);

        $data=$request->all();
        // return $data;
        $status=Aset::create($data);
        if($status){
            session()->flash('success','aset Successfully added');
        }
        else{
            session()->flash('error','Please try again!!');
        }
        return redirect()->route('aset.index');

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
        $aset=Aset::findOrFail($id);
        $category=Category::where('is_parent',1)->get();
        $items=Aset::where('id',$id)->get();
        // return $items;
        return view('backend.aset.edit')->with('aset',$aset)
                    ->with('categories',$category)->with('items',$items);
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
        $aset=Aset::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'status'=>'required|in:active,inactive',
        ]);

        $data=$request->all();
        // return $data;
        $status=$aset->fill($data)->save();
        if($status){
            session()->flash('success','Aset Successfully updated');
        }
        else{
            session()->flash('error','Please try again!!');
        }
        return redirect()->route('aset.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aset=Aset::findOrFail($id);
        $status=$aset->delete();
        
        if($status){
            session()->flash('success','aset successfully deleted');
        }
        else{
            session()->flash('error','Error while deleting aset');
        }
        return redirect()->route('aset.index');
    }
}
