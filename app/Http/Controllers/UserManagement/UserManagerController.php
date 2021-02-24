<?php

namespace App\Http\Controllers\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User as Obj;
class UserManagerController extends Controller
{   
    public function __construct(){
        // load the app, module and component name to object params
        $this->app      =   'UserManagement';
        $this->module   =   'User';
        $this->componentName = componentName('agency');
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Obj $obj,Request $request)
    {   
        // authorize the app
        $this->authorize('viewAny', $obj);

        $search_query = $request->input('search_query');
        
        $obj = $obj->where('name','LIKE',"%$search_query%")->paginate(10);
        return view("apps.".$this->app.".".$this->module.".index")
                ->with("app", $this)
                ->with("objs", $obj); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Obj $obj)
    {   
        // authorize the app
        $this->authorize('create', $obj);
        
        $user=Auth::user()->role;
        $types = array(
            'superadmin' => ['superdeveloper','supermanager','supermoderator','agencyadmin','agencydeveloper','agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],
            'superdeveloper'=>['supermanager','supermoderator','agencyadmin','agencydeveloper','agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
            'supermanager'=>['supermoderator','agencyadmin','agencydeveloper','agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
            'supermoderator'=>['agencyadmin','agencydeveloper','agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
            'agencyadmin'=>['agencydeveloper','agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
            'agencydeveloper'=>['agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
            'agencymanager'=>['agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
            'agencymoderator'=>['clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
            'clientadmin'=>['clientdeveloper','clientmanager','clientmoderator','user'],          
            'clientdeveloper'=>['clientmanager','clientmoderator','user'],          
            'clientmanager'=>['clientmoderator','user'],          
            'clientmoderator'=>['user'],          
                   
        );
        
        //ddd($types[$user]);
        return view("apps.".$this->app.".".$this->module.".createEdit")
        ->with('stub', "create")
        ->with("app", $this)
        ->with("obj", $obj)
        ->with("users",$types[$user]);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Obj $obj)
    {   
        $this->authorize('create', $obj);
        $obj = $obj->create($request->all());
        
        return redirect()->route($this->module.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Obj $obj)
    {   
        // authorize the app
        $this->authorize('viewAny', $obj);
        $objs = obj::find($id);
        return view("apps.".$this->app.".".$this->module.".show")
                    ->with("app", $this)
                    ->with("stub", "update")
                    ->with("objs", $objs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Obj $obj)
    {   
        
        $obj = $obj->getRecord($id);
        // authorize the app
        $this->authorize('edit', $obj);
        $user=Auth::user()->role;
        $types = array(
        'superadmin' => ['superdeveloper','supermanager','supermoderator','agencyadmin','agencydeveloper','agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],
        'superdeveloper'=>['supermanager','supermoderator','agencyadmin','agencydeveloper','agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
        'supermanager'=>['supermoderator','agencyadmin','agencydeveloper','agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
        'supermoderator'=>['agencyadmin','agencydeveloper','agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
        'agencyadmin'=>['agencydeveloper','agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
        'agencydeveloper'=>['agencymanager','agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
        'agencymanager'=>['agencymoderator','clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
        'agencymoderator'=>['clientadmin','clientdeveloper','clientmanager','clientmoderator','user'],          
        'clientadmin'=>['clientdeveloper','clientmanager','clientmoderator','user'],          
        'clientdeveloper'=>['clientmanager','clientmoderator','user'],          
        'clientmanager'=>['clientmoderator','user'],          
        'clientmoderator'=>['user'],          
               
    );
       // $obj = $obj->getRecord($id);

        return view("apps.".$this->app.".".$this->module.".createEdit")
              ->with("stub", "update")
              ->with("app", $this)
              ->with("obj", $obj)
              ->with("users",$types[$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,Obj $obj)
    {   
        $obj = $obj->getRecord($id);
        // authorize the app
        $this->authorize('update', $obj);
        $obj = Obj::where('id',$id)->first();
        $obj = $obj->update($request->all());
        return redirect()->route($this->module.'.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Obj $obj)
    {   
        // authorize the app
        $this->authorize('destroy', $obj);
        $obj = Obj::where('id',$id)->delete();
        return redirect()->back();
    }
}
