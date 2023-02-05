
<!DOCTYPE html>
<html>
    <head>
    <script src="{{ asset('js/levels.js')}}"></script>
    </head>
    <body>
    <h1>{{$level -> title}}</h1>
    <p>You have finished this level</p>
    <p>{{$level -> description}}</p>
    <img src ="http://localhost/uniquest/public/images/{{$level->coverImage}}" />
    <p>{{$level -> rating}}</p>
    <p>{{$level -> diff}}</p>
    
    
    <button onclick="goToIndex()">Return</button>
    <button onclick="reportLevel({{$level->id}})">Report Quest</button>
    
    <br>
    <p>New Comment</p>
    <form id="newcomment" action="{{action([App\Http\Controllers\CommentController::class, 'store'])}}" method="get">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">    
    <input type="hidden" id="levelid" name="levelid" value="{{$level->id}}"><br>
    <input type="largeext" id="comment" name="comment"><br>
    <input type="radio" id="spoiler" name="spoiler">My comment has spoilers<br>
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
</html>
