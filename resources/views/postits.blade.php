@extends('layout')

@section('content')
    @if (Session::get('user'))
        <a href="/" class="p-2 bg-gray-400 rounded m-auto relative right-0 hover:text-white"><< New Post-it</a>

        <div>
            <h2 class="text-3xl my-2 text-center font-bold">Post-its</h2>
            <hr>
            <div>
                @foreach ($postits as $postit)
                    <div class="flex flex-col space-y-1 mt-4 m-2">
                        <div class="m-auto bg-gray-300 rounded h-40 w-5/12 overflow-hidden">
                            <div class="bg-gray-400 px-2 py-1">
                                <h4 class="text-2xl font-bold my-2">{{ $postit->title }}</h4>
                            </div>
                            <div class="p-2 pt-1">
                                {{ $postit->body }}
                            </div>
                        </div>
                        <div class="flex flex-row space-x-2 justify-items-center w-5/12 m-auto place-content-center">
                            <form class="justify-self-center" action="editPostit" method="post">
                                @csrf
                                <input type="hidden" name="postitId" value={{$postit->id}}>
                                <button type="submit" class="bg-gray-400 rounded px-2 pt-1 h-8 hover:bg-gray-300">Edit</button>
                            </form>
                            <form class="justify-self-center" action="deletePostit" method="post">
                                @csrf
                                <input type="hidden" name="postitId" value={{$postit->id}}>
                                <button type="submit" class="bg-gray-400 rounded px-2 py-1 h-8 hover:bg-gray-300">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection