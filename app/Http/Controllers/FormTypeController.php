<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Form_type;
use Datatables;
use App\Http\Requests\FormTypeRequest;

class FormTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('form.type.index');
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.type.index', compact('notifs'));
    }

    public function indexAjax() {        
        $fr = Form_type::select(['id', 'name', 'description', 'html_tag']);
        return Datatables::of($fr)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {           
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.type.create1', compact('notifs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormTypeRequest $request)
    {        
        $input = $request->all();

        Form_type::create($input);

        return redirect('/crud/form/types');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // terjadi error jika ke '/crud/form/types'
        return redirect('/crud/form/types_');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ftype = Form_type::findOrFail($id);

        // return $ftype;
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.type.edit', compact('ftype', 'notifs')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormTypeRequest $request, $id)
    {        
        $ftype = Form_type::findOrFail($id);        

        $ftype->update($request->all());

        return redirect('/crud/form/types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ftype = Form_type::findOrFail($id);         

        try {
            $ftype->delete();
            $deleted = true;
            $deletedMsg = "Data " . $ftype->name . " is deleted";      
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";      
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
}
