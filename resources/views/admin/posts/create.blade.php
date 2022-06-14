@extends('layouts.app')

@section('content')
    <div class="container">

        <form action=" {{ route('admin.posts.store') }} " method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">titolo</label>
                <input type="text" class="form-control" id="title" placeholder="titolo" name="title">

                <label for="category">category</label>
                <select name="category_id" id="category">
                    <option value="">nessuna</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->label }}</option>
                    @endforeach
                </select>

                <h3>Tags:</h3>
                @foreach ($tags as $tag)
                    <div class="form-check">
                        <input 
                        class="form-check-input" 
                        type="checkbox" 
                        value="{{$tag->id}}" 
                        id="tag-{{$tag->id}}" 
                        name="tags[]"
                        @if(in_array($tag->id, old('tags', []) ) ) checked @endif
                        >
                        <label class="form-check-label" for="tag-{{$tag->id}}">
                            {{$tag->label}}
                        </label>
                    </div>
                @endforeach

                <label for="content">content</label>
                <textarea id="content" name="content" cols="30" rows="10"></textarea>

                {{-- <label for="title">image</label>
                <input type="url" class="form-control" id="image" placeholder="url" name="image"> --}}
                
                <label for="title">image</label>
                <input type="file" class="form-control-file" id="image" placeholder="url" name="image">

                <button type="submit" class="btn btn-success">crea</button>
            </div>
        </form>
    </div>
@endsection
