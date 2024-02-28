<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }
    public function login(){
         return view('login');
    }                
    public function register(){
        return view('register');
    }

    public function SaveRegister(Request $request){
        $data = $request->validate(
        [
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'password'=>'required',

        ]
        );
        $simpan = [
            'name'=>$data['name'],
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
        ];
        $data = user::create($simpan);
        return redirect('/');
    }

    public function proseslogin(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        $data = $request->only(['username','password']);
    if(Auth::attempt($data)){
    return redirect('/galeri');
    }else{
        return redirect('/');
    }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function logout()
    {
        Auth::logout('logout');
        session()->flush();
        return redirect('/');
    }

   
}
