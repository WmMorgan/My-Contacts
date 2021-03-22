@extends('layouts.contact')

@section('content')
    <div id="container">
        <div class="header">
            <h3>Add New Phone Number</h3>
            <a class="create" href="/contact/{{$id}}" title="Go back"> <i class="fas fa-backward "></i> </a>
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
        <form class="form-group" action="/contact/phone/{{$id}}" method="POST" >
            @csrf

            <span class="user"><i class="fas fa-phone"></i></span>
            <input type="text" name="number" placeholder="Phone" value="{{ old('phone') }}">


            <button type="submit" class="create-submit">Create</button>

        </form>
    </div>

@endsection