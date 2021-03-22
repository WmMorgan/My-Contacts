@extends('layouts.contact')


@section('content')
    <div id="container">
    <div class="header">
        <span style="font-size: small; margin-left: -230px; margin-top: 25px; position: absolute;">{{$contact->time}}</span><h3>{{ $contact->name }}</h3>
        <a class="create" style="margin-right: 90px; font-size: 20px;" href="/contact" title="Go back"> <i class="fas fa-backward "></i> </a>
        <a class="create" style="font-size: 20px" href="/contact/{{$contact->id}}/edit" title="Go to Edit"> <i class="fas fa-edit"></i> </a>

        <form action="/contact/{{$contact->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="create" style="margin-right: 20px; font-size: 20px; background-color: transparent; border: none; outline: none;" title="Delete"> <i class="fas fa-trash-alt"></i> </button></form>
    </div>
        @if ($message = Session::get('success'))
            <div class="success">
                <p>{{ session('success') }}</p>
            </div>
        @endif

    <div class="form-group">
        <div class="head-items"><i class="fas fa-phone"></i> Phone <a style="color: white; float: right" href="phone/create/{{$contact->id}}"> <i class="fas fa-plus-circle"></i>
            </a></div>
        @foreach($phone as $item)
            <div class="items">{{ $item->number }}
                <a style="float:right;" href="/contact/phone/edit/{{$item->id}}"><i class="fas fa-edit"></i> </a>
                <form action="/contact/phone/{{$item->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button style="margin-left: 400px; margin-top: -17px; background-color: transparent; border: none; outline: none;"> <i style="width: 10px; color: red" class="fas fa-trash-alt"></i> </button></form>
            </div>
@endforeach


        <div class="head-items"><i class="fas fa-envelope"></i> E-mail<a style="color: white; float: right" href="email/create/{{$contact->id}}"> <i class="fas fa-plus-circle"></i>
            </a></div>
        @foreach($email as $emails)
            <div class="items">{{ $emails->email }}
                <a style="float:right;" href="/contact/email/edit/{{$emails->id}}"><i class="fas fa-edit"></i> </a>
                <form action="/contact/email/{{$emails->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button style="margin-left: 400px; margin-top: -17px; background-color: transparent; border: none; outline: none;"> <i style="width: 10px; color: red" class="fas fa-trash-alt"></i> </button></form>
            </div>
        @endforeach
    </div>
    </div>


@endsection