@extends('layouts.user_layout')
@section('content')

<section>
<div class="container">
    <div class="row">

     <div class="mb-1">
    <h3 class="text-center">Переписка с друзьями</h3>
         <div class="messages ">
             ************
         </div>
    </div>

    <a href="{{ route('cabinet.edit') }}" >
    <div class="col-md-1 panel-heading" id="edit-profil">
    Редактировать профиль
    </div>
    </a>

&emsp;&emsp;    <div class="col-md-11">
            <div class="panel panel-default friends">
                <div class="panel-heading">
               <h3 class="panel-title">Выберите друга для переписки</h3>
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
                 </div>

            </div>  <!--  <div class="panel panel-default friends"> -->
         </div> <!--   <div class="col-md-11"> -->
   </div> <!--   <div class="row"> -->


</div> <!-- <div class="container"> -->
</section>

@endsection

