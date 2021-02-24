<div class="list-group">
  <a href="{{ route('Theme.show',$app->id)}}" class="list-group-item list-group-item-action active" aria-current="true">
    Theme Settings
  </a>
  <a href="{{ route('Page.index',$app->id)}}" class="list-group-item list-group-item-action">Pages</a>
  <a href="{{ route('Module.index',$app->id)}}" class="list-group-item list-group-item-action">Modules</a>
  <a href="{{ route('Asset.index',$app->id)}}" class="list-group-item list-group-item-action">Assets</a>
</div>