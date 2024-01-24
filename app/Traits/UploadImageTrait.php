<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Image;
trait UploadImageTrait{
 public function uploadImage(Request $request,$inputName,$folderName,$disk,$imageable_id,$imageable_type){
    if(!$request->hasFile($inputName)){
        //flash('Invalid Image!')->error()->important();
        return redirect()->back()->withInput();
    }
    $image=$request->file($inputName);
    $name = \Str::slug($request->input('name'));
    $fileName=$name.'.'.$image->getClientOriginalExtension();

    $Image = new Image();
    $Image->filename = $fileName;
    $Image->imageable_id = $imageable_id;   
    $Image->imageable_type = $imageable_type;
    $Image->save();

    return $request->file($inputName)->storeAs($folderName, $fileName, $disk);
 }
}