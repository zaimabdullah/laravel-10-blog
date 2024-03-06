<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;
use Livewire\Attributes\On;

class Comments extends Component
{
  public Post $post;
  //   public $comments;
  public $amount = 5;

  public function mount(Post $post)
  {
    $this->post = $post;
    $this->loadComments();
  }

  public function loadMore()
  {
    $this->amount += 5;
    $this->loadComments(); // Reload comments with the increased amount
  }

  public function render()
  {
    $comments = $this->loadComments();
    return view('livewire.comments', [
      'comments' => $comments,
    ]);
  }

  #[On('commentCreated')]
  #[On('commentDeleted')]
  public function loadComments()
  {
    return Comment::where('post_id', '=', $this->post->id)
      ->with(['post', 'user', 'comments'])
      ->whereNull('parent_id')
      ->orderByDesc('created_at')
      ->take($this->amount)
      ->get();
  }
}
