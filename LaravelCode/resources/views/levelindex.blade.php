<!doctype html>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="{{ asset('js/levels.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('css/levelindex.css')}}">
</head>

<body>

<div id = "header">
<div id = "konts"><button class="hovers" id="account" type="button" onclick="toAccount()">Account</button></div>
<span class="dot"></span> 

<form id = "search"action="{{action([App\Http\Controllers\LevelController::class, 'searchLevels']) }}" method="post" enctype="multipart/form-data"> 
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <label class="level" for="searchname">Level Name  |</label>
  <input type="text" id="searchname" name="searchname">
  <label class="level" for="searchcountry">Country  |</label>
  <input type="text" id="searchcountry" name="searchcountry">
  <label class="level" for="searchdiff">Difficulty 1-5  |</label>
  <input type="number" min="1" max="5" id="searchdiff" name="searchdiff">
  <input id ="level_sub" class="hovers" class="efekts"  type="submit" value="Search">
</form>


</div>
<br>
<div class = "level_sagatave">
@if($curlevel != NULL)
<div id="title"><h2>{{$curlevel -> title}}</h2></div>
<div id="desc"><h2>{{$curlevel -> description}}</h2></div>
<img src ="http://localhost/uniquest/public/images/{{$curlevel->coverImage}}" /><br><br>
<button class="show_lvl" onclick="goToLevel({{$curlevel->id}})">ShowLevel</button>
@else
<h1>No level</h1>
@endif
</div>


@foreach ($top3levels as $level)
<p>{{$level -> title}}</p>
<p>{{$level -> description}}</p>
<img src ="http://localhost/uniquest/public/images/{{$level->coverImage}}" />
<p>{{$level -> diff}}</p>
<button onclick="goToLevel({{$level->id}})">ShowLevel</button>

@endforeach
@if(Auth::check())
<br><button onclick="goToMakeLevel()">NewLevel</button>
@endif
</body>

</html>
