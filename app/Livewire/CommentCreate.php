<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class CommentCreate extends Component
{
  public string $comment = '';

  public Post $post;

  //   for editing comment
  public ?Comment $commentModel = null;
  public ?Comment $parentComment = null;

  public function mount(Post $post, $commentModel = null, $parentComment = null)
  {
    $this->post = $post;

    //   for editing comment
    $this->commentModel = $commentModel;
    $this->comment = $commentModel ? $commentModel->comment : '';

    $this->parentComment = $parentComment;
  }

  public function render()
  {
    return view('livewire.comment-create');
  }

  public function createComment()
  {
    $user = auth()->user();
    if (!$user) {
      return $this->redirect('/login');
    }

    if ($this->commentModel) {
      //   Updating a comment
      if ($this->commentModel->user_id != $user->id) {
        return response('You are not allowed to perform this action', 403);
      }

      $this->commentModel->comment = $this->comment;
      $this->commentModel->save();

      $this->comment = '';
      // Emit an event after comment update
      $this->dispatch('commentUpdated');
    } else {
      //   Creating new comment
      $comment = Comment::create([
        'comment' => $this->comment,
        'post_id' => $this->post->id,
        'user_id' => $user->id,
        'parent_id' => $this->parentComment?->id
      ]);

      // Emit an event after comment creation
      $this->dispatch('commentCreated', comment: $comment->id);

      // Reset the comment input
      $this->comment = '';
    }
  }
}
