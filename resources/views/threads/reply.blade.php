<reply inline-template :attributes="{{ $reply }}" v-cloak>
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
                    <favorite :reply="{{ $reply }}">组件损坏</favorite>
{{--                    <form action="/replies/{{ $reply->id }}/favorites" method="post">--}}
{{--                        {{ csrf_field() }}--}}
{{--                        <button type="submit" class="btn btn-outline-primary" {{ $reply->isFavorited() ? 'disabled' : '' }}>--}}
{{--                            {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}--}}
{{--                        </button>--}}
{{--                    </form>--}}
                </div>
            </div>

        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-sm btn-primary" @click="update">Update</button>
                <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
            </div>
            <div v-else v-text="body">
                {{ $reply->body }}
            </div>
        </div>
        @can('update', $reply)

            <div class="card-footer level">

                <button class="btn btn-light btn-sm mr-1" @click="editing = true">Edit</button>

                <button class="btn btn-danger btn-sm mr-1" @click="destroy">Delete</button>
            </div>
        @endcan
    </div>
</reply>