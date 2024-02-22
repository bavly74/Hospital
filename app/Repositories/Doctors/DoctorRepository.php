<?php
namespace App\Repositories\Doctors;
use App\Models\Doctor;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\Section;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;

class DoctorRepository implements DoctorRepositoryInterface{
    use UploadImageTrait;
    public function index(){
        $doctors = Doctor::with('doctorappointments')->get();
        return view('dashboard.doctors.index',compact('doctors'));
    }

    public function create(){
        $sections=Section::all();
        $appointments=Appointment::all();
        return view('dashboard.doctors.add',compact('sections','appointments'));
    }

    public function store($request){
       DB::beginTransaction();
       try{
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->password = $request->password;
       
        $doctor->section_id = $request->section_id;
        //$doctor->appointments=implode(",",$request->appointments);
        $doctor->doctorappointments()->attach($request->appointments);

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


    public function edit($id){
        $doctor=Doctor::with('doctorappointments')->where('id',$id)->first();
        $sections=Section::all();
        $appointments=Appointment::all();
        return view('dashboard.doctors.edit',compact('doctor','sections','appointments'));
    }


    public function update($request){
        DB::beginTransaction();
        try{
            // Doctor::where('id',$request->id)->update([
            //     'email'=>$request->email,
            //     'phone'=>$request->phone,
            //     'section_id'=>$request->section_id,
            //     'name'=>$request->name,
            // ]);
            $doctor=Doctor::where('id',$request->id)->first();
            $doctor->name=$request->name;
            $doctor->email=$request->email;
            $doctor->section_id=$request->section_id;
            $doctor->phone=$request->phone;
            $doctor->save();

            $doctor->doctorappointments()->sync($request->appointments);

            if($request->hasFile('photo')){
                if($doctor->image){
                    $old_img=$doctor->image->filename;
                    $this->deleteImage('upload_image','doctors/'.$old_img,$request->id);
                }else{
                    $this->uploadImage($request,'photo','doctors','upload_image',$request->id,'App\Models\Doctor');
                }
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->back();

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

    public function delete($request){

    if($request->page_id==1){
        if($request->filename){
            $this->deleteImage('upload_image','doctors/'.$request->filename,$request->id);
        }
        Doctor::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('doctors.index');
    }else{

        $delete_select_id=explode(",",$request->delete_select_id) ;
        foreach ($delete_select_id as $ids_doctors){
        $doctor = Doctor::findorfail($ids_doctors);
        if($doctor->image){
            $this->deleteImage('upload_image','doctors/'.$doctor->image->filename,$ids_doctors,);
        }
        Doctor::destroy($ids_doctors);

    }
    session()->flash('delete');
    return redirect()->route('doctors.index');
    }
    }


    public function updatePassword($request){
        return $request;
    }
}
