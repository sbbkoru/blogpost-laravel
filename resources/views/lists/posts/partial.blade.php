<h3>  <a href="{{route('posts.show' ,['post' => $post->id])}}">{{ $key }} . {{ $post->title }} </a> </h3>
<p>Added {{$post->created_at->diffForHumans()}} by {{$post->user->name ?? 'Unknown'}}</p>
@if ($post->comments_count)
    <p>{{$post->comments_count}} comments</p>
@else
<p>No comments yet!</p>
@endif

<div class="mb-3">
    @auth
        @can('update', $post)
            <a href="{{route('posts.edit' ,['post' => $post->id])}}" class="btn btn-primary">Edit</a>
        @endcan
    @endauth

    @auth
        @can('delete', $post)
        <form action="{{route('posts.destroy', ['post' => $post->id])}}" class="d-inline" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete!" class="btn btn-primary">
        </form>
        @endcan
    @endauth


</div>
