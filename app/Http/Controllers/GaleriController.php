<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris = Galeri::where('iduser',Auth::user()->id)->get();
        return view('timeline',['galeris'=>$galeris]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'foto'=>'required',
        ]);
        $namafoto = Auth::user()->id.'-'.date('YmdHis').
        $request->foto->getClientOriginalName();
        $data = [
            'judul'=>$request->judul,
            'deskripsi'=>$request->deskripsi,
            'tanggal'=>now(),
            'foto'=>$namafoto,
            'iduser'=>Auth::user()->id
        ];
        $request->foto->move(public_path('images'),$namafoto);
        Galeri::create($data);
        return redirect('/galeri');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        $galeri->delete();
        return redirect('galeri');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        if ($request->hasfile('foto')){
            $namafoto = Auth::user()->id.'-'.date('YmdHis').
            $request->foto->getClientOriginalName();
            $request->foto->move(public_path('images'),$namafoto);
            $galeri->judul = $request->judul;
            $galeri->deskripsi = $request->deskripsi;
            $galeri->tanggal = now();
            $galeri->foto = $namafoto;
            $galeri->iduser=Auth::user()->id;
            $galeri->save();
        }else{
            $galeri->judul = $request->judul;
            $galeri->deskripsi = $request->deskripsi;
            $galeri->tanggal = now();
            $galeri->foto = $galeri->foto;
            $galeri->iduser=Auth::user()->id;
            $galeri->save();
        }
        return redirect('/galeri');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        //
    }
}
