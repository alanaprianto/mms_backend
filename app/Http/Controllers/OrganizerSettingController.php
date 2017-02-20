<?php

namespace App\Http\Controllers;

use App\Pjabatan;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class OrganizerSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        return view('common.organizer.setting.index', compact('notifs'));
    }

    public function indexAjax() {
        $setting = Pjabatan::where('status', '!=', 'parent')->get();
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

        $parent = Pjabatan::where('status', '=', 'parent')->pluck('title', 'id');
        return view('common.organizer.setting.create', compact('notifs', 'parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'short_title' => 'required',
            'parent' => 'required',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
            Pjabatan::create($input);
        } else {
            return Redirect::to('/admin/organizer/setting/create')->withErrors($validator);
        }

        return redirect('/admin/organizer/setting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/organizer/setting');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Pjabatan::find($id);
        $parent = Pjabatan::where('status', '=', 'parent')->pluck('title', 'id');

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('common.organizer.setting.edit', compact('setting', 'parent', 'notifs'));
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
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'short_title' => 'required',
            'parent' => 'required',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
            $setting = Pjabatan::find($id);
            $setting->update($input);
        } else {
            return Redirect::to('/admin/organizer/setting/'.$id.'/edit')->withErrors($validator);
        }

        return redirect('/admin/organizer/setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = Pjabatan::find($id);

        try {
            $setting->delete();
            $deleted = true;
            $deletedMsg = "Data " . $setting->name . " is deleted";
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";
        }

        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
}
