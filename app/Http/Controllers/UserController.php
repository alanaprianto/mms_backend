<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Notification;
use Datatables;
use App\Form_result;
use App\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
        return view('form.user.index', compact('notifs'));
    }

    public function indexAjax() {        
        $fr = User::where('role', '<>', '2')->get();
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
        $role = Role::where('id', '<>', 2)->pluck('name', 'id');
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('form.user.create', compact('notifs', 'role'));
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
        
        return redirect('/crud/form/user');
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
        $user = User::find($id);
        return view('form.user.indexresult', compact('notifs', 'user'));
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
