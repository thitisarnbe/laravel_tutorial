<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all(); 

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'role_options'=>$this->getRoleOptions(),
            'status_options'=>$this->getStatusOptions()
        ];
        
        return view('admin.users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //


        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time().'_'.$file->getClientOriginalName();

            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);

        User::create($input);
        return redirect('/admin/users');
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
        $user = User::findOrFail($id);

        $data = [
            'user' => $user,
            'role_options'=>$this->getRoleOptions(),
            'status_options'=>$this->getStatusOptions()
        ];
        
        return view('admin.users.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if(empty(trim($request->password))){
           $input = $request->except('password');
        }else{
           $input = $request->all();
           $input['password'] = bcrypt($request->password);
        }

        // 
        $user = User::findORFail($id);
     

        if($file = $request->file('photo_id')){
            $name = time().'_'.$file->getClientOriginalName();

            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        $user->update($input);


        return redirect('admin/users');
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

    public function getRoleOptions(){

        return Role::pluck('name','id')->all(); 
    }

    public function getStatusOptions(){
        $options = array(
            '0'=>'Inactive',
            '1'=>'Active',
        );
    
        return $options;
    }
}
