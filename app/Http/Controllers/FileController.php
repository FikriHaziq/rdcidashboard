<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Models\DataAttachment;
use Illuminate\Support\Facades\Storage;

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
        if($request->module != 'expenses'){
            $others = DataAttachment::where('year', $request->year)->whereModule($request->module)->get();
            foreach ($others as $key => $other) {
                $other->status = 'not-selected';
                $other->save();
            }
        }
        $data = new DataAttachment;
        $data->module = $request->module;
        $data->year = $request->year;
        $data->filename = $file['filename'];
        $data->status = $request->status ?? 'not-selected';
        $data->value1 = $request->migration;
        $data->save();

        $temporaryFile = TemporaryFile::where('folder', $file['folder'])->first();

        if($temporaryFile){
            $data->addMedia(storage_path('app/data/tmp/'.$file['folder'].'/'.$temporaryFile->filename))->toMediaCollection('dataAttachment');
            $temporaryFile->delete();
            Storage::deleteDirectory('app/data/tmp/'.$file['folder']);
        }

        return redirect()->back();
    }

    public function upload(Request $request, $multiple = null)
    {
        if($multiple == "multiple"){
            $file_arr = [];
            foreach ($request->file('file_upload') as $key => $file) {
                $filename = $file->getClientOriginalName();
                $folder = uniqid() . '-' . now()->timestamp;
                $file->storeAs('data/tmp/'.$folder, $filename);

                TemporaryFile::create([
                    'folder' => $folder,
                    'filename' => $filename,
                ]);
                array_push($file_arr, ["folder"=>$folder, "filename"=>$filename]);
            }
            return $file_arr;
        }
        else {
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
        }
        
        return null;
    }

    public function revert(Request $request)
    {
        Storage::deleteDirectory('data/tmp/'.$request->folder);
        return ["folder"=>$request->folder, "filename"=>$request->filename];
    }
}
