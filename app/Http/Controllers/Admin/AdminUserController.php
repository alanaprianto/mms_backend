<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Notification;
use Datatables;
use App\Form_result;
use App\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Form_question_group;
use App\Form_question;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function dashboardAdmin()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        return view('admin.dashboard.index', compact('notifs'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {                
        $u = User::get();
        // return $u;
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('admin.user.index', compact('notifs'));
    }

    public function indexAjax() {        
        $fr = User::where('role', '<>', '2')->where('role', '<>', '6')->get();
        // ->select(['id', 'name', 'username', 'email']);
        return Datatables::of($fr)->make(true);
    }    

    public function userresultAjax($id) {        
        $fr = Form_result::
                leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('form_result.id_user', '=', $id)->get();
                // leftJoin('form_question', 'form_result.id_question', '=', 'form_question.id')          
                // ->leftJoin('users', 'form_result.id_user', '=', 'users.id')
                // ->where('form_result.id_user', '=', $id)->get();
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
        $role = Role::where('id', '<>', 2)->where('id', '<>', 6)->pluck('name', 'id');
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('admin.user.create', compact('notifs', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->except('password_confirmation');
        if (!$input['territory']) {
            $input['territory'] = "0";
        }
        $input['no_kta'] = "0";
        $input['no_rn'] = "0";
        $input['password'] = Hash::make($input['password']);

        User::create($input);
        
        return redirect('/admin/user');
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
                
        return view('admin.user.indexresult', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs'));
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
        //
    }    
}
