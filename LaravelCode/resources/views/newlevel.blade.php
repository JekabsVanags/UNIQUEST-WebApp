@php
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LocationController;
@endphp

<!doctype html>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/newlevel.css')}}">
  <script src="{{ asset('js/newlevel.js')}}"></script>
  <head>
</head>

<body> 
<div id = "header">
<div id = "konts"><button class="hovers" id="account" type="button" onclick="toAccount()">Account</button></div>
<span class="dot"></span> 

</div>
<div id = "lokacija">
  <br>
  <p id="loc_virsr">ADD A LOCATION</p>
<!--Formu, KUR IEVADA VISU IZNEMOT IMAGE -->
<form id="locationform" action="{{action([App\Http\Controllers\LocationController::class, 'store']) }}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">    
<input type="hidden" id="latitude" name="latitude" value=""><br>
    <input type="hidden" id="longitude" name="longitude" value="">
    <input type="hidden" id="user" name="user" value=1>
    <p class="valid_css" id = "tekstins1"></p>
    <input type="text" id="name" name="name"><br>
    <label id="loc_name" for="name">Location name</label><br><br><br>"
    <p class="valid_css" id = "tekstins2"></p>"
    <select id ="country" name="country" style="width:150px"><br><br>
        @foreach($countries as $country)<br>
        @if($country->name == "Latvia")
          <option selected="selected" value="{{$country->name}}">{{$country->name}}</option>
        @else
          <option value="{{$country->name}}">{{$country->name}}</option>
        @endif
        @endforeach
</select><br>
    <label id="countr_name" for="country">Country name</label><br><br><br>
    <button type="button" class="hovers" class="efekts" id="submit_loc" onclick="validation(event)">Submit Location</button>
</form>
</div>
<br>
<div id= "limenis">

<br>
  <p id = level_virs> ADD A NEW LEVEL </p>
<form id = "levelform"action="{{action([App\Http\Controllers\LevelController::class, 'store']) }}" method="post" enctype="multipart/form-data"> 
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <p  class = "valid_css" id="text1"></p>
  <input type="text" id="title" name="title"><br>
  <label class="level" for="title">Title</label><br><br>
  <p  class = "valid_css" id="text2"></p>
  <input type="file" id="image" name="image"><br>
  <label class="level" for="image">Upload cover image</label><br><br>
  <p  class = "valid_css" id="text3"></p>
  <textarea type="text" id="description" name="description" rows="4" cols="30"></textarea><br>
  <label class="level" for="description">Description</label><br>
  <p  class = "valid_css" id="text4"></p>
  <input type="hidden" id="rating" name="rating" value=0><br>
  <p  class = "valid_css" id="text5"></p>
  <input type="number" min="1" max="5" id="diff" name="diff"><br>
  <p  class = "valid_css" id="text6"></p>
  <label class="level" for="diff">Difficulty 1-5</label><br><br>
  <select name="loc" id="loc"><br>
        @foreach($userLoc as $loc)
          <option value="{{$loc->id}}">{{$loc->Name}}</option>
        @endforeach
</select>
  <label class="level" for="isPublic">Private level?</label>
  <input type="radio" id="isPublic" name="isPublic"><br><br>
  <input id ="level_sub" class="hovers" class="efekts" onclick="validation2(event)"  type="submit" value="Submit Level">
</form>
</div>
<div id="return"><button class="hovers" class="efekts" id = "return_css" onclick="goToIndex()">< Return</button></div>

<script type="text/javascript">
    function getLocationConstant() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(onGeoSuccess, onGeoError);
        } else {
            alert("Your browser or device doesn't support Geolocation");
        }
    }
    // If we have a successful location update
    function onGeoSuccess(event) {
        document.getElementById("latitude").value = event.coords.latitude;
        document.getElementById("longitude").value = event.coords.longitude;
        document.getElementById("locationform").submit();
    }
    // If something has gone wrong with the geolocation request
    function onGeoError(event) {
        alert("Error code " + event.code + ". " + event.message);
    }

    function goToIndex()
    {
      window.location.href = "/uniquest/public";
    }

  //validacija te
  
  //Form validation
function validation2(event){
    event.preventDefault();

    let title = document.getElementById("title").value;
    let title_teksts;
    let image = document.getElementById("image").value;
    let image_teksts;
    let description = document.getElementById("description").value;
    let description_teksts;
    let rating = document.getElementById("rating").value;
    let rating_teksts;
    let diff = document.getElementById("diff").value;
    let diff_teksts;
    let loc = document.getElementById("loc").value;
    let loc_teksts;
    //Title
    if(title !== ""){
      title_teksts = "";
      document.getElementById("text1").innerHTML = title_teksts;
    }else{
      title_teksts = "Type a title!";
    }
    document.getElementById("text1").innerHTML = title_teksts;
    //Image
    if(image !== ""){
      image_teksts = "";
      document.getElementById("text2").innerHTML = image_teksts;
    }else{
      image_teksts = "Insert a picture!";
    }
    document.getElementById("text2").innerHTML = image_teksts;
    //Desc
    if(description !== ""){
      description_teksts = "";
      document.getElementById("text3").innerHTML = description_teksts;
    }else{
      description_teksts = "Describe the level!";
    }
    document.getElementById("text3").innerHTML = description_teksts;
    //Rating
    if(rating !== ""){
    rating_teksts = "";
      document.getElementById("text4").innerHTML = rating_teksts;
    }else{
      rating_teksts = "Rate the level!";
    }
    document.getElementById("text4").innerHTML = rating_teksts;

//Difficulty
if(diff !== ""){
diff_teksts = "";
      document.getElementById("text5").innerHTML = diff_teksts;
    }else{
      diff_teksts = "How difficult is the level from 1-5?";
    }
    document.getElementById("text5").innerHTML = diff_teksts;
//Location
if(loc !== "")
    {
      loc_teksts = "";
      document.getElementById("text6").innerHTML = loc_teksts;
    }
    else
    {
      loc_teksts = "How difficult is the level?";
    }
    document.getElementById("text6").innerHTML = loc_teksts;

    if((title != "") && (image != "") && (description != "") && (rating != "") && (diff != "") && (loc != "")){
    document.getElementById("levelform").submit();
  } 

}

function validation(event){
event.preventDefault();
  let name = document.getElementById("name").value;
  let name_teksts;
  let country = document.getElementById("country").value;
  let country_teksts;
//Location
if (name !== ""){
  name_teksts = "";
  document.getElementById("tekstins1").innerHTML = name_teksts;
}else{
  name_teksts = "Type a location!";
}
document.getElementById("tekstins1").innerHTML = name_teksts;
//Country
if(country !== ""){
country_teksts = "";
document.getElementById("tekstins2").innerHTML = country_teksts;
}else{
country_teksts = "Type a country!";
}
document.getElementById("tekstins2").innerHTML = country_teksts;

if((name !== "") && (country !== "")){
getLocationConstant();
}
}

</script>
</body>