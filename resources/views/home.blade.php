@extends('layouts.app')
<?php
    /*
  foreach ($messages as $message) {
      echo "<div style='margin-left:" . (key($message) * 25) . "px;'>" . $message[key($message)]->name. "</div>";
  }
  die;
*/
?>
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
            @foreach($messages as $mes)
                <div class="card" style="margin-left: {{$mes->key*20}}px">
                    @if ($mes->answered_id > 0)
                        Ответ пользователю {{$model->getMessage($mes->answered_id)->user->name}}
                        на сообщение {{$model->getMessage($mes->answered_id)->name}}
                    @endif
                    <br>
                    {{$mes->name}}
                    <br>
                    @if ($mes->image == null)
                        Изображения нет
                    @else
                        <img src="{{asset('storage/'.$mes->image)}}" width="200px" height="200px">
                    @endif
                    <br>
                        Автор - @if (Auth::user() == $model->getMessage($mes->id)->user && $mes->isUpdate())
                            ВЫ
                            <a href="{{route('message.edit', $mes->id)}}">
                                <button class="btn btn-check">Редактировать</button>
                            </a>
                            {!! Form::open(['method' => 'post', 'class' => 'delete','route' => ['message.delete', $mes->id]]) !!}
                            <button type="submit" class="btn btn-danger">Удалить</button>
                            {!! Form::close() !!}
                        @else
                            {{$model->getMessage($mes->id)->user->name}}
                        @endif
                    <br>
                    @guest
                    @else
                    <a href="{{route('message.answer.form', $mes->id)}}">
                        <button class="btn btn-check">Ответить</button>
                    </a>
                    @endif
                </div>
            @endforeach

            <?php echo $messages->links('vendor/pagination/bootstrap-4');?>
        </div>
    </div>
</div>
<script src="{{asset('js/delete.js')}}"></script>
@endsection
