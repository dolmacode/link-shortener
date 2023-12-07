@extends('app.main')

@section('content')
    <main class="home">
        <h1 class="page-heading">История ваших ссылок</h1>

        <div class="form">
            @if(session()->has('success'))
            <div class="alert-success">
                {!! session()->get('success') !!}
            </div>
            @endif

            @if(session()->has('error'))
            <div class="alert-danger">
                {{ session()->get('error') }}
            </div>
            @endif
            
            @forelse($links as $link)
            <div class="history__item">
                <a href="{{ env('APP_URL') . '/' . $link->slug }}">{{ env('APP_URL') . '/' . $link->slug }}</a>
                <span>|</span>
                <i title="Количество посещений">{{ $link->visits }} см.</i>
                <span>|</span>
                <a href="{{ route('delete', ['id' => $link->id]) }}">[Удалить]</a>
            </div>
            @empty
            <p>Вы еще не сокращали ссылок</p>
            <a href="/">Сократить ссылку</a>
            @endforelse
        </div>
    </main>
@endsection