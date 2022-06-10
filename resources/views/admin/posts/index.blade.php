@extends('layouts.app')

@section('content')
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

    <a href=" {{ route('admin.posts.create') }}" class="btn btn-success">new</a>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">title</th>
                    <th scope="col">category</th>
                    <th scope="col">content</th>
                    <th scope="col">image</th>
                    <th scope="col">slug</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <th>{{ $post->title }}</th>
                        <td>

                            @if ($post->Category)
                                <span
                                    class="badge badge-pill badge-{{$post->Category->color}}">{{ $post->Category->label }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <p>
                                {{ $post->content }}
                            </p>
                        </td>
                        <td>
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" width="50">
                        </td>
                        <td>{{ $post->slug }}</td>
                        <td>
                            <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary">views</a>

                            @include('includes.deletePost')

                            <a href="{{ route('admin.posts.edit', $post->id) }} " class="btn btn-primary">edit</a>
                        </td>
                    </tr>

                @empty
                    <h3>Non ci sono posts</h3>
                @endforelse

            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/delete-form.js') }}"></script>
@endsection
