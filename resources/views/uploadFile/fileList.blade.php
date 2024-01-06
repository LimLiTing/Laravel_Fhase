<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Include your head content here -->
</head>
<body>
@extends('layouts.main') 
@section('title', 'File List')
@section('content')

<div class="container mt-5">
    <h3 class="text-center mb-5">List of Uploaded Files</h3>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">File Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>{{ $file->title }}</td>
                    <td>{{ $file->description }}</td>
                    <td>
                        <!-- <a href="{{ route('getFile', ['id' => $file->id]) }}">Download</a> -->
                        <form action="{{ route('editFile', ['id' => $file->id]) }}" method="get" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                        </form>
                        <form action="{{ route('deleteFile', ['id' => $file->id]) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
</body>
</html>