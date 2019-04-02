<div class="card mt-4">
    <div class="card-header">
        <a href="#">
            {{ $reply->owner->name }}
        </a> 回复于
        {{ $reply->created_at->diffForHumans() }}
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>
