@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>

    <table class="table">
        <thead>
            <tr>
                <th><b>id</b></th>
                <th><b>User</b></th>
                <th><b>Category</b></th>
                <th><b>Photo</b></th>
                <th><b>Title</b></th>
                <th><b>Created</b></th>
                <th><b>Updated</b></th>
            </tr>
        </thead>    
        <tbody>
            @if($posts)
                @foreach($posts as $post)
                    <tr>  
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->category? $post->category->name: 'Uncategorized' }}</td>
                        <td><img src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/300x300' }}" alt="" class="img-responsive"/></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->created_at->diffForhumans() }}</td>
                        <td>{{ $post->updated_at->diffForhumans() }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>   
    </table>

@endsection