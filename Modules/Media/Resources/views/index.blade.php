@extends('welcome')

@section('content')

@section('title')
Media Library
@stop
<h2> Media Library 
    <a href="{{ url('/') }}/media/create/" class="btn btn-primary"> Add New  </a> 
   
    </h2>
<br>

<div class="jumbotron jumbotron-sm jumbotron-fluid">
    <form method="get">
        <div class="row">
            <div class="col-sm-3">
                <select name="folder" class="form-control" style="float: left; width:200px; margin-right:10px;">
                    @for ($i = 0; $i < 12; $i++)
                        @php $getMonth = strtotime(sprintf('%d months', $i)) @endphp   
                        @php $monthLabel = date('F', $getMonth)." ".date("Y") @endphp
                        @php $monthval = date('m', $getMonth)."-".date("Y") @endphp
                        <option @if( (!empty($_GET['folder'])) && ($_GET['folder'] == $monthval) ) {{ 'selected' }} @endif value="{{ $monthval }}">{{ $monthLabel }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-sm-3">
                @if(isset($_GET['title']) && !empty($_GET['title'])) @php $title = $_GET['title'] @endphp @endif
               <input type="text" placeholder="Search By Title" class="form-control" name="title" value="@if(isset($title) && !empty($title)) {{ preg_replace('/[^A-Za-z0-9\-+]/', '', $title) }} @endif" style="float: right;  margin-right:10px;">
            </div>
            <div class="col-sm-6">
                @if(isset($_GET['keyword']) && !empty($_GET['keyword'])) @php $keyword = $_GET['keyword'] @endphp @endif
               <input type="text" placeholder="Search By Keyword" data-role="tagsinput" class="form-control" value="@if(isset($keyword) && !empty($keyword)) {{ preg_replace('/[^A-Za-z0-9\-+]/', '', $keyword) }} @endif" name="keyword" style="float: right;  margin-right:10px;">
            </div>
        </div>
        <button class="btn btn-primary"> Apply filter</button>
        <a href="{{ url('media') }}" class="btn btn-info"> Clear filter</a>
    </form>
</div>

<form method="post" id="bulk-form">
    {{ csrf_field() }}
<div class="row">
    <div class="col-sm-5">
        <select class="form-control" id="bulk-delete" style="float: left; width:200px; margin-right:10px;">
            <option>Bulk actions</option>
            <option value="delete">Delete</option>
        </select>
        <button class="btn btn-primary bulk-modal" style="float: left;"> Apply</button>
    </div>
  
</div>


<table class="table table-striped table-bordered" style="margin-top:10px; background:#fff; box-shadow: 0 1px 1px rgba(0,0,0,.04);">
    <thead>
        <tr>
            <th scope="col"> <input type="checkbox" id="all-delete"> </th>
            <th>File</th>
            <th>Author</th>
            <th>Uploaded to</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($allMediaFiles) && !empty($allMediaFiles))
        @if(count($allMediaFiles) > 0)
        @foreach($allMediaFiles as $media)
        <tr>
            <td> <input type="checkbox" class="media" name="media_id[]" value="{{ $media->id }}"> </td>
            <td>
                <img src="{{ url('images_lenouvelliste/articles/'.$media->folder_date.'/'.$media->filename) }}" style="float:left; margin-right:10px;" width="10%">
                @php $image_name = explode('.',$media->filename); @endphp
                <a href="{{ url('images_lenouvelliste/articles/'.$media->folder_date.'/'.$media->filename) }}"> <strong> {{ $media->title }} </strong> </a>
                <p>{{ $media->filename }}</p>
                @if(!empty($media->keyword))
                    @php $keywords = '' @endphp
                    @foreach($media->keyword as $value)
                        @php $keywords .= $value->keyword.',' @endphp
                    @endforeach
                @endif
                <p> <a href="javascript:;" data-id="{{ $media->id }}" data-image="{{ url('public/images_lenouvelliste/articles/'.$media->folder_date.'/'.$media->filename) }}" data-title="{{ $media->title }}" data-desc="{{ $media->description}}" data-keywords="{{ rtrim($keywords,',') }}"  class="image-modal">Edit</a> | <a class="text-danger delete-image" href="javascript:;" data-id="{{ $media->id }}"> Delete Permanently</a> | <a target="blank_" href="{{ url('public/images_lenouvelliste/articles/'.$media->folder_date.'/'.$media->filename) }}">View</a></p>
            </td>
            <td>{{ Auth::user()->username }}</td>
            <td>
                @if($media->is_featured == 'FALSE')
                <p> (Unattached) </p>
                <a href="javascript:;" data-id="{{ $media->id }}" class="attach-modal">Attach</a>
                @else
                <p> {{ substr(getArticleTitleByMediaId($media->id), 0, 10) }} </p>
                <a href="{{ url('media/detach/'.$media->id )}}" >Detach</a>
                @endif
            </td>
            <td>{{ date('m/d/Y', strtotime($media->created_at)) }}</td>
        </tr>
        @endforeach


        @else
        No records found
        @endif


        @endif
    </tbody>
</table>
</form>
<div class="row">
    <div class="col-sm-12">
        <div class="pull-right">
            {{ $allMediaFiles->links() }}
        </div>
    </div>
</div>

@stop