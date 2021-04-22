@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Форма для ответа на сообщение {{$message->name}} пользователя {{$message->user->name}}</h1>
        {!!
            Form::model($message, ['method' => 'post', 'id'=> 'form' , 'enctype' => 'multipart/form-data' , 'route' => ['message.answer', ['id' => $message->id, 'user' => $user, 'message_text' => $message_text]], 'class' => 'form-line'])
        !!}
        {!! Form::token() !!}
        <span class="text-danger error-text name_error"></span>
        {!! Form::label('name', 'Введите ваше сообщение') !!}
        {!! Form::textarea('name', '', ['class' => 'form-control', 'id' => 'textarea']) !!}
        {!! Form::file('image', ['class' => 'form-control']) !!}
        {!! Form::submit('Создать', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
    <script src="{{asset('js/main.js')}}"></script>

@endsection
