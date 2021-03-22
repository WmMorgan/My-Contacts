@extends('layouts.contact')

@section('content')

    <div id="container">
        <div class="header">
            <h2>My Contacts </h2>
            <a class="create" href="contact/create" title="Create a contact"> <i class="fas fa-plus-circle"></i>
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="success">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @foreach ($contact as $contacts)

            <div class="item">
                <div class="name">{{ substr($contacts->name, 0, 1) }}</div><a href="/contact/{{ $contacts->id }}">{{ $contacts->name }}</a></div>

        @endforeach

        @if ($contact[0] == false)
            <div class="form-group">you don't have contacts yet!</div>
        @else
            <form class="search-form" action="{{ route('contact.index') }}" method="GET" role="search">

                <button class="search-search" type="submit" title="Search contacts">
                    <span class="fas fa-search"></span>
                </button>

                <input class="search-input" type="text" name="search" placeholder="Search contact" id="search">
                <a href="{{ route('contact.index') }}">
                    <button class="search-reset" type="button" title="Refresh page">
                        <span class="fas fa-sync-alt"></span>
                    </button>

                </a>
            </form>
        @endif
        {!! $contact->links('paginate.contact_paginate') !!}
    </div>

    <script>
        //Specify the class that you want to select
        var x = document.getElementsByClassName("name");
        var i;
        var c;

        //specify the colors you want to use
        var colors = ["#be0024", "#2a9f44", "#01a8df", "#3a5999", "#400094", "#a4c737", "#ff4400", "#17176f"];
        var d = colors.length;

        for (i = 0; i < x.length; i++) {
            while (i < d) {
                c = i;
                var random_color = colors[c];
                x[i].style.backgroundColor = random_color;
                i++;
            }
            while (i >= d) {
                var random_color = colors[Math.floor(Math.random() * colors.length)];
                x[i].style.backgroundColor = random_color;
                i++;
            }
        }
    </script>


@endsection