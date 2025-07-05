
$(document).ready(function () {

   $(document).ready(function(){
    $('#navbarNav').on('shown.bs.collapse', function () {
      $('#navbar-collapse-btn').removeClass('fa-bars').addClass('fa-xmark cross-icon');
    });

    $('#navbarNav').on('hidden.bs.collapse', function () {
      $('#navbar-collapse-btn').removeClass('fa-xmark cross-icon').addClass('fa-bars');
    });
  });


  let backToTopBtn = $('#backToTopBtn');
  let mastheader = $("#mastheader");

  $(window).scroll(function () {
    if ($(this).scrollTop() > 200) {
      backToTopBtn.fadeIn();
    } else {
      backToTopBtn.fadeOut();
    }
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(mastheader).addClass('mastfixedbgheader');
    } else {
      $(mastheader).removeClass('mastfixedbgheader');
    }
  });

  backToTopBtn.click(function () {
    $('html, body').animate({ scrollTop: 0 }, 500); 
    return false;
  });

});

