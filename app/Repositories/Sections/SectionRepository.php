<?php
namespace App\Repositories\Sections;
use App\Models\Section;
use App\Interfaces\Sections\SectionRepositoryInterface;

class SectionRepository implements SectionRepositoryInterface{
    public function index(){
        $sections=Section::all();
        return view("dashboard.sections.index",compact("sections"));
    }

    public function store($request){
        
        Section::create([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        session()->flash('add');
        return redirect()->route('section.index');
    }

    public function update($request){
        $section=Section::find($request->id);
       $section->update([        
            'name'=>$request->name,
            'description'=>$request->description
         ]  );

         session()->flash('edit');
         return redirect()->route('section.index');

        
    }


    public function delete($request){
        $section=Section::find($request->id)->delete();
 
        session()->flash('delete');
         return redirect()->route('section.index');
    }



}