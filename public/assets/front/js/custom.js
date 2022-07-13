(function($) {
    "use strict"; // Start of use strict

//**************************** GLOBAL CAPCHA****************************************

$('.refresh_code').on( "click", function() {
  $.get(mainurl+'/contact/refresh_code', function(data, status){
    $('.codeimg1').attr("src",capchaurl+"/assets/images/capcha_code.png?time="+ Math.random());
  });
})

//**************************** GLOBAL CAPCHA ENDS****************************************


//**************************** LOADER ****************************************

if(gs.is_loader == 1)
{
  $(window).on("load", function (e) {
    setTimeout(function(){
      $('#preloader').fadeOut(500);
    },100)
  });
}

//**************************** LOADER ENDS ****************************************


//  FORM SUBMIT SECTION

$(document).on('submit','#contactform',function(e){
  e.preventDefault();
  $('.gocover').show();
  $('button.submit-btn').prop('disabled',true);
  $.ajax({
   method:"POST",
   url:$(this).prop('action'),
   data:new FormData(this),
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
    if ((data.errors)) {
      $('.alert-success').hide();
      $('.alert-danger').show();
      $('.alert-danger ul').html('');
      for(var error in data.errors)
      {
        $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
      }
      $('#contactform input[type=text], #contactform input[type=email], #contactform textarea').eq(0).focus();
      $('#contactform .refresh_code').trigger('click');

    }
    else
    {
      $('.alert-danger').hide();
      $('.alert-success').show();
      $('.alert-success p').html(data);
      $('#contactform input[type=text], #contactform input[type=email], #contactform textarea').eq(0).focus();
      $('#contactform input[type=text], #contactform input[type=email], #contactform textarea').val('');
      $('#contactform .refresh_code').trigger('click');

    }
    $('.gocover').hide();
    $('button.submit-btn').prop('disabled',false);
  }

});

});

//  FORM SUBMIT SECTION ENDS



  // FORGOT FORM

  $("#forgotform").on('submit', function (e) {
    e.preventDefault();
    var $this = $(this).parent();
    $this.find('button.submit-btn').prop('disabled', true);
    $this.find('.alert-info').show();
    $this.find('.alert-info p').html(langg.processing);
    $.ajax({
      method: "POST",
      url: $(this).prop('action'),
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.status == 1) {
          window.location = data.route;
        } else {

          if ((data.errors)) {
            $this.find('.alert-success').hide();
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').show();
            $this.find('.alert-danger ul').html('');
            for (var error in data.errors) {
              $this.find('.alert-danger p').html(data.errors[error]);
            }
            $this.find('button.submit-btn').prop('disabled', false);
          } else {
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').hide();
            $this.find('.alert-success').show();
            $this.find('.alert-success p').html(data);
            $this.find('button.submit-btn').prop('disabled', false);
          }

        }
        $('.refresh_code').click();
      }

    });

  });



// LOGIN FORM
$("#loginform").on('submit', function (e) {
  var $this = $(this).parent();
  e.preventDefault();
  $this.find('button.submit-btn').prop('disabled', true);
  $this.find('.alert-info').show();
  $this.find('.alert-info p').html(langg.authenticating);
  $.ajax({
    method: "POST",
    url: $(this).prop('action'),
    data: new FormData(this),
    dataType: 'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      if ((data.errors)) {
        $this.find('.alert-success').hide();
        $this.find('.alert-info').hide();
        $this.find('.alert-danger').show();
        $this.find('.alert-danger ul').html('');
        for (var error in data.errors) {
          $this.find('.alert-danger p').html(data.errors[error]);
        }
      } else {
        $this.find('.alert-info').hide();
        $this.find('.alert-danger').hide();
        $this.find('.alert-success').show();
        $this.find('.alert-success p').html('Success !');
        if (data == 1) {
          location.reload();
        } else {
          window.location = data;
        }

      }
      $this.find('button.submit-btn').prop('disabled', false);
    }

  });

});

// LOGIN FORM ENDS


