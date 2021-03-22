@extends('layouts.contact')

@section('content')
    <div id="container">

            <div class="header">
                <h2>Edit Contact Name</h2>
                <a class="create" href="/contact" title="Go back"> <i class="fas fa-backward "></i> </a>
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

    <form class="form-group" action="/contact/{{ $contact->id }}" method="POST">
        @csrf
        @method('PUT')

        <span class="user"><i class="fas fa-user"></i></span>
        <input type="text" name="name" placeholder="Name" value="{{ $contact->name }}">


                <button type="submit" class="create-submit">Save</button>

    </form>
    </div>
@endsection