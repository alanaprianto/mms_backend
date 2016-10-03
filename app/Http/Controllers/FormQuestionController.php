<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Form_question;
use App\Form_question_group;
use App\Form_setting;
use App\Form_type;
use App\Http\Requests\FormQuestionRequest;
use Datatables;
use App\Form_rules;

class FormQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $search = \Request::get('search');

        // $fquestions = Form_question::where('question','like','%'.$search.'%')->paginate(7);

        // if (Request::ajax()) {                                            
        //     return view('form.question.questions', compact('fquestions'));
        // }        
        
        // return implode("|", $fquestions->rules_detail->parameter);           
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.question.index', compact('notifs'));
    }
    
    public function indexAjax() {    
        $fr = Form_question::orderBy('order', 'asc')->get();
        return Datatables::of($fr)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gqs = Form_question_group::pluck('name', 'id');
        $ats = Form_setting::pluck('name', 'id');
        $types = Form_type::pluck('name', 'id');
        $rules = Form_rules::get();

        // return $rules;

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.question.create', compact('gqs', 'ats', 'types', 'rules', 'notifs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormQuestionRequest $request)
    {
        if ($request['order'] == "") {
            $request['order'] = "0";
        }
        
        if ($request['rules']) {
            $rules = implode (", ", $request['rules']);
            $request['rules'] = $rules;
        }        

        $input = $request->all();
        // return $input;
        Form_question::create($input);

        return redirect('/crud/form/question');
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
        $fq = Form_question::findOrFail($id);

        if (Request::ajax()) {                                            
            return \Response::json($fq);
        }
        
        return \Response::json($fq);
        return redirect('/crud/form/question');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fq = Form_question::findOrFail($id);
        $gqs = Form_question_group::pluck('name', 'id');
        $ats = Form_setting::pluck('name', 'id');
        $types = Form_type::pluck('name', 'id');
        $rules = Form_rules::get();
                
        $data = array();
        if (!empty($fq->rules_detail)) {
            foreach ($fq->rules_detail as $key => $value) {
                $data[] = $value->id;
            }
        }        
        
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.question.edit', compact('fq', 'gqs', 'ats', 'types', 'rules', 'data', 'notifs')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormQuestionRequest $request, $id)
    {        
        if ($request['rules']) {
            $rules = implode (", ", $request['rules']);
            $request['rules'] = $rules;
        }    

        $fq = Form_question::findOrFail($id);

        $fq->update($request->all());

        return redirect('/crud/form/question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fq = Form_question::findOrFail($id);

        try {
            $fq->delete();
            $deleted = true;
            $deletedMsg = "Data " . $fq->question . " is deleted";      
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";      
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $settingid
     * @return \Illuminate\Http\Response
     */
    public function whereSetting($settingid)
    {
        // return $id;
        $fq = Form_question::where('answer_type','=',$settingid)->get();

        if (Request::ajax()) {                                            
            return \Response::json($fq);
        }
        
        return \Response::json($fq);
        return redirect('/crud/form/question');
    } 
}
