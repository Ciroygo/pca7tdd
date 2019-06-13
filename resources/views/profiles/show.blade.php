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
                @forelse($activities as $date => $activity)
                    <h3 class="page-header mt-5">{{ $date }}</h3>

                    @foreach($activity as $record)
                        @if(view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.{$record->type}", ['activity' => $record])
                        @endif
                    @endforeach
                @empty
                    <p>There is no activity for this user yet.</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection