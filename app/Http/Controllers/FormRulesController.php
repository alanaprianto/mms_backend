<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Form_rules;
use Datatables;
use App\Http\Requests\FormRulesRequest;

class FormRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('form.rules.index');
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.rules.index', compact('notifs'));
    }

    public function indexAjax() {        
        $fr = Form_rules::select(['id', 'name', 'parameter', 'description']);
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
        return view('form.rules.create', compact('notifs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRulesRequest $request)
    {
        $input = $request->all();

        Form_rules::create($input);

        return redirect('/crud/form/rules');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // terjadi error jika ke '/crud/form/rules'
        return redirect('/crud/form/rules_');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $frules = Form_rules::findOrFail($id);

        // return $frules;

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.rules.edit', compact('frules', 'notifs')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormRulesRequest $request, $id)
    {
        $frules = Form_rules::findOrFail($id);        

        $frules->update($request->all());

        return redirect('/crud/form/rules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $frules = Form_rules::findOrFail($id);         

        try {
            $frules->delete();
            $deleted = true;
            $deletedMsg = "Data " . $frules->name . " is deleted";      
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";      
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
}
