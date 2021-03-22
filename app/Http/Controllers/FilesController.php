<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    public function index()
    {
        // $files = File::all();
        // Para que se muestre el último archivo de primero
        // $files = File::where('user_id', Auth::id())->latest()->get();
        // También sirve
        //$files = File::whereUserId(Auth::id())->latest()->get();
        $files = File::whereUserId(Auth::id())->latest()->get();
        return view('index', compact('files'));
    }

    public function show($id)
    {
        $file = File::whereCodeName($id)->firstOrFail();
        $user_id = Auth::id();
        if($file->user_id == $user_id){
            return redirect(storage_path().'/app/public/'.$user_id.'/'.$file->code_name);
            // return redirect('/storage'.'/'.$user_id.'/'.$file->name);
        } else {
            Alert::error('¡Error!', 'No tiene permisos para ver este archivo');
            return back();

            // También se puede colocar
            // abort(403);
        }
    }

    public function store(Request $request)
    {
        $max_size = (int)ini_get('upload_max_filesize') * 10240;
        $files = $request->file('files');
        $user_id = Auth::id();

        if($request->hasFile('files')){
            foreach($files as $file){
                //$fileName = Str::slug($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
                $fileName = encrypt($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
                if(Storage::putFileAs('/public/' . $user_id . '/' , $file, $fileName)){
                    File::create([
                        'name' => $file->getClientOriginalName(),
                        'code_name' => $fileName,
                        'user_id' => $user_id
                    ]);
                }
            }
            Alert::success('¡Éxito!', 'Se ha subido el archivo');
            return back();
        }else{
            Alert::error('¡Error!', 'Debes subir uno o más archivos');
            return back();
        }
    }

    public function ver($file){
        // $pathtoFile = public_path().'images/'.$file;
        //$pathtoFile0 = public_path();
        $pathtoFile = storage_path().'/app/public/'.Auth::id().'/'.$file;
        //$pathtoFile0 = 'C:/xampp/htdocs/cursos/08FileLaravel/storage/app/public/1/Bolivia.png';
        //dd($pathtoFile0, $pathtoFile);
        return response()->download($pathtoFile);
        //return Storage::response($pathtoFile);
    }

    public function destroy(Request $request, $id)
    {
        //$file = File::whereId($id)->firstOrFail();
        $file = File::whereCodeName($id)->firstOrFail();
        
        // Borra el archivo del storage o almacenamiento
        $archivo = storage_path().'/app/public/'.Auth::id().'/'.$file->code_name;
        unlink($archivo);
        //unlink(public_path('storage'.'/'.Auth::id().'/'.$file->name));

        // Borra el registro de la bd
        $file->delete();

        Alert::info('Atención!', 'Se ha eliminado el archivo');
        return back();
    }
}
