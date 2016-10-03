<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Form_question_group;
use App\Http\Requests\FormQuestionGroupRequest;
use Datatables;

class FormQuestionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $search = \Request::get('search');
        
        // $fqgroups = Form_question_group::where('name','like','%'.$search.'%')->paginate(7);

        // if (Request::ajax()) {                                            
        //     return view('form.question.questions', compact('fquestions'));
        // }
                
        // $deleted = false;
        // return view('form.questiongroup.index', compact('fqgroups', 'deleted'));
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.questiongroup.index', compact('notifs'));
    }

    public function indexAjax() {        
        $fr = Form_question_group::select(['id', 'name', 'description']);
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

        return view('form.questiongroup.create', compact('notifs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormQuestionGroupRequest $request)
    {
         $input = $request->all();

        Form_question_group::create($input);

        return redirect('/crud/form/question_group');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/crud/form/question_group');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fqg = Form_question_group::findOrFail($id);

        // return $fsetting;

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.questiongroup.edit', compact('fqg', 'notifs')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormQuestionGroupRequest $request, $id)
    {
        $fqg = Form_question_group::findOrFail($id);

        $fqg->update($request->all());

        return redirect('/crud/form/question_group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fqg = Form_question_group::findOrFail($id);

        try {
            $fqg->delete();
            $deleted = true;
            $deletedMsg = "Data " . $fqg->name . " is deleted";      
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";      
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
}
