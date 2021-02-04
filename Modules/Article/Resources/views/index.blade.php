@extends('welcome')

@section('content')

@section('title')
Publication
@stop
<h2> Publications</h2>
<br>

<div class="jumbotron jumbotron-sm jumbotron-fluid">
    <form method="get">
        <div class="row">
            <div class="col-sm-3">
                <label>Date of Publication</label>
                @if(isset($_GET['datepublication']) && !empty($_GET['datepublication'])) @php $datepublication = $_GET['datepublication'] @endphp @endif
                <input type="date" class="form-control" name="datepublication" value="@if(isset($datepublication) && !empty($datepublication)){{ $datepublication }}@endif">
            </div>
        </div>
        <br>
        <button class="btn btn-primary"> Apply filter</button>
        <a href="{{ url('article') }}" class="btn btn-info"> Clear filter</a>
    </form>
</div>

<style>
  ._3lds {
    border: 2px solid;
    border-radius: 4px;
    display: inline-block;
    flex-shrink: 0;
    height: 4px;
    margin: 0 6px 1px 0;
    width: 4px;
}
.showme {
  display: none;
  
}

.showhim:hover .showme {
  display: block;
}
</style>

<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Post status</th>
      <th scope="col">Photos</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
   
    <tbody>
      @if(isset($categories) && !empty($categories))
      @if(count($categories) > 0)
      @foreach($categories as $category)
      @if(count($category['articles']) > 0)
      <tr style="background-color: #eeeeee;">
        <td> {{ $category['name'] }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      
      @foreach($category['articles'] as $article)
      <tr>
        <td>
          <div class="showhim" style="height:50px;">
            <p> <strong> <a href="#" style="font-size:14px!important;font-weight:600; margin-bottom:10px;"> {{ $article->title }} </a> </strong> </p>
          <div class="showme">
            <a href=""> Modifier </a> | <a href="" style="color:red;"> Corbeille </a> | <a href=""> Afficher </a>
          </div>
        </div>
        </td>
        <td>
          @if($article->is_active == 'TRUE')
            {!! '<span class="_3lds" style="border-color: rgb(66, 183, 42); background-color: rgb(66, 183, 42);"></span> Publier' !!}
          @else
          {!! '<span class="_3lds" style="border-color: rgb(66, 183, 42); background-color: rgb(66, 183, 42);"></span> Non publié' !!}
          @endif
        </td>
        <td>
          <a href="{{ url('article/add-photo/'.$article->id) }}"> <span class="badge badge-danger"> 0 </span> </a>
        </td>
      </tr>
      @endforeach
      
      
      @endif

      @endforeach
      @endif
      @endif
    </tbody>
  </thead>
</table>

@stop