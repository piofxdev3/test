<x-dynamic-component :component="$app->componentName">
  
  <div class="container my-5 bg-white rounded-lg p-5 shadow-sm">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Sorry!</strong> There were some problems with your HTML input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div> 
    @endif

    @if($stub == "create")
        <form method="POST" action="{{ route($app->module.'.store') }}" enctype="multipart/form-data">
    @else
        <form method="POST" action="{{ route($app->module.'.update', $obj->id) }}" enctype="multipart/form-data">
    @endif
    @csrf
      <h3 class="text-center font-weight-bold my-5">Create User Account</h3>
        <div class="form-row">
                <h5>Name :</h5>
                <input type="text" class="form-control" placeholder="Enter First name" name="name" value="@if($stub == 'update'){{ $obj ? $obj->name : '' }}@endif">
        </div>
        <div class="form-row">
            @if($stub != 'update')
            <div class="form-group col-12 mt-3 @if($stub != 'update'){{'col-md-6'}}@endif">
                <h5>Email :</h5>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="@if($stub == 'update'){{ $obj ? $obj->email : '' }}@endif">
            </div>
            @endif
                <div class="form-group col-md-6 mt-3">
                    <h5>Password :</h5>
                    <div class="row">
                    <div class="col">
                    <input type="password" class="form-control" id="password-field" placeholder="Password" name="password" value="@if($stub == 'update'){{ $obj ? $obj->password : '' }}@endif">
                    </div>
                    <div class="col mt-3 ml-0">
                    <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
                    </div>
                    </div>
                </div>
                
        </div>
        
        <div class="form-row">
            <label class="mt-3 mr-3">Role:</label>
                <select class="form-select" aria-label="Default select example" name="role">
                @foreach($users as $user)
                   <option value="{{$user}}" {{$user == $obj->role ? 'selected' : ''}}>{{$user}}</option>
                @endforeach 
                </select>
        </div>
      
     
        <div class="form-group">
            <label class="mt-3">Phone:</label>
            <div class="input-group">
                <div class="input-group-text">+91</div>
                <input type="text" class="form-control" name="phone" value="{{ old('phone') }} @if($stub == 'update'){{ $obj->phone }}@endif">
            </div>
        </div>
        @if($stub=='update')
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{ $obj->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">  
        @endif
   
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </form>
  </div>
</x-dynamic-component>