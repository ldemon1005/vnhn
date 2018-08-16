@foreach($list_article as $article)
	<option value="{{ $article->id }}">{{ $article->title }}</option>
@endforeach