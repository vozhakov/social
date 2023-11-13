<div class="col-md-4">
    <div class="panel panel-default friends">
        <div class="panel-heading">
            <h3 class="panel-title">Мои друзья</h3>
        </div>
        <div class="panel-body">
            <ul>
                  @foreach($notes as $note)
                        <li>
                            <a href="profile.html" class="thumbnail">
                                <img
                                    @if( $note->photo)
                                    src="{{ asset('storage/' . $note->photo) }}"
                                    @else src="{{ asset('assets/img/no-photo.png') }}"
                                    @endif
                                    alt="img"><span id="cabinet-img">{{ $note->name }}  {{ $note->surname }}.<br> {{ $note->occupation }}</span>
                            </a>
                        </li>

                    @endforeach
                </ul>
            <div class="clearfix"></div>
            <a class="btn btn-primary" href="#">Показать всех друзей</a>
        </div>
    </div>

</div>
