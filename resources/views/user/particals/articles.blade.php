<ul class="list-group">
    @forelse($articles as $article)
        <li class="list-group-item">
            <a href="{{ url('', ['id' => $article->slug]) }}">{{ $article->title }}</a>
            <span class="meta">
                in <span class="timeago">{{ $article->created_at }}</span>
            </span>
        </li>
    @empty
        <li class="nothing">{{ lang('Nothing') }}</li>
    @endforelse
</ul>