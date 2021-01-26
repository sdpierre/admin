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
        <button class="btn btn-primary"> Apply filter</button>
        <a href="{{ url('article') }}" class="btn btn-info"> Clear filter</a>
    </form>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
   
    <tbody>
      @if(isset($categories) && !empty($categories))
      @if(count($categories) > 0)
      @foreach($categories as $category)
      @if(count($category['articles']) > 0)
      <tr style="background-color: #ccc;">
        <td>{{ $category['rubriquename'] }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      
      @foreach($category['articles'] as $article)
      <tr>
        <td>{{ $article->titre }}</td>
        <td>
          @if($article->ispublished == 'TRUE')
            {{ 'Published' }}
          @else
            {{ 'Unpublished' }}
          @endif
        </td>
        <td>{{ date('m/d/Y', strtotime($article->created_at)) }}</td>
        <td>{{ $article->surtitre }}</td>
        <td> <a href="{{ url('article/add-photo/'.$article->id_article) }}">add photo</a></td>
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