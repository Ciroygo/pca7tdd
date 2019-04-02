@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <a href="#">{{ $thread->creator->name }}</a> 发表了：
                        {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                @foreach ($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>
        @if (auth()->check())
            <div class="row mt-4">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{ $thread->path() . '/replies' }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="5" class="form-control" placeholder="说点什么吧。。。"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center mt-4">请先<a href="{{ route('login') }}">登陆</a>，然后在发表回复</p>
        @endif
    </div>
@endsection
