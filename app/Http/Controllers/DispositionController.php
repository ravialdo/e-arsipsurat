<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disposition;
use  App\Mail;
use App\User;
use Alert;

class DispositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	   $data = [
	        'dispositions' => Disposition::all(),
		   'mails' => Mail::all(),
		    'users' => User::where('level_id', 2)->get()
        ];
	
        return view('dashboard.disposition.index', $data);
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
        $store = Disposition::create([
			'disposition_to' => $request->ditujukan_untuk,
			'type_mail_disposition' => $request->tipe_surat,
			'description' => $request->deskripsi,
			'status_disposition' => $request->status_balasan,
			'status' => 0,
			'mail_id' => $request->id_surat,
			'user_id' => auth()->user()->id
        ]);

	   if($store):
			alert()->success('Disposisi Berhasil di Kirim', 'Berhasil!')->persistent('OK');
	    else:
			alert()->error('Disposisi Gagal di Kirim', 'Gagal!')->persistent('OK');
	    endif;
	
		return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
