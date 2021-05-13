@extends('layouts/app')

@section('pageTitle', 'Welcome' )

@section('content')
<div class="container rounded-lg shadow mx-auto bg-gray-100 p-4">
    <h1 class="text-center text-3xl pb-6 md:text-5xl font-semibold text-gray-900">Get feed url from iTunes podcast</h1>

    @if ($itunesUrl!==null)
    <div class="bg-gray-100 border rounded-lg border-gray-500 text-gray-900 p-4 mb-4" role="alert">
		<p class="font-semibold">🎉 Success ! 🍾</p>
		<p>Itunes url: <a href="{{ $itunesUrl }}" class="underline" target="_blank">{{ $itunesUrl }}</a></p>
        <p>Real feed url : <a href="{{ $feedUrl }}" class="underline" target="_blank">{{ $feedUrl }}</a></p>
	</div>
    @endif
    
    <form action="{{ route('getFeed') }}" method="POST">
    @csrf
        <div class="flex flex-wrap -mx-3 mb-6 mx-auto">
            <div class="w-full px-3">
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="url" name="url" id="url" value="{{ old('url')}}" placeHolder="https://podcasts.apple.com/us/podcast/the-laravel-snippet/id1451072164">
            </div>
            <button class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded mx-auto" type="submit">
                Get hidden feed url
            </button>
        </div>
    </form>

    
</div>
@endsection