@if(isset($articles) && !empty($articles))
	<table class="table">
		<tr>
			<th></th>
			<th>Title</th>
			<th>Type</th>
			<th>Date</th>
			<th>Status</th>
		</tr>
	@foreach($articles as $article)
		<tr>
			<td><input type="radio" name="article_id" value="{{ $article->id_article}}"></td>
			<td>{{ substr($article->titre, 0, 15) . '...' }}</td>
			<td>{{ 'Article' }}</td>
			<td>{{ date('m/d/Y', strtotime($article->created_at)) }}</td>
			@if($article->ispublished == 'TRUE')
				<td>{{ 'Published' }}</td>
			@else
				<td>{{ 'Unpublished' }}</td>	
			@endif
			
		</tr>
	@endforeach
	</table>

	<div class="article-list">
	{{ $articles->links() }}
	</div>
@endif