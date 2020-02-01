<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Level;
use Alert;

class UserController extends Controller
{
   
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([
         		'auth',
         ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
			'users' => User::paginate(10),
			'levels' => Level::all(),
		];
		
         return view('dashboard.user.index', $data);
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
        $store = User::create([
		'name' => $request->nama,
		'email' => $request->email,
		'level_id' => $request->level,
		'password' => Hash::make($request->password)
        ])->profile()->create();

		if($store)
			{
				alert()->success('Data Berhasil di Tambahkan', 'Berhasil!')->persistent('OK');
		     }else{
				alert()->error('Data Gagal di Tambahkan', 'Gagal!')->persistent('OK');
		     }
		
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
	    		'user' => User::find($id),
			'profile' => Profile::find(auth()->user()->id)	
	    ];
	
        return view('dashboard.user.profile', $data);
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
        $update = User::find($id);

		$update->update([
			'name' => $request->nama,
			'email' => $request->email,
		]);
		
		$update->profile()->update([
			'number_phone' => $request->nomor_telepon,
			'address' => $request->alamat	
		]);
		
		if($request->password != null):
			User::find($id)->update([
				'password' => Hash::make($request->password)
			]);
		endif;
		
		if($update):
			alert()->success('Data Berhasil di Simpan', 'Berhasil!')->persistent('OK');
		else:
			alert()->eeror('Terjadi kesalahan saat Menyimpan Data', 'ERROR!')->persistent('OK');
		endif;
	
		return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id$id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if ($user = User::find($id)->delete()):
		   alert()->success('Data Pengguna Berhasil di Hapus', 'Berhasil!')->persistent('OK');
	    else :
		   alert()->error('Data Pengguna Gagal di Hapus', 'Gagal!')->persistent('OK');
	    endif;
	
		return back();
    }

    public function dashboard(){

		$data = [
			'user' => User::find(auth()->user()->id)
		];
		
		return view('dashboard.index', $data);
	}
}
