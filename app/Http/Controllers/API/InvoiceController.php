<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Invoice;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function getInvoice(Request $request){
        $userID = $request['userID'];

        if($userID == null || $userID == 0 ){
            return response()->json('user id is required');
        }

        else{
            $data = DB::select("SELECT i.*, a.Make, a.Model, a.ExactModel, a.Year, a.ReserveCost FROM invoice i ".
                              "LEFT JOIN auctions as a on i.auctionID = a.id ".
                              "WHERE i.userID = $userID");

            
            
            return response()->json($data);
        }
    }

    public function saveInvoiceImage(Request $request){

        
        //return $request->all();
        $auctionID = $request['auctionID'];
        $userID = $request['userID'];

        $response = array('response' => '', 'status'=>false);

        $validator = Validator::make($request->all(), [      
            'userID' => ['required', 'string', 'max:255'],
            'auctionID' => ['required', 'string', 'max:255'],
            'payment_proof' => ['required', 'image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }
        else{
            
            $invoice_image = $request->file('payment_proof');
            $invoice_image_name = '';
            $updateImage = 0;

            if($invoice_image != null){
                $invoice_image_name= Str::random(10).$invoice_image->getClientOriginalName();
                $invoice_image->move(public_path().'/image/',$invoice_image_name);

                $updateImage = DB::table('invoice')->where('auctionID','=',$auctionID)->where('userID','=',$userID)->update(['payment_proof'=>$invoice_image_name, 'status'=> 2]); 
            }

            if($updateImage > 0){
                $response['status'] = true;
                $response['response'] = "uploaded successfully";
            }
            else{
                $response['status'] = false;
                $response['response'] = "No Data updated";
            }
          

            

        }
        return $response;


    }   

    public function saveInvoiceData(Request $request){

        $ids = $request['ids'];  

        if($ids != null && count($ids) > 0){

            foreach($ids as $id){

                $data = DB::select("SELECT *  FROM bidding ". 
                                  "WHERE latestBid = (SELECT MAX(latestBid) FROM bidding b WHERE b.auctionID = $id) AND auctionID = $id");

                if(count($data) > 0){
                    $invoice = new Invoice;
                    $invoice->userID = $data[0]->userID;
                    $invoice->auctionID = $data[0]->auctionID;
                    $invoice->status = 1;
                    $invoice->save();
                }

                //return $data;
            }
            //return $test;
        }

    }


    public function uploadinvoice(Request $request){

        
        $auctionID = $request['auctionID'];
        $response = array('response' => '', 'status'=>false);

        $validator = Validator::make($request->all(), [      
            'auctionID' => ['required', 'string', 'max:255'],
            'invoice_image' => ['required', 'image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }
        else{
            
            $invoice_image = $request->file('invoice_image');
            $invoice_image_name = '';
            $updateImage = 0;

            if($invoice_image != null){
                $invoice_image_name= Str::random(10).$invoice_image->getClientOriginalName();
                $invoice_image->move(public_path().'/image/',$invoice_image_name);

                //$updateImage = DB::table('invoice')->where('auctionID','=',$auctionID)->update(['invoice_image'=>$invoice_image_name, 'status'=> 1]); 
               
                $data = DB::select("SELECT * FROM bidding ". 
                                  "WHERE latestBid = (SELECT MAX(latestBid) FROM bidding b WHERE b.auctionID = $auctionID) AND auctionID = $auctionID");

                if(count($data) > 0){

                    $check_invoice = DB::table('invoice')->where("auctionID",'=',$data[0]->auctionID)->where("userID","=",$data[0]->userID)->get();

                    if(count($check_invoice) > 0){
                        DB::table('invoice')->where("auctionID",'=',$data[0]->auctionID)->where("userID","=",$data[0]->userID)->update(['status'=>1]);
                        //$check_invoice->update(['status'=>304]);

                    }
                    else{
                        $invoice = new Invoice;
                        $invoice->userID = $data[0]->userID;
                        $invoice->auctionID = $data[0]->auctionID;
                        $invoice->invoice_image = $invoice_image_name;
                        $invoice->status = 1;
                        $invoice->save();
                    }
                
                    $response['status'] = true;
                    $response['response'] = "Image uploaded successfully";
                }
                else{
                    $response['status'] = false;
                    $response['response'] = "No bid present against this auction";
                }
            }

            // if($updateImage > 0){
            //     $response['status'] = true;
            //     $response['response'] = "Image uploaded successfully";
            // }
            // else{
            //     $response['status'] = false;
            //     $response['response'] = "No Data updated";
            // }
          

            

        }
        return $response;


    }   
}
