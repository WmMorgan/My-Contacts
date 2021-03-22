@extends('layouts.contact')

@section('content')
    <div id="container">
    <div class="header">
                <h2>Add New Contact</h2>
                <a class="create" href="/contact" title="Go back"> <i class="fas fa-backward "></i> </a>
    </div>


    @if ($errors->any())
        <div class="error">
            <div>Error!</div><br/>

                @foreach ($errors->all() as $error)
                    <div style="font-size: x-small">{{ $error }}</div>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form-group" action="/contact" method="POST" >
        @csrf


        <span class="user"><i class="fas fa-user"></i></span>
                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
        <br><br/>
        <span class="user"><i class="fas fa-phone"></i></span>
                    <input type="text" name="number" placeholder="Phone" value="{{ old('number') }}">
        <br><br/>
        <span class="user"><i class="fas fa-envelope"></i></span>
                    <input type="text" name="email" placeholder="E-Mail" value="{{ old('email') }}">


                <button type="submit" class="create-submit">Create</button>

    </form>
    </div>

@endsection