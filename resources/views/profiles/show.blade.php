@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-10">
                <div class="page-header">
                    <h1>
                        {{ $profileUser->name }}
                        <small> 注册于 {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h1>
                </div>
                @foreach($threads as $thread)
                    <div class="card mt-2">
                        <div class="card-header">
                            <div class="level">
                                <span class="flex">
                                    <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> 发表于

                                    {{ $thread->title }}
                                </span>

                                <span>{{ $thread->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $thread->body }}
                        </div>

                    </div>
                @endforeach
                <div class="mt-4"></div>
                {{ $threads->links() }}
            </div>
        </div>
    </div>

@endsection