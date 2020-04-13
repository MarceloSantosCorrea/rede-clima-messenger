<div id="{{ $comment->uid }}" class="media mb-2 border-bottom pb-2">
    <img src="{{ url("storage/{$comment->lead->thumbnail}") }}"
         height="45" class="d-flex mr-2 rounded-circle"
         onerror="this.onerror=null; this.src='{{ url("storage/{$comment->lead->thumbnail}") }}'"
    >
    <div class="media-body">
        <p class="mt-0 mb-0"><strong>{{ $comment->lead->name }}</strong>
            <span style="font-size: 10px">{{ $comment->created_at->format('d/m/Y H:i:s') }}</span></p>
        {{ $comment->comment }}
    </div>
</div>