<!doctype html>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <head>
</head>

<body>

<?php



?>
<button onclick="toAccount()">Account</button>
<br>
<table>
    <tr>
        <th>Report</th>
        <th>UserId</th>
        <th>LevelId</th>
        <th>VisitLevel</th>
        <th>DeleteLevel</th>
    </tr>
@foreach ($reports as $report)
<tr>
<td>{{$report -> reason}}</td>
<td>{{$report -> user_id}}</td>
<td>{{$report -> level_id}}</td>
<td><button onclick="goToLevel({{$report->level_id}})">ShowLevel</button></td>
<td><button onclick="deleteLevel({{$report->level_id}})">DeleteLevel</button></td>
</tr>
@endforeach
</table>
</body>
<script>
function goToLevel(id)
{
  window.location.href = "/uniquest/public/level/"+id;
}
function deleteLevel(id)
{
  window.location.href = "/uniquest/public/delete/"+id;
}
function toAccount()
{
 window.location.href = "/uniquest/public/dashboard";
}
</script>

</html>
