<div class="flex h-screen w-screen items-center justify-center">
  <div class="w-1/2">
    @foreach ($messages as $message)
      <div class="chat chat-start">
        <p class="chat-bubble">{{ $message->body }}</p>
      </div>
    @endforeach
    <form wire:submit="post" class="my-2 flex items-center">
      <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" wire:model="body" />
      <button class="btn btn-primary ml-2">送信</button>
    </form>
  </div>
</div>
