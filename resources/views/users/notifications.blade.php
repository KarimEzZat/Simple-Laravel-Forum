@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Notifications</div>

        <div class="card-body">
           <ul class="list-group">
               @foreach($notifications as $notification)
               <li class="list-group-item d-flex justify-content-between">
                   @if($notification->type === 'LaravelForum\Notifications\NewReplyAdded')
                       A new reply was added to your discussions.

                       <strong>{{ $notification->data['discussion']['title'] }}</strong>

                       <a href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}" class="btn btn-sm btn-info text-white">View Discussion</a>
                   @endif

                       @if($notification->type === 'LaravelForum\Notifications\ReplyMarkedAsBestReply')
                           Your reply to discussion

                           <strong>
                               {{ $notification->data['discussion']['title'] }}
                           </strong>
                           <span> was marked as best reply.</span>
                           <a href="{{ route('discussions.show', $notification->data['discussion']['title']) }}" class="btn btn-sm btn-info text-white">View Discussion</a>
                       @endif
               </li>
               @endforeach
           </ul>
        </div>
    </div>
@endsection
