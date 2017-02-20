<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use Datatables;
use App\Form_result;
use App\Form_question_group;
use App\Form_question;
use Illuminate\Support\Str;

class AdminMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('admin.member.index', compact('notifs'));
    }

     public function indexAjax() {        
        $fr = User::whereIn('role', ['2', '6'])->get();
        // ->select(['id', 'name', 'username', 'email']);
        return Datatables::of($fr)->make(true);
    }

    public function memberresultAjax($id) {        
        $fr = Form_result::
                leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('form_result.id_user', '=', $id)->get();
                // leftJoin('form_question', 'form_result.id_question', '=', 'form_question.id')          
                // ->select(['form_result.id', 'form_question.question', 'form_result.answer_value', 'users.name', 'form_result.trackingcode', 'form_result.id_question']);        
        return Datatables::of($fr)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();        
        $member = User::find($id);        

        $detail1 = \App\Helpers\Details::detail1($member->id);
        $detail2 = \App\Helpers\Details::detail2($member->id);
        $detail3 = \App\Helpers\Details::detail3($member->id);
        $docs = \App\Helpers\Details::docs($member->id);
        
        return view('admin.member.indexresult', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = User::findOrFail($id);         

        try {
            $delChat = \App\Helpers\Collaboration::deleteAccount($member->username);
            $member->delete();

            $path = storage_path() . '/app/uploadedfiles/'.$member->username.'/';
            \File::deleteDirectory($path);

            $name = "";
            $ext = "";
            $file = storage_path() . '/app/photoprofile'.'/';
            $filesInFolder = \File::files($file);
                
            foreach($filesInFolder as $path)
            {
                $files = pathinfo($path);
                if ($files['filename'] == $member->username) {                
                    $name = $files['filename'];
                    $ext = $files['extension'];

                    $img = storage_path() . '/app/photoprofile'.'/'.$name.'.'.$ext;
                    \File::Delete($img);
                }
            }
            
            $deleted = true;
            $deletedMsg = "Data " . $member->name . " is deleted";      
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";      
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }    
}
