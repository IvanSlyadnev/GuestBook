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
            @foreach($messages as $message)
                <div class="card" style="margin-left: {{key($message) * 25}}">
                    {{$message[key($message)]->name}}
                </div>
            @endforeach
        </div>
    </div>
</div>
<script src="{{asset('js/delete.js')}}"></script>
@endsection
