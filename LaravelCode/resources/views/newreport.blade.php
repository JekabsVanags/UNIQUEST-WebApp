@php
use App\Http\Controllers\ReportController;
@endphp

<!doctype html>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <head>
</head>

<body>

<!--Formu, KUR IEVADA VISU IZNEMOT IMAGE -->
<form action="{{action([App\Http\Controllers\ReportController::class, 'store']) }}" method="post"> 
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <label for="reason">Complaint:</label><br>
  <input type="textarea" id="reason" name="reason"><br>
  <input type="hidden" id="levelid" name="levelid" value={{$id}}>
  <input type="submit" value="Submit">
</form>

<button onclick="goToIndex()">Return</button>

<script type="text/javascript">
    function goToIndex()
    {
      window.location.href = "{{action([App\Http\Controllers\LevelController::class, 'index']) }}";
    }
</script>
</body>