@extends('layouts.admin')

@section('content')
    <h1>Edit user</h1>
    <div class="row">
        <div class="col-sm-3">
            <img class="img-responsive img-rounded" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="" >
        </div>
        <div class="col-sm-9">
            {!! Form::open(['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}
                {{ csrf_field() }}
                <div class="form-group">
                    {!! Form::label('name','Name:') !!}
                    {!! Form::text('name',$user->name, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email','Email:') !!}
                    {!! Form::text('email',$user->email, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('password','Password:') !!}
                        {!! Form::password('password',['class'=>'form-control']) !!}
                    </div>
                <div class="form-group">
                    {!! Form::label('role_id','Role:') !!}
                    {!! Form::select('role_id', $role_options, $user->role_id, ['placeholder' => 'Select Role','class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status','Status:') !!}
                    {!! Form::select('status', $status_options, $user->status, ['placeholder' => 'Select Status','class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('photo_id','Status:') !!}
                    {!! Form::file('photo_id', ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    @include('includes.form_error')
@stop