<div class="card mt-4" id="reply-{{ $reply->id }}">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="{{ route('profile', $reply->owner) }}">
                    {{ $reply->owner->name }}
                </a> 回复于
                {{ $reply->created_at->diffForHumans() }}
            </h5>

            <div>
                <form action="/replies/{{ $reply->id }}/favorites" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-outline-primary" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>

    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>
    @can('update', $reply)
        <div class="card-footer">
            <form action="/replies/{{ $reply->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
            </form>
        </div>
    @endcan
</div>
