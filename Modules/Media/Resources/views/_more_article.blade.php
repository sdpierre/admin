@if(isset($articles) && !empty($articles))
	<table class="table">
		<tr>
			<th>Article</th>
			<th>Action</th>
		</tr>
	@foreach($articles as $article)
		<tr>
			<td>{{$article->article->title}}</td>
			<td class="action_width">
            <a href="javascript:void(0)" onclick="editArticle('{{$article->media_id}}')" >Edit</a> |
            <a href="{{url('media/create')}}" >Add Photo</a>
            </td>
		</tr>
	@endforeach
	</table>

@endif