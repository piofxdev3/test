
<x-dynamic-component :component="$app->componentName" class="mt-4" >

	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-4 font-size-sm ">
		<li class="breadcrumb-item">
			<a href="{{ route('dashboard')}}" class="text-muted">Dashboard</a>
		</li>
		
		<li class="breadcrumb-item">
			<a href="" class="text-muted">{{ $obj->name }} Settings</a>
		</li>

	</ul>
	<!--end::Breadcrumb-->


  <!--begin::Alert-->
  @if(isset($alert))
    <x-snippets.alerts.basic>{{$alert}}</x-snippets.alerts.basic>
  @endif
  <!--end::Alert-->

	<!--begin::basic card-->
	<x-snippets.cards.basic>
      <h1 class="p-5 rounded border bg-light mb-3">
        Settings 
       </h1>
      
      <form method="post" action="{{route($app->module.'.update',$obj->id)}}" enctype="multipart/form-data">
    
      
      <div class="form-group">
        <label for="formGroupExampleInput ">Domain</label>
        <input type="text" class="form-control" name="domain" id="formGroupExampleInput" value = "{{ $obj->domain }}" disabled>
      </div>

      <div class="form-group ">
        <label for="formGroupExampleInput ">Settings (json format)</label>
        <div class="border">
        <textarea id="editor" class="form-control border" name="settings"  rows="5">@if($stub=='Create'){{ (old('settings')) ? old('settings') : '' }}@else{{ json_encode(json_decode($obj->settings),JSON_PRETTY_PRINT) }}@endif
        </textarea>
      </div>
      </div>
      
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="setting" value="1">
        <input type="hidden" name="id" value="{{ $obj->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-info">Save</button>
    </form>
    
	</x-snippets.cards.basic>
	<!--end::basic card-->   

</x-dynamic-component>