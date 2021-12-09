<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AdminKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Kendaraan::with('user','transaksi')->get();
        $pemiliks = User::where('role','pemilik')->orderBy('id','DESC')->get();
        $kategoris = Kategori::get();
        // dd($posts);
        return view('admin.kendaraan', [
            'posts' => $posts,
            'pemiliks' => $pemiliks,
            'kategoris' => $kategoris
        ]);
    }

    public function dipesan()
    {
        $transaksis = Transaksi::where('status','Proses')->get();
        return view('admin.kendaraan-dipesan',[
            'transaksis' => $transaksis
        ]);
    }

    public function selesai()
    {
        $transaksis = Transaksi::where('status','Selesai')->get();
        return view('admin.kendaraan-selesai',[
            'transaksis' => $transaksis
        ]);
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
            'user_id' => 'required|integer',
            'kategori_id' => 'required|integer',
            'name' => 'required',
            'kota' => 'required',
            'seat' => 'required',
            'nopol' => 'required',
            'harga' => 'required|integer',
            'tahun' => 'required|integer',
            'transmisi' => 'required',
            'mesin' => 'required',
            'warna' => 'required',
            'image_link' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->route('admin.kendaraan');
        }

        $uploadFolder = "image/car/";
        $image = $request->file('image_link');
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move(public_path($uploadFolder), $imageName);
        $image_link = $uploadFolder.$imageName;
        

        $kendaraan = Kendaraan::create([
            'user_id' => $request->user_id,
            'kategori_id' => $request->kategori_id,
            'name' =>  $request->name,
            'kota' =>  $request->kota,
            'seat' =>  $request->seat,
            'nopol' => $request->nopol,
            'harga' =>  $request->harga,
            'tahun' =>  $request->tahun,
            'transmisi' =>  $request->transmisi,
            'mesin' =>  $request->mesin,
            'warna' =>  $request->warna,
            'supir' =>  1,
            'image_link' => $image_link,
         ]);
         if($kendaraan){ //cek apakah sukses create 
            //jika sukses
            return redirect()->route('admin.kendaraan');

         }else{
             //jika gagal
             return redirect()->route('admin.kendaraan');
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
            'kategori_id' => 'required|integer',
            'nopol' => 'required',
            'seat' => 'required',
            'harga' => 'required|integer',
            'tahun' => 'required|integer'
        ]);

        if($validator->fails())
        {
            return redirect()->route('admin.kendaraan');
        }

        $data_upload = $request->all();
        unset($data_upload['_token']);
        // dd($request->has('image_link'));
        if($request->has('image_link'))
        {
            $uploadFolder = "image/car/";
            $image = $request->file('image_link');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;
            $data_upload['image_link'] = $image_link;
        }

        $kendaraan = Kendaraan::where('id',$id)->update($data_upload);
        if ($kendaraan) {
            return redirect()->route('admin.kendaraan');
        } else {
            return redirect()->route('admin.kendaraan');
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
        $user = Kendaraan::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.kendaraan');
    }
}
