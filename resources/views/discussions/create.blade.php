@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Add Discussion</div>

        <div class="card-body">
            <form action="{{ route('discussions.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input id="title" type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="channel">Channel</label>
                    <select class="form-control" name="channel" id="channel">
                        @foreach($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button class="btn btn-success" type="submit">Create Discuusion</button>
                </div>
            </form>
        </div>
    </div>
@endsection
