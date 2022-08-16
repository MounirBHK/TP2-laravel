<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.registration');
    }
    
        
    /**
     * userLogin
     *
     * @param  mixed $request
     * @return void
     */
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credIdents = $request->only('email', 'password');

        if (!Auth::validate($credIdents)):
            return redirect('login')->withErrors(trans('auth.failed'));
        endif;

        // obtenir le fournisseur -> récupérer par identifiants
        $user = Auth::getProvider()->retrieveByCredentials($credIdents);
        Auth::login($user, $request->get('remember'));
        Session::put('id', $user->id);

        $name = User::select('name')->where('id', $user->id)->get();
        

        return redirect()->intended('dashboard')->withSuccess($name[0]->name);
    }
    
    /**
     * dashboard
     *
     * @return void
     */
    public function dashboard(){

        $name = "Invité";
        $id = null;
        if(Auth::check()){
            $name = Auth::user()->name;
            $id = Auth::user()->id;
        }

        return view('layouts.dashboard', ['name' => $name, 'id' => $id]);
    }

    
    /**
     * logout
     *
     * @return void
     */
    public function logout(){
        Session::flush();
        Auth::logout();

        return view('welcome');
    }

        
    /**
     * Store a newly created resource in storage.
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:10|confirmed',
            'password_confirmation' => 'required|min:3',
        ]);

        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        $listeVilles = Ville::all();

        $newEtudiant = Etudiant::create([
            'userId' => $user->id,
            'villeId' => 1,
        ]);
        
        return redirect(route('login'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
