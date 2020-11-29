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

                $updateImage = DB::table('invoice')->where('auctionID','=',$auctionID)->update(['invoice_image'=>$invoice_image_name]); 
            }

            if($updateImage > 0){
                $response['status'] = true;
                $response['response'] = "Image uploaded successfully";
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
}
