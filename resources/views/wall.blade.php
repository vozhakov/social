@extends('layouts.user_layout')

@section('title')
    <title>Стена</title>
@endsection

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Стена</h3>
                        </div>

                        <div class="panel-body">
                            <form action="{{ route('wall.store') }}" method="post" >

                                @csrf

                                <div class="form-group">
                                    <textarea name="mes" class="form-control" id="wall-mes" placeholder="Поле Текст. Написать на стене"></textarea>
                                    <input type="hidden" name="id" value="{{  Auth::id() }}">
                                </div>
                                <button type="submit" class="btn btn-default">Отправить</button>
                                <div class="pull-right">
                                  <!--  <div class="btn-toolbar">
                                        <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i>Text</button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-file-image-o"></i>Image</button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-file-video-o"></i>Video</button>
                                    </div> -->
                                </div>
                            </form>
                        </div>
                    </div> <!-- class="panel panel-default"  -->
<!-- вывод сообщений на стене -->
                    @foreach($posts as $post)
                        <div class="panel panel-default post">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="" class="post-avatar thumbnail"><img
                                                @if( $post->photo)
                                                src="{{ asset('storage/' . $post->photo) }}"
                                                @else src="{{ asset('assets/img/no-photo.png') }}"
                                                @endif
                                         alt="img">
                                         </a>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="bubble">
                                            <div class="pointer">
                                                <p> {{ $post->name }}  {{ $post->surname }}. {{ $post->occupation }}<hr>{{ $post->message }}</p>
                                            </div>
                                            <div class="pointer-border"></div>
                                        </div>
                                        <p class="post-actions"><a href="">Комментарии</a> </p>
                                        <div class="comment-form">
                                            <form action="{{ route('comment.store') }}" method="post" class="form-inline">

                                                @csrf

                                                <div class="form-group">
                                                    <input type="text" name="comment" class="form-control" placeholder="добавте комментарий и нажмите на стрелку">
                                                    <input type="hidden" name="id" value="{{  Auth::id() }}">
                                                      <input type="hidden" name="id_message" value="{{  $post->walls_message_id }}">

                                                </div>
                                                <button type="submit" class="btn btn-default">&rarr;</button>
                                            </form>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="comments">
<?php $i=false ?>
        @foreach($comments as $comment)
        @if($post->walls_message_id == $comment->id_message)
            <?php $i =true; ?>
                <div class="comment">
                    <a href="" class="comment-avatar pull-left"><img

                            @if( $comment->photo)
                            src="{{ asset('storage/' . $comment->photo) }}"
                            @else src="{{ asset('assets/img/no-photo.png') }}"
                            @endif
                            alt="img"></a>
                    <div class="comment-text">
                        <p>{{ $comment->name }}  {{ $comment->surname }}. {{ $comment->occupation }}<br>{{ $comment->comment }}</p>
                    </div>
                </div>
                <div class="clearfix"></div>
        @endif

        @endforeach
    @if(!$i)
          <p>Нет комментариев</p>
    @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  <!-- конец блока вывода -->
                    @endforeach
                    {{ $posts->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}

                </div> <!-- .col-md-8 -->
                <!-- sidebar -->
              {{--  @include('sidebar') --}}
            </div> <!-- .row -->

        </div> <!-- .container -->
    </section>

@endsection
