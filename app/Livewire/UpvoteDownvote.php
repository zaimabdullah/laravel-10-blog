<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class UpvoteDownvote extends Component
{
  public Post $post;

  public function mount(Post $post)
  {
    $this->post = $post;
  }

  public function render()
  {
    $upvotes = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)
      ->where('is_upvote', true)
      ->count();

    $downvotes = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)
      ->where('is_upvote', false)
      ->count();

    // The status whether current user has upvoted the post or not.
    // This will be null, true, or false
    // null means user has not done upvote or downvote
    $hasUpvote = null;

    /** @var \App\Models\User $user */
    $user = request()->user();
    if ($user) {
      $model = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)->where('user_id', '=', $user->id)->first();
      if ($model) {
        // convert this to bool
        $hasUpvote = !!$model->is_upvote;
      }
    }

    return view('livewire.upvote-downvote', compact('upvotes', 'downvotes', 'hasUpvote'));
  }

  public function upvoteDownvote($upvote = true)
  {
    /** @var \App\Models\User $user */
    $user = request()->user();
    if (!$user) {
      return $this->redirect('login');
    }
    if (!$user->hasVerifiedEmail()) {
      return $this->redirect(route('verification.notice'));
    }

    // check if there is available upvote-downvote record in DB for current user
    $model = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)->where('user_id', '=', $user->id)->first();

    // if not available, here we create new record
    if (!$model) {
      \App\Models\UpvoteDownvote::create([
        'is_upvote' => $upvote,
        'post_id' => $this->post->id,
        'user_id' => $user->id
      ]);

      return;
    }

    // $upvote = true = like
    // !$upvote = false = dislike
    // if = we check if (user previously has 'like' and now click 'like' again) OR (user previously has 'dislike' and now click 'dislike' again) we delete those action
    // else if (user now just click either 'like or dislike' that he/she never click previously), we save/update to the current action. 
    if ($upvote && $model->is_upvote || !$upvote && !$model->is_upvote) {
      $model->delete();
    } else {
      $model->is_upvote = $upvote;
      $model->save();
    }
  }
}
