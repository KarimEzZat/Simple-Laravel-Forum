<?php

namespace LaravelForum;

use LaravelForum\Notifications\ReplyMarkedAsBestReply;

class Discussion extends Model
{
    //
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // find by slug column instead of id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Query Scope

    public function scopeFilterByChannels($query)
    {
     if (request()->query('channel'))
     {
         $channel = Channel::where('slug', request()->query('channel'))->first();
         if ($channel){

             return $query->where('channel_id', $channel->id);
         }
         return $query;
     }

     return $query;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function markAsBestReply(Reply $reply)
    {
        $this->update([
            'reply_id' => $reply->id
        ]);

        if ($reply->owner->id === $this->author->id){

            return;
        }

        $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));
    }

    public function bestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }
}
