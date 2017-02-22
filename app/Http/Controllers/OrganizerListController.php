<?php

namespace App\Http\Controllers;

use App\Pengurus;
use App\Pjabatan;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class OrganizerListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        return view('common.organizer.list.index', compact('notifs'));
    }

    public function indexAjax() {
        $setting = Pengurus::get();
        return Datatables::of($setting)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        $filled = Pengurus::pluck('position');
        $position = Pjabatan::where('status', '!=', 'parent')->whereNotIn('id', $filled)->pluck('title', 'id');
        return view('common.organizer.list.create', compact('notifs', 'position'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Redirect
     */
    public function store(Request $request)
    {      
        $input = $request->all();
        $input['username'] = 'asdf';
        $input['password'] = 'Hash::make($password)';
        // return $input;

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:pengurus,email',
            'address' => 'required',
            'position' => 'required|unique:pengurus,position',
        ]);
        if ($validator->passes()) {            
            // email uname & password chat
            $random_string = md5(microtime());
            $first = substr($random_string, 0, 4);
            $last = substr($random_string, -4);
            $username = $first.$last;
            $password = substr($random_string, 5, 14);            
            $name = $input['name'];
            $pos = $input['position'];            
            $position = Pjabatan::find($pos)->title;
            $email = $input['email'];           
            // return $username.' '.$password.' '.$name.' '.$position.' '.$email;

            $input['username'] = $username;
            $input['password'] = Hash::make($password);            
            $crtChat = \App\Helpers\Collaboration::crtAccount($name, $username, $email, $password);
            if ($crtChat) {
            	// return $username.' '.$password.' '.$name.' '.$position.' '.$email;
                Mail::send('emails.register_chat', ['name' => $name, 'username' => $username, 'password' => $password, 'position' => $position],
                    function($message) use ($email) {
                        $message->from('no-reply@kadin-indonesia.org', 'no-reply');
                        $message->to($email)->subject('Registered Kadin Organizer');
                    });

                $pengurus = Pengurus::create($input);
            }   
        } else {
            return Redirect::to('/admin/organizer/list_/create')->withErrors($validator);
        }

        return redirect('/admin/organizer/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Redirect
     */
    public function show($id)
    {
        return redirect('/admin/organizer/list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengurus = Pengurus::find($id);

        $notifs = \App\Helpers\Notifs::getNotifs();

        $position = Pjabatan::where('status', '!=', 'parent')->pluck('title', 'id');

        return view('common.organizer.list.edit', compact('pengurus', 'position', 'notifs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Redirect
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'position' => 'required',
        ]);
        if ($validator->passes()) {
            $pengurus = Pengurus::find($id);
            $pengurus->update($input);

            // email update uname & password chat

        } else {
            return Redirect::to('/admin/organizer/list/'.$id.'/edit')->withErrors($validator);
        }

        return redirect('/admin/organizer/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengurus = Pengurus::find($id);
        
        try {
            $pengurus->delete();
            $deleted = true;
            $deletedMsg = "Data " . $pengurus->name . " is deleted";

            \App\Helpers\Collaboration::deleteAccount($pengurus->username);
        }catch(\Exception $e){
            return $e;
            $deleted = false;
            $deletedMsg = "Error while deleting data";
        }

        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
}
