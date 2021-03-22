@extends('layouts.contact')

@section('content')
    <div id="container">

        <div class="header">
            <h3>Edit E-mail Address</h3>
            <a class="create" href="/contact/{{$email[0]->contact_id}}" title="Go back"> <i class="fas fa-backward "></i> </a>
        </div>

        @if ($errors->any())
            <div class="error">
                <strong>Error!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form-group" action="/contact/email/{{ $email[0]->id }}" method="POST">
            @csrf
            @method('PUT')

            <span class="user"><i class="fas fa-phone"></i></span>
            <input type="text" name="email" placeholder="E-mail" value="{{ $email[0]->email }}">


            <button type="submit" class="create-submit">Save</button>

        </form>
    </div>
@endsection