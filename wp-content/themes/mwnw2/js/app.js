// (function($){
//   $(window).on('resize', function (){
//       var headerHeight = $('header').outerHeight();
//       var h1Height = $('header h1').outerHeight();
//       var h2Height = $('header h2').outerHeight();
//       var latestHeight = $('header .latest').outerHeight();
//       var floatMoreHeight = $('#floatMore').outerHeight();
//       var paddingTop = (headerHeight - (h1Height + h2Height + latestHeight + floatMoreHeight))/2;
//       $('header h1').css('padding-top', paddingTop);
//   }).resize();
// })(jQuery);

(function($){
  
  $('body').hide();

  $(window).load(function(){
    $('body').show();

    var moreHeightBefore = $('#moreMenu').outerHeight();
    var moreMenu = $('#moreMenu');
    console.log(moreHeightBefore);
    moreMenu.removeClass('open');
    moreMenu.addClass('close');

    $('.menuMore').on('click', function(e){
      e.preventDefault();
      if(moreMenu.hasClass('open')){ 
        moreMenu.removeClass('open');
        moreMenu.addClass('close');
      } else {
        moreMenu.removeClass('close');
        moreMenu.addClass('open');
        moreMenu.css('height', moreHeightBefore);
      }
    });
  });
  
  $('.title span').on('click',function(e){
    if($(this).hasClass('dropUp')){
      $(this).addClass('dropDown').removeClass('dropUp');
      $(this).parent().parent().parent().find('ul').hide();
      console.log('fire1');
    } else{
      $(this).addClass('dropUp').removeClass('dropDown');
      $(this).parent().parent().parent().find('ul').show();
      console.log('fire2');
    }
  });

  $(document).foundation();
  $(document).ready(function(){
    var x = false;
    setInterval(function(){
      if(x){
        $('.topBanner').css('background-color', '#f78a51');
        x = false;
      } else {
        $('.topBanner').css('background-color', '#442145');
        x = true;
      }
    }, 5000);
  });


})(jQuery);