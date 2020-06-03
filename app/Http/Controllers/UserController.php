<?php

namespace App\Http\Controllers;

use App\User;
use Session;
use App\Admin\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();

        foreach(auth()->user()->roles as $role){
            if($role->name !== 'administrator'){
                $user = User::where('id', '!=' , 1)->get();
                return view('admin.users.index')->with([
                    'users' => $user
                ]);
            }



        }
        return view('admin.users.index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=' ,'administrator')->get();

        return view('admin.users.create-edit')->with('roles', $roles);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required|unique:users',
            'password'  =>  'required',
            'image'     =>  'image'
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($image, PATHINFO_FILENAME);
            $new_name = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$new_name;
            $path = $request->file('image')->storeAs('public/userImage', $fileNameToStore);


        }else{
            $fileNameToStore = 'default.jpg';
        }



        $password = trim($request->password);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->image = $fileNameToStore;


        $user->save();

        $user->syncRoles($request->input('roles'));

        Session::flash('success','User Successfully Created');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $roles = auth()->user()->get();
        $user = User::where('id', $id)->with('roles')->first();
        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('name', '==', 'administrator')->get();

        if($role){
            $roles = Role::all();
            $user = User::where('id', $id)->with('roles')->first();

            return view('admin.users.create-edit')->with('user', $user)
                                                  ->with('roles', $roles);
        }

        $roles = Role::where('name', '!=' ,'administrator')->get();
        $user = User::where('id', $id)->with('roles')->first();

        return view('admin.users.create-edit')->with('user', $user)
                                              ->with('roles', $roles);
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
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required',
        ]);
        $user = User::findOrFail($id);

        if($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($image, PATHINFO_FILENAME);
            $new_name = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$new_name;
            $path = $request->file('image')->storeAs('public/userImage', $fileNameToStore);


        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($request->hasFile('image')){
            $user->image = $fileNameToStore;
        }

        $user->save();
        // $user->roles()->attach($request->roles);
        $user->syncRoles($request->input('roles'));

        Session::flash('success','User Successfully Updated');
        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        Session::flash('success','User Successfully Deleted');
        return redirect()->route('user.index');

    }
}
