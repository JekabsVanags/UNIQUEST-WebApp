
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
</div>
</x-app-layout>
</body>
@if(Auth::check())
@foreach ($levels as $level)
<p>{{$level -> title}}</p>
<p>{{$level -> description}}</p>
<img src ="http://localhost/uniquest/public/images/{{$level->coverImage}}" />
<p>{{$level -> rating}}</p>
<p>{{$level -> diff}}</p>
<button onclick="goToLevel({{$level->id}})">ShowLevel</button>
@endforeach
@if(auth()->user()->role == 'admin')
<button onclick="goToReports()">Look at reports</button>
@endif
<br><button onclick="goToMakeLevel()">Make Level</button>
@endif

<br><button onclick="goToIndex()">Go to All Levels</button>