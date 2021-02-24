<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page\Page as Obj;
use App\Models\Core\Client;
use App\Models\Page\Theme;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Define the app and module object variables and component name 
     *
     */
    public function __construct(){
        // load the app, module and component name to object params
        $this->id       =   request()->route('theme');
        $this->app      =   'Page';
        $this->module   =   'Page';
        $this->componentName = componentName('agency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($theme_id,Obj $obj,Request $request)
    {

        // check for search string
        $item = $request->item;
        // load alerts if any
        $alert = session()->get('alert');


        // authorize the app
        $this->authorize('viewAny', $obj);
        //load user for personal listing
        $user = Auth::user();
        // retrive the listing
        $objs = $obj->getRecords($item,30,$theme_id);

        return view('apps.'.$this->app.'.'.$this->module.'.index')
                ->with('app',$this)
                ->with('alert',$alert)
                ->with('objs',$objs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($theme_id,Obj $obj)
    {
    	
        // authorize the app
        $this->authorize('create', $obj);
        // get the clients
        $clients = Client::where('id',request()->get('client.id'))->get();


        return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('clients',$clients)
                ->with('editor',true)
                ->with('app',$this);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($theme_id,Obj $obj,Request $request)
    {
        try{
            
            /* create a new entry */
            $obj = $obj->create($request->all());

            $obj->processHtml();
            //reload cache and session data
            $obj->refreshCache($theme_id);

            $alert = 'A new ('.$this->app.'/'.$this->module.') item is created!';
            return redirect()->route($this->module.'.show',[$theme_id,$obj->id])->with('alert',$alert);
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                $alert = 'Some error in updating the record';
                return redirect()->back()->withInput()->with('alert',$alert);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($theme_id,$id)
    {
        // load the resource
        $obj = Obj::where('id',$id)->first();
   
        // load alerts if any
        $alert = session()->get('alert');
        // authorize the app
        $this->authorize('view', $obj);


        if($obj)
            return view('apps.'.$this->app.'.'.$this->module.'.show')
                    ->with('obj',$obj)->with('app',$this)->with('alert',$alert);
        else
            abort(404);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function public($page)
    {
        $request = request();
    	// get the url path excluding domain name
    	$slug = request()->path();


    	// get the client id & domain
    	$client_id = request()->get('client.id');
        $theme_id = request()->get('client.theme.id');
    	$domain = request()->get('domain.name');

        $agency_settings = request()->get('agency.settings');
        $client_settings = request()->get('client.settings');

        //dd($agency_settings);

        // load the  app mentioned in the client or agency settings
        if(isset($client_settings->app) && $slug=='/'){
            $app = $client_settings->app;
            $controller = $client_settings->controller;
            $method = $client_settings->method;

            $controller_path = 'App\Http\Controllers\\'.$app.'\\'.$controller;
            return app($controller_path)->$method($request);

        }else if(isset($agency_settings->app) && $slug=='/'){
            $app = $agency_settings->app;
            $controller = $agency_settings->controller;
            $method = $agency_settings->method;

            $controller_path =  'App\Http\Controllers\\'.$app.'\\'.$controller;
           
            return app($controller_path)->$method($request);

        }else{
             // load the resource
            $obj = Cache::get('page_'.$domain.'_'.$theme_id.'_'.$slug, function () use($slug,$client_id,$theme_id){
                return Obj::where('slug',$slug)->where('client_id',$client_id)->where('theme_id',$theme_id)->first();
            });

            // update layout
             $this->componentName = 'themes.barebone.layouts.app';


            if($obj)
                if($obj->status)
                    return view('apps.'.$this->app.'.'.$this->module.'.public')
                        ->with('obj',$obj)->with('app',$this);
                else
                    abort(404,'Page not active');
            else{
                if($slug=='/'){
                    $this->componentName = componentName('agency','default');
                    return view('welcome')->with('app',$this);
                }
                else
                    abort(404,'Page not found');
            }
        }
       
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function theme($theme_id,$page_id)
    {
        

        // get the client id & domain
        $client_id = request()->get('client.id');
        $domain = request()->get('domain.name');


        // load the resource
        $obj = Obj::where('id',$page_id)->where('client_id',$client_id)->where('theme_id',$theme_id)->first();

        // update layout
        $this->componentName = 'themes.barebone.layouts.app';


        if($obj)
            if($obj->status)
                return view('apps.'.$this->app.'.'.$this->module.'.public')
                    ->with('obj',$obj)->with('app',$this);
            else
                abort(404,'Page not active');
        else{
            
                abort(404,'Page not found');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($theme_id,$id)
    {
        // load the resource
        $obj = Obj::where('id',$id)->first();
        // authorize the app
        $this->authorize('view', $obj);
        // get the clients
        $clients = Client::where('id',request()->get('client.id'))->get();

        if($obj)
            return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('clients',$clients)
                ->with('editor',true)
                ->with('app',$this);
        else
            abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($theme_id,Request $request, $id)
    {
        try{
            
            // load the resource
            $obj = Obj::where('id',$id)->first();
            // authorize the app
            $this->authorize('update', $obj);
            //update the resource
            $obj->update($request->all()); 
            //process the  html load by updating variables

            
            $obj->processHtml();

            //reload cache and session data
            $obj->refreshCache($theme_id);

            // flash message and redirect to controller index page
            $alert = 'A new ('.$this->app.'/'.$this->module.'/'.$id.') item is updated!';
            return redirect()->route($this->module.'.show',[$theme_id,$id])->with('alert',$alert);
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                 $alert = 'Some error in updating the record';
                 return redirect()->back()->withInput()->with('alert',$alert);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($theme_id,$id)
    {
        // load the resource
        $obj = Obj::where('id',$id)->first();
        // authorize
        $this->authorize('update', $obj);
        // delete the resource
        $obj->delete();

        // flash message and redirect to controller index page
        $alert = '('.$this->app.'/'.$this->module.'/'.$id.') item  Successfully deleted!';
        return redirect()->route($this->module.'.index',$theme_id)->with('alert',$alert);
    }
}
