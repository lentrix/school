<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Classes;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('lname')->orderBy('fname')->where('active',1)->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'username' => 'required',
            'password' => 'required|confirmed',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'address' => 'required',
            'dept_id' => 'required|numeric'
        ]);

        $user = User::create([
            'username' => $request['username'],
            'lname' => $request['lname'],
            'fname' => $request['fname'],
            'mname' => $request['mname'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'field' => $request['field'],
            'dept_id' => $request['dept_id'],
            'active' => 1,
            'password' => bcrypt($request['password'])
        ]);

        return redirect("/users/$user->id")->with('Info','New User created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user->id === auth()->user()->id || auth()->user()->hasRole('admin')) {
            return view('users.edit', compact('user'));
        }else {
            return redirect()->back()->with('Error', 'Only administrators can edit other people\'s profile.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'username' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'address' => 'required',
            'dept_id' => 'required|numeric'
        ]);

        $user->update([
            'username' => $request['username'],
            'lname' => $request['lname'],
            'fname' => $request['fname'],
            'mname' => $request['mname'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'field' => $request['field'],
            'dept_id' => $request['dept_id'],
        ]);

        return redirect("/users/$user->id")->with('Info','User profile has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request) {
        $key = $request['search'];
        $users = User::where('username','like', "%$key%")
                ->orWhere('lname','like',"%$key%")
                ->orWhere('fname','like',"%$key%")->get();

        return view('users.index', compact('users'));
    }

    public function changePasswordForm(User $user) {
        return view('users.change-password', compact('user'));
    }

    public function changePassword(User $user, Request $request) {

        if(!auth()->user()->hasRole('admin')) {
            $this->validate($request, [
                'new_password' => 'required|confirmed',
                'current_password'=>'required'
            ]);
        }else {
            $this->validate($request, [
                'new_password' => 'required|confirmed'
            ]);
        }


        if(auth()->user()->hasRole('admin') || \Hash::check($request['current_password'], $user->password)) {
            $user->password = bcrypt($request['new_password']);
            $user->save();
        }else {
            return redirect()->back()->with('Error','The current password is invalid.');
        }

        return redirect("/users/$user->id")->with('Info','The password has been updated.');
    }

    public function showLoad() {
        $user = auth()->user();
        $classes = Classes::where('user_id', $user->id)
                ->whereHas('period', function($query) use ($user){
                    $query->whereNotIn('status',['close','pending']);
                })->with('course')->get();
        return view('users.load',['user'=>$user,'classes'=>$classes]);
    }
}
