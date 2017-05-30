<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Form_result;
use App\Form_question_group;
use App\Form_question;
use App\Form_type;
use App\Form_result_kadin_daerah;
use App\Kta;
use App\Notification;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use DB;
use Datatables;

class CommonMemberController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        
        return view('common.member.ab.index', compact('notifs'));
    }

    public function indexAlb()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        
        return view('common.member.alb.index', compact('notifs'));
    }

    public function indexAjax() 
    {
        $terr = Auth::user()->territory;
        $ids = User::select( 'users.*',
            DB::raw('(select kta from kta where owner = users.id order by id asc limit 1) as kta'),
            DB::raw('(select perpanjangan from kta where owner = users.id order by id asc limit 1) as ext')  )
            ->where('role', '=', '2');

        if ($terr) {
        	$ids = $ids->where('territory', '=', $terr)
            		->get();
        } else {
        	$ids = $ids->get();
        }

        
        return Datatables::of($ids)->make(true);
    }

    public function indexAjaxAlb() {
        $terr = Auth::user()->territory;

        $ids = User::select( 'users.*',
            DB::raw('(select kta from kta where owner = users.id order by id asc limit 1) as kta'),
            DB::raw('(select perpanjangan from kta where owner = users.id order by id asc limit 1) as ext')  )
            ->where('role', '=', '6');
		
		if ($terr) {
        	$ids = $ids->where('territory', '=', $terr)
            		->get();
        } else {
        	$ids = $ids->get();
        }

        return Datatables::of($ids)->make(true);
    }

    public function memberresultAjax($id) 
    {
        $fr = Form_result::
                leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('form_result.id_user', '=', $id)->get();
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
        $trackingcode = Form_result::where('id_user', '=', $member->id)
            ->where('id_question', '=', 'Kode Pos')->first()->trackingcode;
        $detail = Form_result::where('id_user', '=', $member->id)->get();

        $detail1 = \App\Helpers\Details::detail1($member->id);
        $detail2 = \App\Helpers\Details::detail2($member->id);
        $detail3 = \App\Helpers\Details::detail3($member->id);
        $docs = \App\Helpers\Details::docs($member->id);

        $notes = Form_result::where('id_user', '=', $member->id)
                    ->where('commentary', '!=', '')->count();
        $notes = $notes+Form_result::where('id_user', '=', $member->id)
                    ->where('correction', '!=', '')->count();

        return view('common.member.ab.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3',
            'docs', 'trackingcode', 'notes'));
    }

    public function showAlb($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);
        $detail = Form_result::where('id_user', '=', $member->id)->get();

        $fileqg = Form_type::where('name', 'like', '%File Upload%')->pluck('id');
        $fileq = Form_question::whereIn('type', $fileqg)->pluck('id')->toArray();

        $notes = Form_result::where('id_user', '=', $member->id)
            ->where('commentary', '!=', '')->count();
        $notes = $notes+Form_result::where('id_user', '=', $member->id)
                ->where('correction', '!=', '')->count();

        return view('common.member.alb.detail', compact('notifs', 'member', 'detail', 'fileq', 'notes'));
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
            // \App\Helpers\Collaboration::deleteAccount($member->username);
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
            
            $fr = Form_result::where('id_user', '=', $id)->get();
            foreach ($fr as $key => $result) {
                $result->id_user = "0";
                $result->update();
            }

            $deleted = true;
            $deletedMsg = "Data " . $member->name . " is deleted";
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            $deleted = true;
            $deletedMsg = "Data " . $member->name . " is deleted";
        } catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function memberValidate(Request $request, $id) 
    {           
        try {
            $user = Auth::user();
            $form = Form_result_kadin_daerah::where('id', '=', $id)->first();
            $request['validated_by'] = $user->id;
            $request['validated_at'] = new Carbon();
            $form->update($request->all());

            $deleted = true;
            $deletedMsg = "Question " . $form->question . " is verified";
        }catch(\Exception $e) {
            $deleted = false;
            $deletedMsg = "Error while verifying member";
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function memberReqKta(Request $request) 
    {
        $keterangan = $request['keterangan'];
        $id_owner = $request['id_user'];

        $kta = Kta::where('owner', '=', $id_owner)->first();

        if ($kta) {
            try {
                $kta->kta = "validated";
                $kta->keterangan = $keterangan;
                $kta->save();

                $member = User::where('id', '=', $id_owner)->first();
                $member->update([
                    'validation' => 'validated'
                ]);

                $ext = str_contains($kta->perpanjangan, 'processed');
                $msg = "KTA Request";
                if ($ext) {
                    $msg = "KTA Extension Request";
                }

                $idProv = substr(Auth::user()->territory, 0, 3);
                $idSender = Auth::user()->id;
                $provinsi = User::where('role', '=', '4')->where('territory', '=', $idProv)->get();
                foreach ($provinsi as $key => $prov) {
                    \App\Helpers\Notifs::create($prov->id, $idSender, null, $msg." from ".$member->username);
                }

                \App\Helpers\Notifs::create($member->id, $idSender, null, "Your ".$msg." is Validated");

                $deleted = true;
                $deletedMsg = $msg." from " . $member->username . " is proceeded";
            }catch(\Exception $e){
                $deleted = false;
                $deletedMsg = "Error while executing command";

                $kta->kta = "requested";
                $kta->keterangan = "";
                $kta->save();

                $member = User::where('id', '=', $id_owner)->first();
                $member->update([
                    'validation' => ''
                ]);
            }        
        } else {
            $deleted = false;
            $deletedMsg = "Data is not available";
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function memberPostKta(Request $request) 
    {
        $keterangan = $request['keterangan'];
        $id_owner = $request['id_user'];
        $kta = Kta::where('owner', '=', $id_owner)->first();
        if ($kta) {
            try {
                $kta->kta = "postponed";
                $kta->keterangan = $keterangan;
                $kta->save();

                $member = User::where('id', '=', $id_owner)->first();
                $member->update([
                    'validation' => 'postponed'
                ]);

                $ext = str_contains($kta->perpanjangan, 'processed');
                $msg = "KTA Request";
                if ($ext) {
                    $msg = "KTA Extension Request";
                }

                $idSender = Auth::user()->id;
                \App\Helpers\Notifs::create($member->id, $idSender, null, "Your ".$msg." is Postponed");

                $deleted = true;
                $deletedMsg = $msg." from " . $member->username . " is Postponed";
            }catch(\Exception $e){
                return $e;
                $deleted = false;
                $deletedMsg = "Error while executing command";
            }
        } else {
            $deleted = false;
            $deletedMsg = "Data is not available";
        }

        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
}
