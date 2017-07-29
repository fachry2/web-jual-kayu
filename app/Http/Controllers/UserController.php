<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Usaha;
use App\Produk;
use App\Role;
use App\WishList;
use App\Transformers\UserTransformer;
use Auth;
use JWTAuth;
use JWTException;
use Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Closure;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //$dataUsaha = DB::select('SELECT usr.id, usr.nama, usr.username, usr.email, usr.foto as "profil_user", ush.nama_usaha, ush.alamat_usaha, ush.foto "profil_usaha" from users usr INNER JOIN usaha ush on usr.id = ush.id_user WHERE ush.id_user='.auth()->user()->id);
        // if($dataUsaha==[]){
        //     return null;
        // }
        //return "false";
        //return dd($dataUsaha);    
        
//        $user = User::find(auth()->user()->id);
        //return dd(auth()->user()->usaha->nama_usaha);
        return view('user.index');
    }
    public function dashboard(){
        return view('user.dashboard');
    }
    public function pesanan_produk(){
        return view('user.pesanan-produk');
    }
    public function pesanan_tender(){
        return view('user.pesanan-tender');
    }
    public function wishlist(){
        return view('user.wishlist');
    }
    public function buka_toko(){
        return view('user.buka-usaha');
    }

    public function users(User $user){
        $users = $user->all();

        return fractal()
            ->collection($users)
            ->transformWith(new UserTransformer)
            ->toArray();
    }

    public function profile(User $user){
        $user = $user->find(Auth::user()->id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer())
            -> addMeta([
                'token' => $user->api_token
            ])
            ->toArray();
    }


    public function postUsaha(Request $request){
        $this->validate($request, [
            'nama' => 'required|min:3',
            'provinsi' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
            'gambar' => 'required'
        ]);

        $file = Input::file('gambar');
        $destinationPath = 'profil_usaha';
        $extension = $file->getClientOriginalExtension();
        $filename = rand(11111,99999).".".$extension;
        $upload_success = $file->move($destinationPath, $filename);

        Usaha::create([
            'id_user' => Auth::user()->id,
            'nama_usaha' => $request['nama'],
            'id_provinsi' => $request['provinsi'],
            'id_kota' => $request['kota'],
            'alamat_usaha' => $request['alamat'],
            'foto' => $filename
        ]);

        return dd($request->all());
        return redirect('/user/usaha');
    }

    //WishList
    public function add_to_wishlist(Request $request, WishList $wishlist){
        if(auth()->user()){
            $wishlist->id_user = $request->id_user;
            $wishlist->id_produk = $request->id_produk;
            $wishlist->save();
            return back();
        }else{
            return redirect('/login');
        }
        // $this->validate($request, [
        //     'id_user' => 'required',
        //     'id_produk' => 'required',
        // ]);
    }


    public function delete_wishlist(Request $request){
        $id = $request->id;
        DB::select('delete from wishlist where id='.$id);
        return back();
    }

    public function formChat(){
        return view('user.chat');
    }



    // public function index(Request $request)
    // {
    //     $data = User::orderBy('id','DESC')->paginate(5);
    //     return view('users.index',compact('data'))
    //         ->with('i', ($request->input('page', 1) - 1) * 5);
    // }

    //     /**

    //  * Show the form for creating a new resource.

    //  *

    //  * @return \Illuminate\Http\Response

    //  */

    // public function create()

    // {

    //     $roles = Role::pluck('display_name','id');

    //     return view('users.create',compact('roles'));

    // }


    // /**

    //  * Store a newly created resource in storage.

    //  *

    //  * @param  \Illuminate\Http\Request  $request

    //  * @return \Illuminate\Http\Response

    //  */

    // public function store(Request $request)

    // {

    //     $this->validate($request, [

    //         'name' => 'required',

    //         'email' => 'required|email|unique:users,email',

    //         'password' => 'required|same:confirm-password',

    //         'roles' => 'required'

    //     ]);


    //     $input = $request->all();

    //     $input['password'] = Hash::make($input['password']);


    //     $user = User::create($input);

    //     foreach ($request->input('roles') as $key => $value) {

    //         $user->attachRole($value);

    //     }


    //     return redirect()->route('users.index')

    //                     ->with('success','User created successfully');

    // }


    // /**

    //  * Display the specified resource.

    //  *

    //  * @param  int  $id

    //  * @return \Illuminate\Http\Response

    //  */

    // public function show($id)

    // {

    //     $user = User::find($id);

    //     return view('users.show',compact('user'));

    // }


    // /**

    //  * Show the form for editing the specified resource.

    //  *

    //  * @param  int  $id

    //  * @return \Illuminate\Http\Response

    //  */

    // public function edit($id)

    // {

    //     $user = User::find($id);

    //     $roles = Role::lists('display_name','id');

    //     $userRole = $user->roles->lists('id','id')->toArray();


    //     return view('users.edit',compact('user','roles','userRole'));

    // }


    // /**

    //  * Update the specified resource in storage.

    //  *

    //  * @param  \Illuminate\Http\Request  $request

    //  * @param  int  $id

    //  * @return \Illuminate\Http\Response

    //  */

    // public function update(Request $request, $id)

    // {

    //     $this->validate($request, [

    //         'name' => 'required',

    //         'email' => 'required|email|unique:users,email,'.$id,

    //         'password' => 'same:confirm-password',

    //         'roles' => 'required'

    //     ]);


    //     $input = $request->all();

    //     if(!empty($input['password'])){ 

    //         $input['password'] = Hash::make($input['password']);

    //     }else{

    //         $input = array_except($input,array('password'));    

    //     }


    //     $user = User::find($id);

    //     $user->update($input);

    //     DB::table('role_user')->where('user_id',$id)->delete();


        

    //     foreach ($request->input('roles') as $key => $value) {

    //         $user->attachRole($value);

    //     }


    //     return redirect()->route('users.index')

    //                     ->with('success','User updated successfully');

    // }


    // /**

    //  * Remove the specified resource from storage.

    //  *

    //  * @param  int  $id

    //  * @return \Illuminate\Http\Response

    //  */

    // public function destroy($id)

    // {

    //     User::find($id)->delete();

    //     return redirect()->route('users.index')

    //                     ->with('success','User deleted successfully');

    // }

}
