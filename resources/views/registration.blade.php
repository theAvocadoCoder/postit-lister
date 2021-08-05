@extends('layout')

@section('content')
<div>
    <h3 class="text-xl my-2 text-center font-bold">Register</h3>
    @if (Session::get('register_status'))
    <div>
        {{Session::get('register_status')}}
        <button type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">x</span>
        </button>
    </div>
    @endif
    <form action="registerUser" method="post" return="false" class="flex flex-col space-y-2 p-5 justify-center border-solid border-2 m-4">
        <div>
            <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Name" required>
        </div>
        @error('name')
        <div>{{ $message }}</div>
        @enderror
        @csrf
        <div>
            <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="Enter Email" required>
        </div>
        @error('email')
        <div>{{ $message }}</div>
        @enderror
        <div>
            <label for="password">Password</label>
                <input type="password" name="password" value="{{ old('password') }}" placeholder="Enter Password" required>
        </div>
        @error('password')
        <div>{{ $message }}</div>
        @enderror
        <div>
            <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Confirm Password" required>
        </div>
        @error('confirm_password')
        <div>{{ $message }}</div>
        @enderror
        <button type="submit" class="bg-gray-400 p-2 rounded-full mt-2 m-auto hover:text-white">Submit</button>
    </form>
</div>
@endsection