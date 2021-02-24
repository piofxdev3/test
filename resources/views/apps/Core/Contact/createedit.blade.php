
<x-dynamic-component :component="$app->componentName" class="mt-4" >

	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-4 font-size-sm ">
		<li class="breadcrumb-item">
			<a href="{{ route('dashboard')}}" class="text-muted">Dashboard</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route($app->module.'.index') }}"  class="text-muted">{{ ucfirst($app->module) }}</a>
		</li>
		@if($stub!='Create')
		<li class="breadcrumb-item">
			<a href="" class="text-muted">{{ $obj->name }}</a>
		</li>
		@endif
	</ul>
	<!--end::Breadcrumb-->



  @if($stub=='Create')
    <form method="post" action="{{route($app->module.'.store')}}" enctype="multipart/form-data">
  @else
    <form method="post" action="{{route($app->module.'.update',$obj->id)}}" enctype="multipart/form-data">
  @endif  

	<!--begin::basic card-->
	<x-snippets.cards.action :title="$app->module " class="border"  >
  
        <div class="js-form-message form-group mb-4">
            <label for="inputName" class="input-label">Name</label>
            <input type="text" class="form-control" name="name" id="inputName" placeholder="Alex Hecker" aria-label="Alex Hecker" required
                   data-msg="Please enter your name." value="@if(isset($obj->name)) {{$obj->name}} @endif">
          </div>
          <div class="js-form-message form-group mb-4">
            <label for="emailAddressExample2" class="input-label">Email address</label>
            <input type="email" class="form-control" name="email" id="emailAddressExample2" placeholder="alexhecker@pixeel.com" aria-label="alexhecker@pixeel.com" required
                   data-msg="Please enter a valid email address." value="@if(isset($obj->email)) {{$obj->email}} @endif">
          </div>
          <div class="js-form-message form-group mb-4">
            <label for="descriptionTextarea" class="input-label">Message</label>
            <textarea class="form-control" rows="3" name="message" id="descriptionTextarea" placeholder="Hi there, I would like to ..." required
                      data-msg="Please enter your message.">@if(isset($obj->message)) {{$obj->message}} @endif</textarea>
          </div>
      
      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="client_id" value="{{ session()->get('client_id') }}">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="client_id" value="{{ session()->get('client_id') }}">
      
    
    
	</x-snippets.cards.action>
	<!--end::basic card-->   
  </form>

</x-dynamic-component>