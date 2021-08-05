@extends('layout')

@section('content')
    <div>
        @if (Session::get('register_status'))
        <div>
            {{Session::get('register_status')}}
            <button type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
        </div>
        @endif
        @if (Session::get('user'))
        <a href="/viewPostits" class="p-2 bg-gray-400 rounded m-auto relative right-0 hover:text-white">View Post-its >></a>

        <form action="addPostit" method="post" class="flex flex-col space-y-2 p-5 justify-center">
            @csrf 
            <input type="hidden" name="postitId" value={{ (session()->get('edit_title')) ? $postit->id : null; }}>
            <div class="m-auto">
                <label for="header"></label>
                <input type="text" name="title" placeholder="Insert Title" required  value={{ (session()->get('edit_title')) ? session()->get('edit_title') : null; }}>
            </div>

            <div class="m-auto">
                <label for="body"></label>
                <textarea name="body" class="p-3" placeholder="Start typing your Postit..." cols="30" rows="10" required>@if (Session::get('edit_body'))
                        {{Session::get('edit_body')}}
                    @endif</textarea>
                <br>
                <button type="submit" class="bg-gray-400 p-2 rounded-full mt-2 m-auto hover:text-white">Add Post-it</button>
            </div>
        </form>
        @endif
    </div>
@endsection