// REGISTER FORM
$("#registerform").on('submit', function (e) {
  var $this = $(this).parent();
  e.preventDefault();
  $this.find('button.submit-btn').prop('disabled', true);
  $this.find('.alert-info').show();
  $this.find('.alert-info p').html(langg.processing);
  $.ajax({
    method: "POST",
    url: $(this).prop('action'),
    data: new FormData(this),
    dataType: 'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {

      if (data.status == 1) {
        window.location = data.route;
      } else {

        if ((data.errors)) {
          $this.find('.alert-success').hide();
          $this.find('.alert-info').hide();
          $this.find('.alert-danger').show();
          $this.find('.alert-danger ul').html('');
          for (var error in data.errors) {
            $this.find('.alert-danger p').html(data.errors[error]);
          }
          $this.find('button.submit-btn').prop('disabled', false);
        } else {
          $this.find('.alert-info').hide();
          $this.find('.alert-danger').hide();
          $this.find('.alert-success').show();
          $this.find('.alert-success p').html(data);
          $this.find('button.submit-btn').prop('disabled', false);
        }

      }
      $('.refresh_code').click();

    }

  });

});
// REGISTER FORM ENDS



// Image Preview js

$('#image').on('change',function(){
  console.log();
  var file = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function(e) {
    $('#showimage').attr('src',e.target.result);
  };
  reader.readAsDataURL(file);
})
// Image Preview js

//**************************** SUBSCRIBE FORM SUBMIT SECTION ****************************************

$('.subscribeform').on('submit',function(e){
  var $this = $(this);
  e.preventDefault();
  $this.find("input[type='email']").prop('readonly',true);
  $this.find('button').prop('disabled',true);

  $.ajax({
   method:"POST",
   url:$(this).prop('action'),
   data:new FormData(this),
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
    if ((data.errors)) {
      for(var error in data.errors) {
        toastr.error(data.errors[error]);
      }
    }
    else {
     toastr.success(data);
     $this.find("input[type='email']").val('');
   }
   $this.find("input[type='email']").prop('readonly',false);
   $this.find('button').prop('disabled',false);
 }
});
});

//**************************** SUBSCRIBE FORM SUBMIT SECTION ENDS ****************************************


//**************************** PAGINATION STARTS ****************************************

$(document).on('click', '.pagination li', function (e) {
  e.preventDefault();

  var $this = $(this);
  if ($this.find('a').attr('href') != '#' && $this.find('a').attr('href')) {
    $('#preloader').show();
    $('#ajaxContent').load($this.find('a').attr('href'), function (response, status, xhr) {
      if (status == "success") {
        $("html,body").animate({
          scrollTop: 0
        }, 1);
        $('#preloader').fadeOut(500);

        if ($(this).parents('.all-products').length) {

          addToPagination();
        }
      }
    });
  }
});

//**************************** PAGINATION ENDS ****************************************

//**************************** CART SECTION ****************************************

$(document).on('click', '.add-to-cart', function(){

  $.get( $(this).data('href') , function( data ) {

    if(data == 'already') {
      toastr.error(langg.cart_already);
    }
    else {
      console.log(data[0]);
      $(".cart-quantity#cart-count").html(data[0]);
      $(".my-dropdown-menu#cart-items").load(mainurl+'/carts/view');
      toastr.success(langg.add_cart);
      
    }

  });


});





$(document).on('click', '.cart-remove', function(){

  var $selector = $(this).data('class');
  $('.'+$selector).hide();
  $.get( $(this).data('href') , function( data ) {
    if(data == 0) {
      $(".cart-quantity#cart-count").html(data);
      $('.cart-table').addClass('b-0');
      $('.cart-table').html('<h3 class="mt-1 pl-3 text-left">'+langg.cart_empty+'</h3>');
      $('.my-dropdown-menu#cart-items').html('<p class="mt-1 pl-3 text-left">'+langg.cart_empty+'</p>');
      $('.cartpage .col-lg-4').html('');
    }
    else {
     $('.cart-quantity').html(data[1]);
     $('.main-total').html('$'+data[0]);
   }

 });

});

//**************************** CART SECTION ENDS ****************************************

//**************************** WISHLIST SECTION ****************************************

$('#course_name').on('keyup',function(){
  var search = encodeURIComponent($(this).val());
  if(search == ""){
   $(".autocomplete").hide();
 }
 else{
   $(".autocomplete").show();
   $("#myInputautocomplete-list").load(mainurl+'/autosearch/course/'+search);

 }
});

//**************************** WISHLIST SECTION ENDS ****************************************

//**************************** WISHLIST SECTION ****************************************

$(document).on('click', '.add-to-wish', function(){

  $.get( $(this).data('href') , function( data ) {

    if(data[0] == 1) {
      toastr.success(langg.add_wish);
    }
    else {
      toastr.error(langg.already_wish);
    }

  });

  return false;

});


$(document).on('click', '.wishlist-remove', function(){

  $(this).parent().parent().parent().remove();
  
  $.get( $(this).data('href') , function( data ) {
    toastr.success(langg.wish_remove);
  });

});

//**************************** WISHLIST SECTION ENDS ****************************************

//**************************** REVIEW SECTION ****************************************

$(document).on('click','.stars', function(){
  $('.stars').removeClass('active');
  $(this).addClass('active');
  $('#rating').val($(this).data('val'));

});

$(document).on('submit','#reviewform',function(e){
  var $this = $(this);
  e.preventDefault();
  $('.gocover').show();
  $('#review-btn').prop('disabled',true);
  $.ajax({
   method:"POST",
   url:$(this).prop('action'),
   data:new FormData(this),
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {

    if(typeof(data['error']) != "undefined"){
      toastr.error(data['error']);
    }
    
    else{
      $('#reviewform textarea').eq(0).focus();
      $('#reviewform textarea').val('');
      $('#course-reviews').load($this.data('href'));
      $('#rating-load').load($this.data('side-href'));
      toastr.success(data);
    }

    $('.gocover').hide();
    $('#review-btn').prop('disabled',false);
  }

});
});

//**************************** REVIEW SECTION ENDS ****************************************

//**************************** AFFILATE SECTION ****************************************

$('.add-to-affilate').on('click',function(){
  
  var value = $(this).data('href');
  var tempInput = document.createElement("input");
  tempInput.style = "position: absolute; left: -1000px; top: -1000px";
  tempInput.value = value;
  document.body.appendChild(tempInput);
  tempInput.select();
  document.execCommand("copy");
  document.body.removeChild(tempInput);
  toastr.success(langg.affiliate_link_copy);

});

//**************************** AFFILATE SECTION ENDS ****************************************



  //  USER FORM SUBMIT SECTION

  $(document).on('submit','#userform',function(e){
    e.preventDefault();
    $('.gocover').show();
    $('button.submit-btn').prop('disabled',true);
    $.ajax({
     method:"POST",
     url:$(this).prop('action'),
     data:new FormData(this),
     contentType: false,
     cache: false,
     processData: false,
     success:function(data)
     {
      if ((data.errors)) {
        $('.alert-success').hide();
        $('.alert-danger').show();
        $('.alert-danger ul').html('');
        for(var error in data.errors)
        {
          $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
        }
        $('#userform input[type=text], #userform input[type=email], #userform textarea').eq(0).focus();
      }
      else
      {
        $('.alert-danger').hide();
        $('.alert-success').show();
        $('.alert-success p').html(data);
        $('#userform input[type=text], #userform input[type=email], #userform textarea').eq(0).focus();
      }
      $(window).scrollTop(0);
      $('.gocover').hide();
      $('button.submit-btn').prop('disabled',false);
    }

  });

  });

  // USER FORM SUBMIT SECTION ENDS

  $('.preload-close').click(function(){
    $('.subscribe-preloader-wrap').hide();
  });


})(jQuery); // End of use strict  