@extends('layouts.user_layout')

@section('title')
    <title>Личный кабинет</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <h2>Личный кабинет</h2>
            </div>

            <div class="col-md-2">
                <a href="{{ route('cabinet.edit') }}" >
                    <div class="panel-heading" id="edit-profil">
                        Редактировать профиль
                    </div>
                </a>
            </div>
        </div>
    </div>

    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default friends">
                        <div class="panel-heading">
                            <h3 class="panel-title">Мои заявки на дружбу</h3>
                        </div>
                        <div class="panel-body">


                            @if($myfriendship)
                                <ul>
                                    @foreach($myfriendship as $friend)
                                        <li data-id="{{ $friend->id }}">
                                            <a href="" class="thumbnail">
                                                <img
                                                    @if( $friend->photo)
                                                    src="{{ asset('storage/' . $friend->photo) }}"
                                                    @else src="{{ asset('assets/img/no-photo.png') }}"
                                                    @endif
                                                    alt="img"><span id="cabinet-img">{{ $friend->name }}  {{ $friend->surname }}.<br> {{ $friend->occupation }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else  <h1>Заявок нет</h1>
                            @endif
                        </div>
                    </div>
                </div> <!-- .col-md-12 -->
            </div> <!-- .row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default friends">
                        <div class="panel-heading">
                            <h3 class="panel-title">Заявки на дружбу со мной от пользователей</h3>
                        </div>
                        <div class="panel-body">

                        @if($friendship)
                            <ul>
                                @foreach($friendship as $friend)

                                    <li data-id="{{ $friend->id }}">
                                        <a href="{{ 'cabinet/friend/'.$friend->id }}" class="thumbnail">
                                            <img
                                                @if( $friend->photo)
                                                src="{{ asset('storage/' . $friend->photo) }}"
                                                @else src="{{ asset('assets/img/no-photo.png') }}"
                                                @endif
                                                alt="img"><span id="cabinet-img">{{ $friend->name }}  {{ $friend->surname }}.<br> {{ $friend->occupation }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @else  <h1>Заявок нет</h1>
                            @endif
                        </div>
                    </div>
                </div> <!-- .col-md-12 -->
            </div> <!-- .row -->

            <div class="row">

                <!-- sidebar -->
                <div class="col-md-12">
                    <div class="panel panel-default friends">
                        <div class="panel-heading">
                            <h3 class="panel-title">Мои друзья. Выберите друга, чтобы посмотреть переписку, написать или удалить из друзей</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                               @foreach($friends as $friend)
                                        <li data-id="{{ $friend->id }}">
                                            <a href="{{ 'cabinet/friendw/'.$friend->id }}" class="thumbnail">
                                                <img
                                                    @if( $friend->photo)
                                                    src="{{ asset('storage/' . $friend->photo) }}"
                                                    @else src="{{ asset('assets/img/no-photo.png') }}"
                                                    @endif
                                                    alt="img"><span id="cabinet-img">{{ $friend->name }}  {{ $friend->surname }}.<br> {{ $friend->occupation }}</span>
                                            </a>
                                        </li>

                                    @endforeach
                                </ul>
                                <div class="clearfix"></div>
                                {{ $friends->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
                <!--конец sidebar -->

            </div> <!-- .row -->
        </div>
    </section>

@endsection
