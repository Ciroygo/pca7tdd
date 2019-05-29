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
                @foreach($activities as $date => $activity)
                    <h3 class="page-header mt-5">{{ $date }}</h3>

                    @foreach($activity as $record)
                        @include("profiles.activities.{$record->type}", ['activity' => $record])
                    @endforeach
                @endforeach
{{--                @foreach($threads as $thread)--}}
{{--                    <div class="card mt-2">--}}
{{--                        <div class="card-header">--}}
{{--                            <div class="level">--}}
{{--                                <span class="flex">--}}
{{--                                    <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> 发表于--}}

{{--                                    <a href="{{ $thread->path() }}">{{ $thread->title }}</a>--}}
{{--                                </span>--}}

{{--                                <span>{{ $thread->created_at->diffForHumans() }}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $thread->body }}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endforeach--}}
{{--                <div class="mt-4"></div>--}}
{{--                {{ $threads->links() }}--}}
            </div>
        </div>
    </div>

@endsection