@extends('layouts.contact')

@section('content')
    <div id="container">
        <div class="header">
            <h3>Add New E-mail address</h3>
            <a class="create" href="/contact/{{$id}}}" title="Go back"> <i class="fas fa-backward "></i> </a>
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
        <form class="form-group" action="/contact/email/{{$id}}" method="POST" >
            @csrf

            <span class="user"><i class="fas fa-envelope"></i></span>
            <input type="text" name="email" placeholder="E-mail" value="{{ old('email') }}">


            <button type="submit" class="create-submit">Create</button>

        </form>
    </div>

@endsection