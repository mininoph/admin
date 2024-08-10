<?php

namespace App\Http\Controllers;
 
use App\Models\Payment;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Alert;
use App\Models\Users;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('request.request-pending');
    }

    public function pendinglist(){
        
     $data = DB::table('recharge_request')
      ->join('customer', 'customer.uid', '=', 'recharge_request.user_id')
      ->select('recharge_request.*', 'customer.name')
      ->where('recharge_request.status', '=','Pending')
      ->orderBy('recharge_request.request_id','DESC');
      
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('date', function($data){
             return date('d-m-Y', strtotime($data->date));
        })
        
        ->addColumn('name', function($data){
            return $data->name;
        })
   
        ->addColumn('amount', function($data){
          return '<p style="color:red;">'.$data->amount.'</p>';
        })
        ->addColumn('action', function($data){
            return '<div class="table-actions">
            <button type="button" class="btn btn-success rewa"  id="'.$data->request_id.'" data-id="'.$data->request_id.'" ><i class="ik ik-edit"></i>Update</button>
            <button type="button" class="btn btn-danger remove-paymentreq" data-id="'.$data->request_id.'"><i class="ik ik-trash"></i>Delete</button>
         </div>';
          })
        ->rawColumns(['DT_RowIndex','date','amount','name','action'])
        ->toJson();
    }

    public function list($id){
        $data = DB::table('recharge_request')
      ->join('customer', 'customer.uid', '=', 'recharge_request.user_id')
      ->select('recharge_request.*', 'customer.name')
      ->where('recharge_request.user_id', '=',$id)
      ->orderBy('recharge_request.request_id','DESC');
      
      return Datatables::queryBuilder($data)
      ->addIndexColumn()
      ->addColumn('date', function($data){
             return date('d-m-Y', strtotime($data->date));
        })
        ->addColumn('amount', function($data){
          return '<p style="color:red;">'.$data->amount.'</p>';
        })
        ->addColumn('action', function($data){
            return '<div class="table-actions">
            <button type="button" class="btn btn-success rewa" ><i class="ik ik-edit"></i>Update</button>
            <button type="button" class="btn btn-danger remove-paymentreq" data-id="'.$data->request_id.'"><i class="ik ik-trash"></i>Delete</button>
         </div>';
          })
        ->rawColumns(['DT_RowIndex','date','amount','action'])
       ->toJson();

    }


    public function viewcomplete(){
        return view('request.request-complete');
    }

    public function completelist(){

      $data = DB::table('recharge_request')
      ->join('customer', 'customer.uid', '=', 'recharge_request.user_id')
      ->select('recharge_request.*', 'customer.name')
      ->where('recharge_request.status', '=','Success')
      ->orderBy('recharge_request.request_id','DESC');                  
                        
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('date', function($data){
             return date('d-m-Y', strtotime($data->date));
        })
        
         ->addColumn('name', function($data){
            return $data->name;
        })
        
        ->addColumn('amount', function($data){
          return '<p style="color:red;">'.$data->amount.'</p>';
        })
        ->rawColumns(['DT_RowIndex','date','name','amount'])
        ->toJson();

    }

    public function viewreject(){
        return view('request.request-reject');
    }

    public function rejectlist(){
         $data = DB::table('recharge_request')
      ->join('customer', 'customer.uid', '=', 'recharge_request.user_id')
      ->select('recharge_request.*', 'customer.name')
      ->where('recharge_request.status', '=','Reject')
      ->orderBy('recharge_request.request_id','DESC');    
    
      return Datatables::of($data)
            ->addIndexColumn()
      ->addColumn('date', function($data){
             return date('d-m-Y', strtotime($data->date));
        })
        ->addColumn('remarks', function($data){
            return '<p style="width:200px;"'.$data->remarks.'</p>';
        })
        ->addColumn('amount', function($data){
          return '<p style="color:red;">'.$data->amount.'</p>';
        })
        ->rawColumns(['DT_RowIndex','date','amount','remarks'])
        ->toJson();

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(auth()->user()->role_edit=='false'){
            return redirect('/request-pending')->with('error',env('permission_msg'));
        }
        
         $data=  DB::table('recharge_request')->where('request_id',$request->id)->get();
         $user=  DB::table('customer')->where('uid',$data[0]->user_id)->get()->first()->balance;   
        if($request->type=='Success'){
            $payment =Payment::find($request->id);
            $payment->status=$request->type;   
            $payment->remarks=$request->reason;
                $res=$payment->save();
                if($res){
                    $trns = DB::table('transaction')
                    ->insert(['tran_type'=>'debit',
                                'user_id'=>$data[0]->user_id,
                                'amount'=>$data[0]->amount,
                                'remained_balance'=>$user,
                                'remarks'=>$request->reason ]);
                        if($trns){
                            return redirect('/request-pending')->with('success','Update Succcessfully');
                        }else{
                            return redirect('/request-pending')->with('error','request not updated');
                        }    
                }else{
                    return redirect('/request-pending')->with('error','technical error');
                }       

        }else if($request->type=='Reject'){
            $payment =Payment::find($request->id);
            $payment->status=$request->type;   
            $payment->remarks=$request->reason;
                $res=$payment->save();
                if($res){
                    $trns = DB::table('transaction')
                    ->insert(['tran_type'=>'credit',
                                'user_id'=>$data[0]->user_id,
                                'amount'=>$data[0]->amount,
                                'remained_balance'=>$user,
                                'remarks'=>$request->reason ]);
                        if($trns){
                            $total=$user+$data[0]->amount;
                            $update=Users::find($data[0]->user_id);
                            $update->balance=$total;
                            $update->save();
                            return redirect('/request-pending')->with('success','Update Succcessfully');
                        }else{
                            return redirect('/request-pending')->with('error','request not updated');
                        }    
                }else{
                    return redirect('/request-pending')->with('error','technical error');
                }       
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         if(auth()->user()->role_delete=='false'){
            return env('permission_msg');
        }
        
        Payment::find($id)->delete();
        return 1;
    }
}
