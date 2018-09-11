{{-- @foreach($list_article as $article)
	<option value="{{ $article->id }}" class="opt2" {{ in_array($article->id, $option_id) ? 'selected' : '' }}>{{ $article->title }}</option>
@endforeach --}}

@foreach($list_article as $article)
	<div class="search_value_item" value="{{ $article->id }}">
        {{ $article->title }}
    </div>
@endforeach