@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Добро пожаловать в госетвую книгу
                @guest
                    Вы не зарегистрированы
                @else
                    {{Auth::user()->name}}
                @endif
            </h2>

            <h3>Сообщения</h3>

        </div>
    </div>
</div>
<script src="{{asset('js/delete.js')}}"></script>
@endsection
