@props(['title' => 'Card Title','text'=>'Some quick example text to build on the card title and make up the bulk of the cards content.','btn_text'=>'Go Somewhere','btn_link'=>'#'])

<div {{ $attributes->merge(['class' => 'card']) }} >
  <div class="card-body">
    <h5 class="card-title">{{$title}}</h5>
    <p class="card-text">{{$text}}</p>
    <a href="{{$btn_link}}" class="btn btn-primary">{{$btn_text}}</a>
  </div>
</div>