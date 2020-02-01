<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MailType;
use App\Mail;
use Alert;
use File;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	   $data = [
		  'mail_types' => MailType::all(),
		  'mails' => Mail::paginate(10)
	   ];
	
        return view('dashboard.mail.index', $data);
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
	    $file = $request->file('file');
	    $folder = 'files';
	    $file_name = time().'-'.$file->getClientOriginalName();
	     $file->move($folder, $file_name);
	
        $store = Mail::create([
		   'mail_code' => $request->kode_surat,
		   'mail_from' => $request->surat_dari,
		   'mail_to' => $request->surat_untuk,
		   'mail_subject' => $request->subjek_surat,
		   'description' => $request->deskripsi,
		   'file' => $file_name,
		   'mail_type_id' => $request->tipe_surat,
		   'user_id' => auth()->user()->id
        ]);

	   if($store):
			alert()->success('Surat Berhasil di Tambahkan', 'Berhasil!')->persistent('OK');
	    else:
			alert()->error('Surat Gagal di Tambahkan', 'Gagal!')->persistent('OK');
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
        $data = [
		    'mail' => Mail::find($id),
			'mail_types' => MailType::all()
	   ];
	
		return view('dashboard.mail.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
		  'mail' => Mail::paginate(10)
	  ];
	
	  return view('dashboard.mail.edit', $data);
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
        $update = Mail::find($id);

	   $update->update([
		   'mail_code' => $request->kode_surat,
		   'mail_from' => $request->surat_dari,
		   'mail_to' => $request->surat_untuk,
		   'mail_subject' => $request->subjek_surat,
		   'description' => $request->deskripsi,
		   'mail_type_id' => $request->tipe_surat,
		]);
		
		if($request->file('file') != null):
			$folder = 'files/';
			$file = $request->file('file');
			$file_name = time().'-'.$file->getClientOriginalName();
			$file->move($folder, $file_name);
			$file_delete = $folder. $update->file;
			File::delete($file_delete);
			
			$update->update([
				'file' => $file_name
			]);
		endif;
		
		if($update):
			alert()->success('Surat Berhasil di Edit', 'Berhasil!')->persistent('OK');
	    else:
			alert()->error('Surat Gagal di Edit', 'Gagal!')->persistent('OK');
	    endif;
	
	    return back();
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Mail::find($id);

	  if($destroy):
			$file = 'files/'. $destroy->file;
				
	   		File::delete($file);
	
			$destroy->delete();
			alert()->success('Surat Berhasil di Hapus!', 'Berhasil!')->persistent('OK');
		else:
			alert()->success('Surat Gagal di Hapus!', 'Gagal!')->persistent('OK');
		endif;
		
		return back();
    }

	public function download($id){
		
		$file = Mail::find($id)->file;
		$file_target = 'files/'. $file;
		
		return response()->download($file_target);
	}
	
}
