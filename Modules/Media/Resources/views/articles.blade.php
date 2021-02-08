@if(isset($articles) && !empty($articles))
<input type="hidden" id="previous" name="previousArticle" value="<?php echo $addedString ?>">
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
			<td><input type="checkbox" onclick="removeAddElement('{{$article->id}}')" <?php echo (in_array($article->id,$addedArticle))?'checked':''?>  class="article_id article_checkbox" id="art_{{ $article->id}}" name="article_id" value="{{ $article->id}}"></td>
			<td>{{ substr($article->title, 0, 15) . '...' }}</td>
			<td>{{ 'Article' }}</td>
			<td>{{ date('m/d/Y', strtotime($article->created_at)) }}</td>
			@if($article->is_active == 'TRUE')
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
@else
@endif

<script>
	$(document).ready(function(){
		console.log($('#previous').val())
	});
</script>