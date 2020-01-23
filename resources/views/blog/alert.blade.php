@if (isset($categoryName))
    <div class="alert alert-info">
        Category: <strong>{{ $categoryName }}</strong>
    </div>
@endif

@if (isset($authorName))
    <div class="alert alert-info">
        Author: <strong>{{ $authorName }}</strong>
    </div>
@endif

@if (isset($tagName))
    <div class="alert alert-info">
        Tag: <strong>{{ $tagName }}</strong>
    </div>
@endif

@if ($search = request('query'))
    <div class="alert alert-info">
        Search Result: <strong>{{ $search }}</strong>
    </div>
@endif
