$(function() {
  $('#market').bind('click', function() {
    $.get('./market/market.php', function(data) {
      // alert(typeof(data));
      $('#goods-list').empty();
      $.each(data, function(index, result) {
        // alert(result);
        $('#goods-list').append('<li><span class="goods-name">' + result.name + '</span><span class="wealth">' + result.price + '</span></li>');
      });
    }, "json");
    // alert('good');
  });
  $('#list').bind('click', function() {
    $.get('./rank/rank.php', function(data) {
      $('#wealth-rating').empty();
      $('#up-rating').empty();
      $.each(data, function(index, result) {
        if (index <= 7) {
          $('#wealth-rating').append('<li><span class="rich-man">' + result.name + '</span><span class="wealth">' + result.money + '</span><span class="float-rate">' + result.ratio + '</span></li>');
          $('span.float-rate:even').css({
            'color': 'black',
            'font-weight': 'bold',
            // 'background': '#9D4343'
          });
        } else
          $('#up-rating').append('<li><span class="up-name">' + result.name + '</span><span class="wealth">' + result.money + '</span><span class="up-rate">' + result.ratio + '</span></li>');
      });
    }, "json");
  });
  $('#sign-up').click(function() { //注册为2
    $.post('./user/login.php', {
      'type': 2,
      'username': $('#username').val(),
      'stno': $('#stno').val(),
      'password': $('#password').val()
    }, function(data) {
      // alert(data);
      $('#settings').text($('#username').val());
      $.cookie('userID', data, {
        path: '/',
        expires: 7
      });
    });
  });
  $('#sign-in').click(function() { //登录为1
    $.post('./user/login.php', {
      'type': 1,
      // 'username': $('#username').val(),
      'stno': $('#stno').val(),
      'password': $('#password').val()
    }, function(data) {
      // alert(data);
      $.cookie('userID', data, {
        path: '/',
        expires: 7
      });

    });
  });
  $('.subnav>ul>li#quit').click(function() {
    $.cookie('userID', null);
    if (!$.cookie('userID')) {
      $('#settings').text('设置');
    }
  });
});
