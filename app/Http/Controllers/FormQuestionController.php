<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Form_question;
use App\Form_question_group;
use App\Form_setting;
use App\Http\Requests\FormQuestionRequest;
use Datatables;

class FormQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = \Request::get('search');

        $fquestions = Form_question::where('question','like','%'.$search.'%')->paginate(7);

        if (Request::ajax()) {                                            
            return view('form.question.questions', compact('fquestions'));
        }

        $deleted = false;
        
        return view('form.question.index', compact('fquestions', 'deleted'));
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

        // return $gqs;
        return view('form.question.create', compact('gqs', 'ats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormQuestionRequest $request)
    {
        $input = $request->all();

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
                
        return view('form.question.edit', compact('fq', 'gqs', 'ats')); 
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
            $deletedMsg = "Data " . $fq->answer . " is deleted";      
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";      
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
}
