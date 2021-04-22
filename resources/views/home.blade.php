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

            @foreach($messages as $message)
                <?php
                    $answers = $message->getAnswered();
                ?>
                @if (!$message->answer)
                <div class="card">
                    {{$message->name}}
                    <br>
                    @if ($message->image == null)
                        Изображения нет
                    @else
                        <img src="{{asset('storage/'.$message->image)}}" width="200px" height="200px">
                    @endif
                    <br>
                    Автор - @if (Auth::user() == $message->user && count($answers) == 0)
                                ВЫ
                                <a href="{{route('message.edit', $message->id)}}">
                                    <button class="btn btn-check">Редактировать</button>
                                </a>
                                {!! Form::open(['method' => 'post', 'class' => 'delete','route' => ['message.delete', $message->id]]) !!}
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                {!! Form::close() !!}
                            @else
                                {{$message->user->name}}
                            @endif
                    <br>
                    <a href="{{route('message.answer.form',
                                ['id' => $message->id, 'user' => $message->user->name, 'message_text' => $message->name])}}">
                        <button class="btn btn-check">Ответить</button>
                    </a>
                    @foreach($answers as $answer)
                        <div class="card col-md-8">
                            Ответ пользователю {{$answer->user_answered}} на сообщение {{$answer->message}}
                            <br>
                            {{$answer->name}}
                            <br>
                            @if ($answer->image == null)
                                Изображения нет
                            @else
                                <img src="{{asset('storage/'.$answer->image)}}" width="200px" height="200px">
                            @endif
                            <br>
                            Автор - @if (Auth::user() == $answer->user)
                                ВЫ
                                <a href="{{route('message.edit', $answer->id)}}">
                                    <button class="btn btn-check">Редактировать</button>
                                </a>
                                {!! Form::open(['method' => 'post', 'class' => 'delete','route' => ['message.delete', $message->id]]) !!}
                                <button type="submit" class="btn btn-danger">Удалить</button>
                                {!! Form::close() !!}
                            @else
                                {{$answer->user->name}}
                            @endif
                            <a href="{{route('message.answer.form',
                                ['id' => $message->id, 'user' => $answer->user->name, 'message_text' => $answer->name])}}">
                                <button class="btn btn-check">Ответить</button>
                            </a>
                        </div>
                    @endforeach
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<script src="{{asset('js/delete.js')}}"></script>
@endsection
