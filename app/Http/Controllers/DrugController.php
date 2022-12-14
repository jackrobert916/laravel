<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use Redirect;
use App\Exports\UsersExport;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
class DrugController extends Controller{


	public function __construct(){
        $this->middleware('auth');
    }

    public function export_csv(){
        $file_name = 'drug_'.date('Y_m_d_H_i_s').'.csv';
    	return  Excel::download(new UsersExport,  $file_name);

    }
    public function import_csv(){

        Excel::import(new UserImport, request()->file('file'));
        return Redirect::route('drug.all')->with('success','Data Imported Successfully');
    }

    //
    public function create(){
    	return view('drug.create');

    }

    public function store(Request $request){

    	$validatedData = $request->validate([
        	'trade_name' => 'required',
        	'generic_name' => 'required',
    	]);



        $drug = new Drug();


		$drug->trade_name = $request->trade_name;
		$drug->generic_name = $request->generic_name;
		$drug->note = $request->note;
		$drug->Price = $request->Price;
		$drug->Stock = $request->Stock;

		$drug->save();

    	return Redirect::route('drug.all')->with('success', __('sentence.Drug added Successfully'));
    }

    public function all(){
    	$drugs = Drug::all();

    	return view('drug.all',['drugs' => $drugs]);
    }


    public function edit($id){
        $drug = Drug::find($id);
        return view('drug.edit',['drug' => $drug]);
    }

    public function store_edit(Request $request){

        $validatedData = $request->validate([
            'trade_name' => 'required',
            'generic_name' => 'required',
        ]);

        $drug = Drug::find($request->drug_id);

        $drug->trade_name = $request->trade_name;
        $drug->generic_name = $request->generic_name;

        $drug->save();

        return Redirect::route('drug.all')->with('success', __('sentence.Drug Edited Successfully'));

    }

    public function destroy($id){

        Drug::destroy($id);
        // var_dump($id);die();
        return Redirect::route('drug.all')->with('success', __('sentence.Drug Deleted Successfully'));

    }
}
