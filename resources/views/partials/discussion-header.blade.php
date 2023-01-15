<div class="card-header d-flex justify-content-between">
    <div>
        <img width="50" height="50" style="border-radius: 50%" src="{{ Gravatar::src($discussion->author->email) }}" alt="">
        <p class="ml-2 font-weight-bold d-inline-block">{{ $discussion->author->name }}</p>
    </div>
    <div>
        <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>
    </div>
</div>