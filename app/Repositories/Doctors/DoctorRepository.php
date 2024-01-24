<?php
namespace App\Repositories\Doctors;
use App\Models\Doctor;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Section;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;

class DoctorRepository implements DoctorRepositoryInterface{
    use UploadImageTrait;
    public function index(){
        $doctors = Doctor::all();
        return view('dashboard.doctors.index',compact('doctors'));
    }

    public function create(){
        $sections=Section::all();
        return view('dashboard.doctors.add',compact('sections'));
    }

    public function store($request){
       DB::beginTransaction();
       try{
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->password = $request->password;
        $doctor->price = $request->price;
        $doctor->section_id = $request->section_id;
        $doctor->appointments=implode(",",$request->appointments);
        $doctor->save();
        $this->uploadImage($request,'photo','doctors','upload_image',$doctor->id,'App\Models\Doctor');

        DB::commit();
        session()->flash('add');
        return redirect()->route('doctors.create');
       
       }catch(\Exception $e){
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }


    public function update($request){
        return "ok";
    }

    public function delete($request){
        return "ok";
    }
 }
