@extends('welcome')
@section('content')
<form action="{{ url('media/store') }}" class="dropzone dz-min dz-clickable" id="dropzone_example">
	{{ csrf_field() }}
	<div class="dz-default dz-message">
		<span>Drop files here to upload</span>
	</div>
</form>
<div id="dze_info" class="hidden"> 
	<br> 
	<div class="panel panel-default"> 
		<div class="panel-heading"> 
			<div class="panel-title">Uploaded Files Info</div> 
		</div> 
		<div class="panel-body with-table">
			<table class="table table-bordered"> 
				<thead> 
					<tr> 
						<th width="40%">File name</th> 
						<th width="15%">Size</th> 
						<th width="15%">Type</th> 
						<th>Status</th> 
					</tr> 
				</thead> 
				<tbody> </tbody> 
				<tfoot> 
					<tr> <td colspan="4"></td> </tr> 
				</tfoot> 
			</table>
		</div> 
	</div> 
</div>
<br>
<div>
	<p>Maximum upload file size: 5 MB.</p>
</div>

@stop