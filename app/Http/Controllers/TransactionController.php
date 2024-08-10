<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public $uid;

    public function index()
    {
      $data =Transaction::orderBy('transaction.id','DESC')->fastPaginate();
      
      return view('transaction',compact('data'));
    }

    public function getTransacitonList(){
      
      
      return Datatables::queryBuilder($data)
      ->addIndexColumn()
      ->addColumn('inserted_at', function($data){
             return date('d-m-Y', strtotime($data->inserted_at));
 
        })
        ->addColumn('tran_type', function($data){
            if($data->tran_type == 'credit'){
                return '<span class="badge badge-success m-1">Credit</span>';
            }else{
                return '<span class="badge badge-danger m-1">Debit</span>';  
            }
        })
        ->rawColumns(['DT_RowIndex','inserted_at','tran_type'])
        ->toJson();
}

    public function usertrack($id){
        $user=Users::find($id);
        return view('pages.track',['id'=>$id,'user'=>$user,'fromrefer'=> Users::where('refferal_id',$user->from_refer)->select('name','uid')->first()]);
    }

    public function getUserTransaciton($id){
    
    $data = DB::table('transaction')
      ->join('customer','customer.uid', '=', 'transaction.user_id')
      ->select('transaction.*', 'customer.name')
      ->where('transaction.user_id','=',$id)
      ->orderBy('transaction.id','DESC');
      
      return Datatables::queryBuilder($data)
        ->addIndexColumn()
        ->addColumn('inserted_at', function($data){
             return date('d-m-Y', strtotime($data->inserted_at));
 
        })
        ->addColumn('tran_type', function($data){
            if($data->tran_type == 'credit'){
                return '<span class="badge badge-success">Credit</span>';
            }else{
                return '<span class="badge badge-danger">Debit</span>';  
            }
        })
        ->rawColumns(['DT_RowIndex','inserted_at','tran_type'])
      ->toJson();
}

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
