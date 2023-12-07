@extends('app.main')

@section('content')
    <main class="home">
        <h1 class="page-heading">Сокращение ссылок онлайн</h1>
        
        <form class="form" action="{{ route('handle') }}" method="post">
            @csrf
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
            
            <label for="link_input">Ссылка</label>
            <input type="url" name="url" id="link_input" class="form__input" placeholder="http://example.com" required>
            <button class="form__submit">Сократить</button>
            <a href="{{ route('history') }}">Мои ссылки</a>
        </form>
    </main>
@endsection