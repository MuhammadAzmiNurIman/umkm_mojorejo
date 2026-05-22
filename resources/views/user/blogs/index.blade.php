@extends('layouts.user')

@section('content')
    <div class="container">
        <h1>Berita Pasar Rakyat Mojorejo</h1>
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $blog->image_url }}" class="card-img-top" alt="{{ $blog->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ Str::limit($blog->excerpt, 100) }}</p>
                            <a href="{{ $blog->url }}" target="_blank" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $blogs->links() }}
    </div>
@endsection
