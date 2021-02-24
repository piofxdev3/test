<?php

namespace App\Http\Controllers\Loyalty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Loyalty\Reward as Obj;
use App\Models\Loyalty\Customer;

use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{

    /**
     * Define the app and module object variables and component name 
     *
     */
    public function __construct(){
        // load the app, module and component name to object params
        $this->app      =   'Loyalty';
        $this->module   =   'Reward';
        $this->componentName = componentName('agency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Obj $obj)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Obj $obj)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Obj $obj, Request $request)
    {
        // Authorize the request
        // $this->authorize('create', $obj);
        
        // Get customer id
        $customer = Customer::where("id", $request->input('customer_id'))->first();

        // Get data from request object
        $credit = $request->input('credit');
        $redeem = $request->input('redeem');

        // Store the records
        $obj->create([
            "customer_id" => $customer->id,
            "phone" => $customer->phone,
            "credits" => $request->input('credit'),
            "redeem" => $request->input('redeem'),
        ]);

        if($request->current_url){
            return redirect($request->current_url);
        }

        return redirect()->route($this->module.'.public', ['phone' => $customer->phone]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Obj $obj, Request $request)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, Obj $obj)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obj $obj, $phone)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
   
    }

    public function public( Request $request){

        // Check if request object is empty
        if(!empty($request->input('phone'))){
            // Validate the request object
            $validated = $request->validate([
                "phone" => 'required|digits:10',
            ]);

            // Retrieve request variable
            $phone = $request->input('phone');
            
            $obj = new Obj;
            // Retrieve records with that particular phone number
            $objs = $obj->where('phone', $phone)->get(); 
            
            // Execute only if there is atleast one record
            if($objs->count() >= 1){     
                // Initialize required variables   
                $remaining_credits = 0;

                // Calculate the remaining reward points
                foreach($objs as $reward){
                    $remaining_credits = $remaining_credits + ($reward->credits - $reward->redeem);
                }
                
                return view("apps.".$this->app.".".$this->module.".public")
                    ->with("app", $this)
                    ->with("objs", $objs)
                    ->with("phone", $phone)
                    ->with("remaining_credits", $remaining_credits);
            }  
    
            return view("apps.".$this->app.".".$this->module.".public")
                    ->with("app", $this)
                    ->with("objs", $objs)
                    ->with("phone", $phone)
                    ->with("alert", "No Records Found. Please talk with the Sales Executive");
        }

        return view("apps.".$this->app.".".$this->module.".public")
            ->with("app", $this);
    }
}
