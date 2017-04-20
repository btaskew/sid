function showResponsiveMenu()
{
  $('#Sidebar').show();
  $('#showMenu').hide();
  $('.main').css({marginLeft: "130px"});
}
function hideResponsiveMenu()
{
  $('#Sidebar').hide();
  $('#showMenu').show();
  $('.main').css({marginLeft: "60px"});
}
