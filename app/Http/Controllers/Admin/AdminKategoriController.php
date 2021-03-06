<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AdminKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Kategori::paginate(10)->all();

        return view('admin.kategori', ['posts' => $posts]);
    
    }

    public function kota()
    {
        return view("admin.kategori-kota");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->route('admin.kategori');
        }

        $kategori = Kategori::create([
            'name' => $request->name
        ]);

        if($kategori){
            return redirect()->route('admin.kategori');
        }else{
            return redirect()->route('admin.kategori');
        }
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
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->route('admin.kategori');
        }

        $data_upload = $request->all();
        unset($data_upload['_token']);
        $kategori = Kategori::where('id',$id)->update($data_upload);
        if ($kategori) {
            return redirect()->route('admin.kategori');
        } else {
            return redirect()->route('admin.kategori');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('admin.kategori');
    }
}
