@php
use App\Http\Controllers\LevelController;
use App\Http\Controllers\CommentController;
@endphp
<!DOCTYPE html>
<html>
    <head>
    <script src="{{ asset('js/levels.js')}}"></script>
    </head>
    <body>
    <h1>{{$level -> title}}</h1>
    <p>{{$level -> description}}</p>
    <img src ="http://localhost/uniquest/public/images/{{$level->coverImage}}" />
    <p>{{$level -> rating}}</p>
    <p>{{$level -> diff}}</p>
    
    <button onclick="goToIndex()">Return</button>
    <button onclick="reportLevel({{$level->id}})">Report Quest</button>
    @if (Auth::check())
    <button onclick="getLocationConstant()">Submit your location</button>
    @endif

    <form id="newcomment" action="{{action([App\Http\Controllers\CommentController::class, 'store']) }}" method="get">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">    
    <input type="hidden" id="levelid" name="levelid" value="{{$level->id}}"><br>
    <input type="largeext" id="comment" name="comment"><br>
    <input type="hidden" id="spoiler" name="spoiler" value=0><br>
    <button onclick="submit">Submit Comment</button>
    <h1>Comments</h1>
    @foreach($comments as $commen)
    <p>{{$commen->comment}}</p>
    <h4>{{$commen->name}}</h4>
    @if(Auth::check())
    @if(auth()->user()->id == $commen->user_id or auth()->user()->role == 'admin')
    <button onclick="deleteComment({{$commen->comid}})">Delete</button> 
    @endif
    @endif
    @endforeach
    </body>



    <script>
    function getLocationConstant() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(onGeoSuccess, onGeoError);
        } else {
            alert("Your browser or device doesn't support Geolocation");
        }
    }

    function calculateDistance(lat1,lon1,lat2,lon2){
    earth_radius = 6371;
    function degsToRads(deg){return(deg * Math.PI) / 180.0;};
    dLat = degsToRads(lat2-lat1);
    dLon = degsToRads(lon2-lon1);
    a = Math.sin(dLat/2)*Math.sin(dLat/2)+Math.cos(degsToRads(lat1)) * Math.cos(degsToRads(lat2)) * Math.sin(dLon/2) * Math.sin(dLon/2);
    c = 2 * Math.asin(Math.sqrt(a));
    d = earth_radius * c;
    return Math.round(d*1000);
    }

    // If we have a successful location update
    function onGeoSuccess(event) {
        distance = calculateDistance({{$location->Latitude}},{{$location->Longitude}},event.coords.latitude,event.coords.longitude);

        if(distance <= 10)
        {
            alert('You have found the location!');
            window.location.href = "http://localhost/uniquest/public/completed/"+{{$level->id}};
        }
        else
        {
            alert("You are "+distance+" meters away from the solution");
        }
    }
    // If something has gone wrong with the geolocation request
    function onGeoError(event) {
        alert("Error code " + event.code + ". " + event.message);
    }
    </script>
</html>
