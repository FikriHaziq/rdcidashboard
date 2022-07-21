<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Models\DataAttachment;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "file_upload" => "required",
        ], [
            "file_upload.required_if" => "File is required",
        ]);
        $file = collect(json_decode($request->file_upload));
        $others = DataAttachment::whereModule($request->module)->get();
        foreach ($others as $key => $other) {
            $other->status = 'not-selected';
            $other->save();
        }
        $data = new DataAttachment;
        $data->module = $request->module;
        $data->year = $request->year;
        $data->filename = $file['filename'];
        $data->status = 'not-selected';
        $data->save();

        $temporaryFile = TemporaryFile::where('folder', $file['folder'])->first();

        if($temporaryFile){
            $data->addMedia(storage_path('app/data/tmp/'.$file['folder'].'/'.$temporaryFile->filename))->toMediaCollection('dataAttachment');
            rmdir(storage_path('app/data/tmp/'.$temporaryFile->folder));
            $temporaryFile->delete();
        }

        return redirect()->back();
    }

    public function upload(Request $request)
    {
        if($request->file('file_upload')){
            $file = $request->file('file_upload');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('data/tmp/'.$folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);

            // return '';
            return ["folder"=>$folder, "filename"=>$filename];
        }
        return '';
    }
}
