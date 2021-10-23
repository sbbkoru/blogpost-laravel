<div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{old('title', optional($post ?? null)->title)}}">
    </div>
    @error('title')
        <p>{{$message}}</p>
    @enderror
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" >{{old('content', optional($post ?? null)->content)}}</textarea >
    </div>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif