
var form = $('.form');
var btn = $('#submit');
var topbar = $('.topbar');
var input = $('#password');
var article =$('.article');
var tries = 0;
var h = input.height();
$('.spanColor').height(h+23);
$('#findpass').on('click',function(){
  $(this).text('this-is-soo-cool');
});
input.on('focus',function(){
  topbar.removeClass('error success');
  input.text('');
});
btn.on('click',function(){
  if(tries<=2){
    var pass = $('#password').val();
    console.log(pass);
    if(pass==='this-is-soo-cool'){
    setTimeout(function(){
      btn.text('Success!');
    },250);
    topbar.addClass('success');
    form.addClass('goAway');
    article.addClass('active');
    tries=0;
  }
    else{
      topbar.addClass('error');
      tries++;
      switch(tries){
        case 0:
          btn.text('Login');
          break;
        case 1:
          setTimeout(function(){
          btn.text('Você tem 2 tentativas');
          },300);
          break;
        case 2:
          setTimeout(function(){
          btn.text('Você tem 1 tentativa');
          },300);
          break;
        case 3:
          setTimeout(function(){
          btn.text('Informe o password');
          },300);
          input.prop('disabled',true);
          topbar.removeClass('error');
          input.addClass('disabled');
          btn.addClass('recover');
          break;
         defaut:
          btn.text('Login');
          break;
      }
    } 
  }
  else{
    topbar.addClass('disabled');
  }
  
});

$('.form').keypress(function(e){
   if(e.keyCode==13)
   submit.click();
});
input.keypress(function(){
  topbar.removeClass('success error');
});