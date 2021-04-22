@extends('layouts.app')

@section('content')
    <div class="container">
        @include('mis.mistake')
        <h1>Форма для изменения сообщения {{$message->name}}</h1>
        {!!
            Form::model($message, ['method' => 'post', 'id'=> 'form' , 'enctype' => 'multipart/form-data' , 'route' => ['message.update',['id' => $message->id]], 'class' => 'form-line'])
        !!}
        {!! Form::token() !!}
        <span class="text-danger error-text name_error"></span>
        {!! Form::label('name', 'Введите ваше сообщение') !!}
        {!! Form::textarea('name', $message->name, ['class' => 'form-control', 'id' => 'textarea']) !!}
        {!! Form::file('image', ['class' => 'form-control']) !!}
        {!! Form::submit('Редактировать', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
    <script src="{{asset('js/main.js')}}"></script>

@endsection
