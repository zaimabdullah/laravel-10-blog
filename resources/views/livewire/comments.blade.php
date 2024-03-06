<div class="mt-6">
  <livewire:comment-create :post="$post" />

  @foreach ($comments as $comment)
    {{-- <pre>{{$comment}}</pre> --}}
    <livewire:comment-item :comment="$comment" wire:key="{{ $comment->id }}-{{ $comment->comments->count() }}" />
  @endforeach

  <button wire:click="loadMore" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Load
    More</button>
</div>
