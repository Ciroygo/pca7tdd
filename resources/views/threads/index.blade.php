@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">forum Threads</div>

                    <div class="card-body">
                        @forelse($threads as $thread)
                            <article>
                                <div class="level">
                                    <h4 class="flex">
                                        <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                                    </h4>
                                    <a href="{{ $thread->path() }}">
                                        {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                                    </a>
                                </div>
                                <div class="body">{{ $thread->body }}</div>
                            </article>

                            <hr>
                        @empty
                            <p>没有相关文章以供显示</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
