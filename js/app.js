$(function() {
  $('.sign').show();

  function roll() {
    var x = $('.news').position().left;
    var len = $('.news').width();
    if ((x + len) > $('body').width())
      x = 0;
    $('.news').css({
      // "background": "#ccc",
      "color": "red",
      "position": "absolute",
      "left": x += 1
    });
  }
  setInterval(roll, 10);
  // $('.tab').tabs();
  var html = '<ul class="subnav">' + '<li><span class="glyphicon glyphicon-cog"></span><a>设置</a></li>' + '<li ><span class="glyphicon glyphicon-envelope"></span><a>消息</a></li>' + '<li id="quit"><span  class="glyphicon glyphicon-off"></span><a>退出</a></li>' + '<li><span class="glyphicon glyphicon-bullhorn"></span><a href="#" data-toggle="modal" data-target="#about-modal">关于</a></li>' + '</ul>';
  $('body').append(html);
  $('.subnav').hide();
  $('#settings').bind('mouseover', function() {
    var x = $(this).position().left,
      y = $(this).position().top + $(this).outerHeight();
    $('.subnav').css({
      'position': 'absolute',
      'left': x,
      'top': y,
      // 'width': $('#settings').width();
    });
    $('.subnav').show();
    $('.subnav').css('width', $('#settings').outerWidth());
  });
  $('#settings').bind('mouseout', function() {
      $('.subnav').hide();
    })
    // confirm("OK?");
  $('.subnav').bind('mouseover', function() {
    $(this).show();
    $('.subnav').css('width', $('#settings').outerWidth());
  });
  $('.subnav').bind('mouseout', function() {
    $(this).hide();
  });

});
