<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Include your head content here -->
</head>
<body>
@extends('layouts.main')

@section('title', 'Edit File')

@section('content')
    <div class="container mt-5">
        <form action="{{ route('updateFile', ['id' => $file->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use the PUT method for updates -->
            
            <!-- Existing input fields -->
            <label for="custom-file-input">{{ __('Upload File')}}</label>
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label><br>
            </div>
            <div class="custom-file">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $file->description }}">
            </div>
            
            <!-- Add other input fields as needed -->
            
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Update File
            </button>
        </form>
    </div>
@endsection
</body>
</html>