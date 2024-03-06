<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\On;

class CommentItem extends Component
{
  public Comment $comment;
  public bool $editing = false;
  public bool $replying = false;

  public function mount(Comment $comment)
  {
    $this->comment = $comment;
  }

  public function render()
  {
    return view('livewire.comment-item');
  }

  public function deleteComment()
  {
    $user = auth()->user();
    if (!$user) {
      return $this->redirect('/login');
    }

    if ($this->comment->user_id != $user->id) {
      return response('You are not allowed to perform this action', 403);
    }

    $id = $this->comment->id;

    $this->comment->delete();
    $this->dispatch('commentDeleted', id: $id);
  }

  public function startCommentEdit()
  {
    $this->editing = true;
  }

  #[On('cancelEditing')]
  public function cancelEditing()
  {
    $this->editing = false;
    $this->replying = false;
  }

  #[On('commentUpdated')]
  public function commentUpdated()
  {
    $this->editing = false;
  }

  public function startReply()
  {
    $this->replying = true;
  }

  #[On('commentCreated')]
  public function commentCreated()
  {
    $this->replying = false;
  }
}
