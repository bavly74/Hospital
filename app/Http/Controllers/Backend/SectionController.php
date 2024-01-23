<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Sections\SectionRepositoryInterface;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private $section;
    public function __construct(SectionRepositoryInterface $section){
        $this->section = $section;
    }

    public function index()
    {
       return $this->section->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return $this->section->store($request);
    }

   
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    
    public function update(Request $request)
    {
        return $this->section->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        return $this->section->delete($request);    }
}
