@extends('welcome')

@section('content')

@section('title')
Add Photo
@stop
 @if(isset($article) && !empty($article))
<h2> Add photo to: {{ $article->title }}</h2>
<br>


<div class="add-photo-section">
  <div class="row">
    @if(isset($media_articles) && !empty($media_articles))
    @if(count($media_articles) > 0)
    @foreach($media_articles as $media_article)
    <div class="col-md-3">
      <div class="add-photo-column">
        <div class="photo">
          <div class="article-photo">
            @php $url = url('images_lenouvelliste/articles/'. $media_article->media[0]->folder_date.'/'.$media_article->media[0]->filename) @endphp
            <img src="{{ $url }}">
          </div>
        </div>
        <div class="del-edit-btn">
          <a href="javascript:;" data-article-id="{{$article->id}}" data-id="{{ $media_article->id }}" class="article-photo-modal">Delete</a> | <a href="javascript:;" data-article-id="{{$article->id}}" data-id="{{ $media_article->id }}" class="edit-article-photo-modal">Edit</a>
        </div>
        <div class="photo-caption">
          <label>Caption</label>
          <input type="text" readonly="" value="{{$media_article->media[0]->caption}}" />
        </div>
        <div class="photo-desc">
          <label>Description</label>
          <textarea readonly="">{{$media_article->media[0]->description}}</textarea>
        </div>
        <div class="photo-featured">
          <label>Featured Image</label>
          <input type="radio" name="featured" onclick="addFeaturedPhoto(this)" data-article-id="{{$article->id}}" data-id="{{ $media_article->id }}" @if($media_article->is_featured == 'TRUE'){{'checked="checked"'}}@endif />
        </div>
      </div>
    </div>
    @endforeach
    @endif
    @endif
    <div class="col-md-3">
      <div class="add-photo-column">
        <div class="photo">
          <div class="add-photo-btn" data-articleid="{{$article->id}}">
            Add photo
          </div>
        </div>
        <div class="del-edit-btn">
        </div>
        <div class="photo-caption">
          <label>Caption</label>
          <input type="text" readonly="" value="" />
        </div>
        <div class="photo-desc">
          <label>Description</label>
          <textarea readonly=""></textarea>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="add-more">
        <a href="javascript:void(0);" class="add_button" title="Add field" data-id="{{$article->id}}">Add more</a>
      </div>
    </div>
  </div>
</div>
@endif

@stop