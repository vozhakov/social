<div class="row">
    <!-- sidebar -->
    <div class="col-md-4">
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

            </div>
        </div>
    </div>
    <!--конец sidebar -->

</div> <!-- .row -->
