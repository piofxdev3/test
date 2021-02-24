
<x-dynamic-component :component="$app->componentName" class="mt-4" >

	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-4 font-size-sm ">
		<li class="breadcrumb-item">
			<a href="{{ route('dashboard')}}" class="text-muted">Dashboard</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route($app->module.'.index',$app->id) }}"  class="text-muted">{{ ucfirst($app->module) }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="" class="text-muted">{{ $obj->name }}</a>
		</li>
	</ul>
	<!--end::Breadcrumb-->

	<!--begin::Alert-->
	@if($alert)
	  <x-snippets.alerts.basic>{{$alert}}</x-snippets.alerts.basic>
	@endif
	<!--end::Alert-->

	<!--begin::Titlecard-->
	<x-snippets.cards.titlecard :title="$obj->name" :id="$obj->id" :module="$app->module" :obj="$obj" :appid="$app->id" />
	<!--end::Titlecard-->


	<!--begin::basic card-->
	<x-snippets.cards.basic>
		<div class="row mb-2">
			<div class="col-md-4"><b>Name</b></div>
			<div class="col-md-8">{{ $obj->name }}</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><b>Slug</b></div>
			<div class="col-md-8">{{ $obj->slug }} <a href="{{ route('Page.theme',[$app->id,$obj->id]) }}" target="_blank" class="pl-3"><i class="flaticon-paper-plane text-primary"></i> view page</a></div>
		</div>

		
		<div class="row mb-2">
			<div class="col-md-4"><b>Client</b></div>
			<div class="col-md-8">{{ $obj->client->name }} ({{ $obj->client->domain }})</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><b>Html </b></div>
			<div class="col-md-8">
				<pre><code style="white-space: pre-wrap">{{ $obj->html}}</code></pre>
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><b>Html minified</b></div>
			<div class="col-md-8">
				<pre><code style="white-space: pre-wrap">{{ $obj->html_minified}}</code></pre>
			</div>
		</div>

		<div class="row mb-2">
			<div class="col-md-4"><b>Settings</b></div>
			<div class="col-md-8">
				<pre><code style="white-space: pre-wrap">{{ $obj->settings}}</code></pre>
			</div>
		</div>

		<div class="row mb-2">
			<div class="col-md-4"><b>Status</b></div>
			<div class="col-md-8">@if($obj->status==0)
				<span class="badge badge-warning">Inactive</span>
				@elseif($obj->status==1)
				<span class="badge badge-success">Active</span>
			@endif</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><b>Created At</b></div>
			<div class="col-md-8">{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</div>
		</div>
	</x-snippets.cards.basic>
	<!--end::basic card-->   

</x-dynamic-component>