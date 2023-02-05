/*

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
      diff_teksts = "How difficult is the level?";
    }
    document.getElementById("text5").innerHTML = diff_teksts;
//Location
if(loc !== ""){
loc_teksts = "";
      document.getElementById("text6").innerHTML = loc_teksts;
    }else{
      loc_teksts = "How difficult is the level?";
    }
    document.getElementById("text6").innerHTML = loc_teksts;

    if((title !== "") && (image !== "") && (description !== "") && (rating !== "") && (diff !== "") && (loc !== "")){
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
document.getElementById("locationform").submit();
}

}

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
    window.location.href = "{{action([App\Http\Controllers\LevelController::class, 'index']) }}";
  }

</script> 
*/