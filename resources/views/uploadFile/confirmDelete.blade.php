<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Include your head content here -->
</head>
<body>
@extends('layouts.main')

@section('title', 'Confirm File Deletion')

@section('content')
    <div class="container mt-5">
        <h3>Confirm Deletion</h3>
        <p>Are you sure you want to delete this file?</p>
        <form action="{{ route('deleteFile', ['id' => $file->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes, delete</button>
            <a href="{{ route('fileList') }}" class="btn btn-secondary">No, go back</a>
        </form>
    </div>
@endsection
</body>
</html>