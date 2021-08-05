@extends('layout')

@section('content')
<div>
    <h3 class="text-xl my-2 text-center font-bold">Login</h3>
    @if(Session::get('error'))
    <div role="alert">
        {{Session::get('error')}}
        <button type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">x</span>
        </button>
    </div>
    @endif
    <form action="loginUser" method="post" class="flex flex-col space-y-2 p-5 justify-center border-solid border-2 m-4">
        @csrf 
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email" required>
        </div>
        @error('email')
        <div>{{ $message }}</div>
        @enderror 
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter Password" required>
        </div>
        @error('password')
        <div>{{ $message }}</div>
        @enderror
        <button type="submit">Submit</button>
    </form>
</div>
@endsection