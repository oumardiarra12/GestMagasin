<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Categorie;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

   // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }
    public function index(){
        $users=User::all();
        $categories=Categorie::all();
        return view('pages.users.index',compact('users','categories'));
    }
    public function create(){
        $categories=Categorie::all();
        return view('pages.users.create',compact('categories'));
    }

    public function store(StoreUserRequest $request)
    {
        $imageName="";
        if($request->file('photo_user')){
            $imageName = time().'.'.$request->photo_user->extension();
            $request->photo_user->storeAs('public/users', $imageName);
        }else {
            $imageName="default.jpg";
        }
        User::create([
            'nom_user'=>$request->nom_user,
            'prenom_user'=>$request->prenom_user,
            'photo_user'=>$imageName,
            'telephone_user'=>$request->telephone_user,
            'adresse_user'=>$request->adresse_user,
            'categorie_id'=>$request->categorie_id,
            'email'=>$request->email,
            'password'=>$request->password
        ]);

        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }
    // public function show($id){
    //     $user=User::findOrFail($id);
    //     return view('pages.users.show',compact('user'));
    // }
    public function edit($id){
        $user=User::findOrFail($id);
        $categories=Categorie::all();
        return response()->json(array('user'=>$user,'categories'=>$categories));
        //return view('pages.users.edit',compact('user','categories'));
    }
    public function update(UpdateUserRequest $request,$id){
        $user=User::findOrFail($id);
        $imageName="userdefault.jpg";
        if($request->file('photo_user')){
            $image_path = public_path('users/'.$user->photo_user);
            if(file_exists($image_path)){
              unlink($image_path);
            }
            $imageName = time().'.'.$request->photo_user->extension();
            $request->photo_user->storeAs('public/users', $imageName);
            $user->photo_user=$imageName;
            $user->save();
        }

        $user->nom_user=$request->nom_user;
        $user->prenom_user=$request->prenom_user;
        $user->photo_user=$imageName;
        $user->telephone_user=$request->telephone_user;
        $user->adresse_user=$request->adresse_user;
        $user->categorie_id=$request->categorie_id;
        $user->email=$request->email;
        if($request->password){
            $user->password=$request->password;
        }
        $user->save();

        // Session::flash('notification.type', 'success');
        // Session::flash('notification.message', "L'élément a été bien modifié !");
        return response()->json(['success'=>'User Update successfully.']);
        //return redirect()->route('utilisateur.index');
    }
    public function delete($id){
        $user = User::findOrFail($id);
        $image_path = public_path('users/'.$user->photo_user);
        if(file_exists($image_path)){
          unlink($image_path);
        }
        $user->delete();

        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien supprimé !");

        return redirect()->back();
    }

}
