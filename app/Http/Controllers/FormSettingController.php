<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Requests\FormSettingRequest;
use App\Form_setting;
use Datatables;
use Illuminate\Support\Facades\Auth;

class FormSettingController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        // $search = \Request::get('search');

        // if ( !empty ( $search ) ) {            
        //     $fsettings = Form_setting::where('name','like','%'.$search.'%')
        //     ->paginate(7);       
        // } else {
        //     $fsettings = Form_setting::paginate(7); 
        // }
        
        // return $search;
        // $fsettings = Form_setting::where('name','like','%'.$search.'%')
        //     ->paginate(7); 

        // if (Request::ajax()) {                    
            
        //     return view('form.setting.settings', compact('fsettings'));
        // }

        // return view('form.setting.index', compact('fsettings'));               
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.setting.index', compact('notifs'));
    }

    public function indexAjax() {        
        $fr = Form_setting::select(['id', 'name', 'description', 'html_tag']);
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
        return view('form.setting.create', compact('notifs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormSettingRequest $request)
    {
        $input = $request->all();

        Form_setting::create($input);

        return redirect('/crud/form/setting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        // $fs = Form_setting::findOrFail($id);
        $fs = Form_setting::where('name','like','%'.$id.'%')->get();

        if (Request::ajax()) {                                            
            return \Response::json($fs);
        }
        
        return \Response::json($fq);
        return redirect('/crud/form/setting');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fsetting = Form_setting::findOrFail($id);

        // return $fsetting;
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.setting.edit', compact('fsetting', 'notifs')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormSettingRequest $request, $id)
    {
        $fsetting = Form_setting::findOrFail($id);        

        $fsetting->update($request->all());

        return redirect('/crud/form/setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $fsetting = Form_setting::findOrFail($id);         

        try {
            $fsetting->delete();
            $deleted = true;
            $deletedMsg = "Data " . $fsetting->name . " is deleted";      
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";      
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
    
}
