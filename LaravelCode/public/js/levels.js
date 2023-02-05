var root = "/uniquest/public"

function goToIndex()
{
  window.location.href = root+"/";
}

function takeOnLevel(id)
{
  window.location.href = root+ "/attempt/"+id;
}

function goToReports()
{
  window.location.href = root+ "/reports";
}

function reportLevel(id)
{
  window.location.href =  root+"/report/"+id;
}

function deleteComment(id)
{
  window.location.href = root+ "/commentdelete/"+id;
}

function deleteLevel(id)
{
  window.location.href =  root+"/delete/"+id;
}

function goToMakeLevel()
{
  window.location.href = "http://localhost/uniquest/public/newlevel";
}
function goToLevel(id)
{
  window.location.href =  root+"/level/"+id;
}
function toAccount()
{
 window.location.href =  root+"/dashboard";
}