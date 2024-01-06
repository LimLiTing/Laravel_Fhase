<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileUploadController extends Controller
{
    public function createForm(){
        return view('uploadFile/file-upload');
      }

    public function displayFile(){
        return view('uploadFile/fileList');
    }
    
    public function fileUpload(Request $req){
        $req->validate([
        'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
        ]);
        $fileModel = new File;
        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->title = time().'_'.$req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->description = $req->input('fileDescription'); // Save description
            $fileModel->save();
            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
        }
    }

    public function getFile()
    {
        // Retrieve all files from the database
        $files = File::all();
        
        // Pass the files to the view
        return view('uploadFile/fileList', compact('files'));
    }

    public function editFile($id)
    {
        $file = File::find($id);
        
        if (!$file) {
            return abort(404);
        }
        
        return view('uploadFile/editFile', ['file' => $file]);
    }
    
    public function updateFile(Request $request, $id)
    {
        $file = File::find($id);
        
        if (!$file) {
            return abort(404);
        }
        
        $request->validate([
            'description' => 'required',
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            // Add validation for other fields as needed
        ]);
        
        // Update file properties
        $file->description = $request->input('description');
        $file->file_Path = $request->input('file');
        
        // Update other fields as needed
        $file->save();
        
        return redirect()->route('fileList')->with('success', 'File updated successfully');
    }
    
    public function confirmDelete($id)
    {
        $file = File::find($id);
        
        if (!$file) {
            return abort(404);
        }
        
        return view('uploadFile/confirmDelete', ['file' => $file]);
    }
    
    public function deleteFile($id)
    {
        $file = File::find($id);
        
        if (!$file) {
            return abort(404);
        }
        
        $file->delete();
        
        return redirect()->route('fileList')->with('success', 'File deleted successfully');
    }
}