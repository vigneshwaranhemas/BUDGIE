
// sidebar menu
$(".iconMenu-bar li").click(function () {
  $(".iconMenu-bar li").removeClass("open");
  $(this).addClass("open");
});

$(function() {
  // this will get the full URL at the address bar
  var url =  window.location.href.split(/[?#]/)[0];

  $(".iconMenu-bar li").removeClass("open");
  $(".iconbar-mainmenu li a").each(function() {

    // checks if its the same on the address bar
    if (url === (this.href)) {
      // console.log(this.closest("li"));
      $(this).closest("li").addClass("active");
      $(this).addClass("active");
      //for making parent of submenu active
      $(this).closest("li").parent().parent().addClass("open");
    }
  });


});

$('.mobile-sidebar #sidebar-toggle').click(function() {

  var $this = $(".iconsidebar-menu");

  // var $this = $(".iconsidebar-menu");
  // $('li').removeClass('open');
  // $this.removeClass('iconbar-mainmenu-close');
  // $(one).addClass('open');

  if ($this.hasClass('iconbar-second-close')) {
    //$this.removeClass();
    $this.removeClass('iconbar-second-close').addClass('iconsidebar-menu');

    if ($('li').hasClass('open')){

    }else{
      $this.addClass('iconbar-mainmenu-close');

    }

  } else if ($this.hasClass('iconbar-mainmenu-close')) {
    $this.removeClass('iconbar-mainmenu-close').addClass('iconbar-second-close');
  } else {
    $this.addClass('iconbar-mainmenu-close');
  }
});

$('.bar-icons-hover').click(function() {

  var $this = $(".iconsidebar-menu");

  if ($this.hasClass('iconbar-mainmenu-close')) {
      $this.removeClass('iconbar-mainmenu-close');
  } else {

    $this.addClass('iconbar-mainmenu-close');
  }

});

 if($( window ).width() <= 1199 ) {
  $(".iconsidebar-menu").addClass("iconbar-mainmenu-close");
  $('.iconMenu-bar').removeClass("active");
  $('.iconsidebar-menu').addClass("iconbar-second-close");
  $('.iconsidebar-menu').removeClass("iconbar-mainmenu-close");
};

$('.bar-icons-hover').click(function() {

  var $this = $(".iconsidebar-menu");

  if ($this.hasClass('iconbar-mainmenu-close')) {
      $this.removeClass('iconbar-mainmenu-close');
  } else {

    $this.addClass('iconbar-mainmenu-close');
  }

});
