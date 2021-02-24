<x-dynamic-component :component="$app->componentName" class="mt-4" >

  <!--begin::Breadcrumb-->
  <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-4 font-size-sm ">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard')}}" class="text-muted">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href=""  class="text-muted">{{ ucfirst($app->module) }}</a>
    </li>
  </ul>
  <!--end::Breadcrumb-->



  <!--begin::Alert-->
  @if($alert)
    <x-snippets.alerts.basic>{{$alert}}</x-snippets.alerts.basic>
  @endif
  <!--end::Alert-->

  <!--begin::Tiles Widget 13-->
  <div class="card card-custom bgi-no-repeat gutter-b" style="height: 225px; background-color: #663259; background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto; background-image: url({{ asset('themes/metronic/media/svg/patterns/taieri.svg') }}">
    <!--begin::Body-->
    <div class="card-body d-flex align-items-center">
      <div>
        <h1 class="text-white font-weight-bolder line-height-lg mb-0">{{ ucfirst(client('theme'))}}</h1>
        <h5 class="mb-4"><span class="badge badge-warning">Current theme</span></h5>

        <a href="{{ route($app->module.'.show',$app->current_theme_id) }}" class="btn btn-success font-weight-bold px-6 py-3">Configure</a>
      </div>
    </div>
    <!--end::Body-->
  </div>
  <!--end::Tiles Widget 13-->

  <!--begin::Indexcard-->
  <x-snippets.cards.indexcard title="Themes"  :module="$app->module" :action="route($app->module.'.index')"  />
  <!--end::Indexcard-->


  <!--begin::basic card-->
  <x-snippets.cards.basic>
    @if($objs->total()!=0)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#({{$objs->total()}})</th>
                <th scope="col">Name </th>
                <th scope="col">Slug</th>
                <th scope="col">Created </th>
              </tr>
            </thead>
            <tbody>
              @foreach($objs as $key=>$obj)  
              <tr>
                <th scope="row">{{ $objs->currentpage() ? ($objs->currentpage()-1) * $objs->perpage() + ( $key + 1) : $key+1 }}</th>
                <td>
                  <a href=" {{ route($app->module.'.show',$obj->id) }}">
                  {{ $obj->name }}
                  </a>
                </td>
                <td>{{ $obj->slug }}</td>
                <td>{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</td>
              </tr>
              @endforeach      
            </tbody>
          </table>
        </div>
        @else
        <div class="card card-body bg-light">
          No items found
        </div>
        @endif
        <nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-3 @endif">
        {{$objs->appends(request()->except(['page','search']))->links()  }}
      </nav>
  </x-snippets.cards.basic>
  <!--end::basic card-->
</x-dynamic-component>