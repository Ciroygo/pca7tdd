@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex">
                                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> 发表了：
                                {{ $thread->title }}
                            </span>
                            @can('update', $thread)
                                <form action="{{ $thread->path() }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-link">Delete Thread</button>
                                </form>
                            @endcan
                        </div>
                    </div>


                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                <replies :data="{{ $thread->replies }}}"></replies>

{{--                @foreach ($replies as $reply)--}}
{{--                    @include('threads.reply')--}}
{{--                @endforeach--}}
{{--                <div class="mt-4"></div>--}}
{{--                {{ $replies->links() }}--}}

                @if (auth()->check())
                    <form method="post" action="{{ $thread->path() . '/replies' }}" class="mt-4">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="5" class="form-control" placeholder="说点什么吧。。。"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>
                @else
                    <p class="text-center mt-4">请先<a href="{{ route('login') }}">登陆</a>，然后在发表回复</p>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>
                            <a href="#">{{ $thread->creator->name }}</a> 发布于{{ $thread->created_at->diffForHumans() }},
                            当前共有 {{ $thread->replies_count }} 个回复
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
