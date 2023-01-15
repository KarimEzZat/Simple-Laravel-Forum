@extends('layouts.app')

@section('content')

    <div class="card">
        @include('partials.discussion-header')
        <div class="card-body">
            <div class="text-center">
                <strong>
                    {{ $discussion->title }}
                </strong>
            </div>
            <hr>
            {!! $discussion->content !!}

            @if($discussion->bestReply)
                <div class="card my-5 bg-success text-white">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <img width="40" height="40" style="border-radius: 50%" src="{{ Gravatar::src($discussion->bestReply->owner->email) }}" alt="">
                            <span class="font-weight-bold ml-2"> {{ $discussion->bestReply->owner->name }} </span>
                        </div>
                        Best Reply
                    </div>
                    <div class="card-body">
                        {{ $discussion->bestReply->content }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @auth
        @foreach($discussion->replies()->paginate(3) as $reply)
            <div class="card my-5">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <img style="border-radius: 50%" width="50" height="50" src="{{ Gravatar::src($reply->owner->email) }}" alt="">
                        <span class="font-weight-bold ml-3">{{ $reply->owner->name }}</span>
                    </div>
                    <div>
                       @auth
                            @if(auth()->user()->id == $discussion->id)
                                <form action="{{ route('discussions.best-reply', ['discussion'=>$discussion->slug, 'reply'=>$reply->id]) }}" method="post">
                                    @csrf
                                    <button class="btn btn-primary text-white" type="submit">Mark as best reply</button>
                                </form>
                            @endif
                       @endauth
                    </div>
                </div>
                <div class="card-body">
                    {{ $reply->content }}
                </div>
            </div>
        @endforeach
        @endauth
    {{ $discussion->replies()->paginate(3)->links() }}
    <div class="card my-5">
        <div class="card-header">Add Reply</div>
        <div class="card-body">
            @auth
                <form action="{{ route('replies.store', $discussion->slug) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="content">Reply</label>
                        <textarea cols="5" rows="5" id="content" name="content" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" type="submit">Add Reply</button>
                    </div>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-info text-white">Sign in to add reply</a>
            @endauth
        </div>
    </div>
@endsection
