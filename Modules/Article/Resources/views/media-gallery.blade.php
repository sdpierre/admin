@if(isset($media_gallery) && !empty($media_gallery))

@if(count($media_gallery) > 0)

<div class="row">
@foreach($media_gallery as $media)

<div class="col-md-2">
	@php $image_url = url('/images_lenouvelliste/articles/'. $media->folder_date.'/'.$media->filename) @endphp
	<div class="media_photo_block">
	<label class="img-container">
		
	  <input type="radio" name="media_id" class="media_photo_id" value="{{ $media->id }}">
	  <span class="checkmark"></span>

			<img src="{{ $image_url }}" width="150px" height="100px">
	 
	</label>
	</div>

	
	</div>
@endforeach
</div>

@endif

@endif