@extends('layouts.user_layout')

@section('title')
    <title>Сообщество</title>
@endsection

@section('content')

    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default friends">
                        <div class="panel-heading">
                            <h3 class="panel-title">Сообщество. Нажмите на фото, чтобы выберать друга. (Зеленый фон - ваши друзья)</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                             <!-- Проверка нахождения пользователя в друзьях -->
                                @foreach($members as $member)
                                    @php
                                        foreach($friends as $friend){
                                            if($friend->friend_one == $member->id){
                                             $isFriend = true;
                                            }
                                        }
                                    @endphp

                                    <li
                                        @if($isFriend)
                                        class="bg-green"
                                        @php $isFriend = false;  @endphp
                                        @endif
                                    >

                                        <a href="{{ '/community/addfriend/' . $member->id }}" class="thumbnail"><img
                                    @if( $member->photo)
                                    src="{{ asset('storage/' . $member->photo) }}"
                                    @else src="{{ asset('assets/img/no-photo.png') }}"
                                    @endif
                                   style="width: 100px" alt="img">
                                            <span id="cabinet-img">{{ $member->name }}  {{ $member->surname }}.<br> {{ $member->occupation }}</span>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                            <div class="clearfix"></div>
                            {{ $members->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
