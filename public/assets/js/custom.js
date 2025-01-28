/** 
  * Template Name: Daily Shop
  * Version: 1.0  
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS
  

  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER 
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER) 
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER) 
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER 
  13. RELATED ITEM SLIDER (SLICK SLIDER)

  
**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */
    
     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );   
  
  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */    
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER 
  /* ----------------------------------------------------------- */    

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

  
  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
    
  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */     
    
    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */  

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */        

    jQuery(function(){
      if($('body').is('.productPage')){
       var skipSlider = document.getElementById('skipstep');
       var ps = parseFloat($('#ps').val()) || 0;
       var pe = parseFloat($('#pe').val()) || 0;
       if(ps == 0 || pe == 0) {
        ps = 100;
        pe = 1700;
       }
        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                '10%': 100,
                '20%': 300,
                '30%': 500,
                '40%': 700,
                '50%': 900,
                '60%': 1100,
                '70%': 1300,
                '80%': 1500,
                '90%': 1700,
                'max': 1900
            },
            snap: true,
            connect: true,
            start: [ps, pe]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });


    
  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out      
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

    $('#login-modal').on('hidden.bs.modal', function(){
      $('.error-message').remove();
    });
    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).on('click', '.clickEvent', function(){
      let EL = $(this);
      let src = EL.data('src');
      let color_id = EL.data('id');
      let mrp = EL.data('mrp');
      let price = EL.data('price');
      $('#color_id').val(color_id);
      $('.price').html('$' + price);
      $('.mrp').html('<del>$'+ mrp +'</del>');
      
      $('.simpleLens-big-image-container').html(`<a data-lens-image="${src}" class="simpleLens-lens-image"><img src="${src}" class="simpleLens-big-image"></a>`);
      $('#error').html('');
    });

    $(document).on('click', '.getSize', function(){
      let EL = $(this);
      let size = EL.data('size');
      let size_id = EL.data('id');
      let color_id = '';
      EL.closest('div').find('a').not(EL).css('border', '1px solid #ddd');
      EL.css('border', '1px solid #333');
      $('#size_id').val(size_id);

      /* hide every color */
      $('.clickEvent').addClass('hidden');
      let shownColors =  $('.size_' + size);
      shownColors.removeClass('hidden');
      $('#color_id').val(color_id);
      
      let shownColorLen = shownColors.length;
      if(shownColorLen == 1) {
        color_id = shownColors.attr('data-id');
        let price = shownColors.attr('data-price');
        let mrp = shownColors.attr('data-mrp');
        $('#color_id').val(color_id);
        $('.price').html('$' + price);
        $('.mrp').html('<del>$'+ mrp +'</del>');
      }
      $('#error').html('');
    });

    $(document).on('click', '.aa-add-card-btn', function(){
      let EL = $(this);
      let product_id = EL.data('id');
      let color_id = EL.data('c');
      let size_id = EL.data('s');
      let quantity = 1;

      addToCart(EL, product_id, color_id, size_id, quantity);
    });

    $(document).on('click', '.aa-cart-quantity', function(){
      let index = $('.aa-cart-quantity').index(this);
      let EL = $(this);
      let product_id = EL.data('p');
      let color_id = EL.data('c');
      let size_id = EL.data('s');
      let price = EL.data('prc');
      let quantity = EL.val();
      let total = quantity * price;
      $('.total').eq(index).html('$' + total);

      $.when(addToCart('', product_id, color_id, size_id, quantity)).then(function(){
        cal_tot();
      });
    });

    $(document).on('click', '.aa-add-to-cart-btn', function(){
      let EL = $(this);
      let product_id = EL.data('id');
      let color_id = $('#color_id').val();
      let size_id = $('#size_id').val();
      let quantity = $('#quantity').val();
      
      if(size_id == '') {
        $('#error').html('Size is missing.');
      } else if(color_id == '') {
        $('#error').html('Color is missing.');
      } else if(product_id == '') {
        $('#error').html('Product is missing.');
      } else {
        addToCart(EL, product_id, color_id, size_id, quantity);
      }
    });
    
    function addToCart(EL, product_id, color_id, size_id, quantity) {
      $.ajax({
        url: '/add-to-cart',
        type: 'POST',
        data: {
          product_id: product_id,
          color_id: color_id,
          size_id: size_id,
          quantity: quantity
        },
        success: function(res) {
          if(EL !== '') {
            alert(res.message);
            EL.html('ADDED TO CART');
          }
          $('.aa-cartbox').html(res.cartItems);
        }
      });
    }

    function cal_tot() {
      let [subtotal, total] = new Array(2).fill(0);

      $('.aa-cart-quantity').each(function(i, v){
        let quantity = $(v).val();
        let price = $(v).attr('data-prc');
        subtotal += quantity * price;
        total += quantity * price;
      });
      
      $('#subtotal').html('$' + subtotal);
      $('#total').html('$' + total);
    }

    $(document).on('click', '.remove', function(){
      if(confirm('Do you want to remove?')) {
        let EL = $(this);
        let cart_id = EL.data('id');

        deleteCartItem(EL, cart_id)
        .done(function(data){
          if(data.status === 'success') {
            $.when(EL.closest('tr').remove()).then(function(){
              // update cart header count and its list
              $('.aa-cartbox').html(data.cartItems);
              cal_tot();
            });
          }
        })
        .fail(function(error){
          console.log(error);
        });
      }
    });

    $(document).on('click', '.aa-remove-product', function(){
      if(confirm('Do you want to remove?')) {
        let EL = $(this);
        let cart_id = EL.data('id');

        deleteCartItem(EL, cart_id)
        .done(function(data){
          if(data.status === 'success') {
            EL.closest('li').remove();
            let lastSegment = window.location.pathname.split('/').pop();
            if(lastSegment === 'my-cart') {
              $('.remove[data-id="' + cart_id + '"]').closest('tr').remove();
              cal_tot();
            }
            // update cart header count and its list
            $('.aa-cartbox').html(data.cartItems);
          }
        })
        .fail(function(error){
          console.log(error);
        });
      }
    });

    function deleteCartItem(EL, cart_id) {
      return $.ajax({
        url: '/delete',
        type: 'POST',
        data: {
          cart_id: cart_id
        }
      });
    }

    $(document).on('change', '#sort_by', function(){
      $('.aa-sort-form').submit();
    });

    $(document).on('click', '.aa-filter-btn', function(){
      let lower = parseFloat($('#skip-value-lower').html());
      let upper = parseFloat($('#skip-value-upper').html());
      $('#ps').val(lower);
      $('#pe').val(upper);

      $('.aa-sort-form').submit();
    });

    $(document).on('click', '.aa-color-tag > a', function(){
      let color_id = $(this).data('id');
      let colors = $('#cl').val();
      if(colors == '') {
        colors = color_id;
      } else if(colors.indexOf(color_id) == -1) {
        colors += color_id;
      } else if(colors.includes(color_id)) {
        colors = colors.replace(color_id, '');
      } else {
        colors = '';
      }
      $('#cl').val(colors);

      $('.aa-sort-form').submit();
    });

    $(document).on('submit', '#searchForm', function(){
      let param = $('#param').val();
      if(param.length < 3) {
        return false;
      }
    });

    let errorStyle = `
      margin-top: -10px;
      color: red;
      display: block
    `

    $(document).on('submit', '#registrationForm', function(e){
      e.preventDefault();
      $('.error-message').remove();
      $('#registrationFormBtn').attr('disabled', true).text('Loading...');

      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){
          if(data.status === 'success') {
            alert(data.message);
            window.location.reload();
          }
        },
        error: function(xhr, status, error){
          $.each(xhr.responseJSON.errors, function(key, value) {
            $('#' + key).after('<span class="error-message" style="'+ errorStyle +'">' + value[0] + '</span>');
          });
          $('#registrationFormBtn').attr('disabled', false).text('Register');
        }
      });
    });

    $(document).on('submit', '#loginForm', function(e){
      e.preventDefault();
      $('.error-message').remove();
      $('#loginFormBtn').attr('disabled', true).text('Loading...');

      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){
          if(data.status === 'success') {
            alert(data.message);
            window.location.href = window.location.href;
          }
        },
        error: function(xhr, status, error){
          if(xhr.status == 422) {
            $.each(xhr.responseJSON.errors, function(key, value) {
              $('#' + key + '_login').after('<span class="error-message" style="'+ errorStyle +'">' + value[0] + '</span>');
            });
          } else if(xhr.status == 401) {
            $('#email_login').after('<span class="error-message" style="'+ errorStyle +'">' + xhr.responseJSON.error + '</span>');
          }
          $('#loginFormBtn').attr('disabled', false).text('Login');
        }
      });
    });

    $(document).on('click', '#lostPasswordModalOpen', function(){
      $('#login-modal').modal('hide');
      $('#forget-modal').modal('show');
    });

    $(document).on('click', '#loginModalOpen', function(){
      $('#login-modal').modal('show');
      $('#forget-modal').modal('hide');
    });

    $(document).on('submit', '#forgetPasswordForm', function(e){
      e.preventDefault();
      $('.error-message').remove();
      $('#forgetPasswordFormBtn').attr('disabled', true).text('Loading...');

      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){
          if(data.status === 'success') {
            alert(data.message);
            window.location.reload();
          }
        },
        error: function(xhr, status, error){
          if(xhr.status == 422) {
            $.each(xhr.responseJSON.errors, function(key, value) {
              $('#' + key + '_forget').after('<span class="error-message" style="'+ errorStyle +'">' + value[0] + '</span>');
            });
          } else if(xhr.status == 401) {
            $('#email_forget').after('<span class="error-message" style="'+ errorStyle +'">' + xhr.responseJSON.error + '</span>');
          }
          $('#forgetPasswordFormBtn').attr('disabled', false).text('Send Reset Link');
        }
      });
    });

    $(document).on('submit', '#resetPasswordForm', function(e){
      e.preventDefault();
      $('.error-message').remove();
      $('#resetPasswordFormBtn').attr('disabled', true).text('Loading...');

      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){
          if(data.status === 'success') {
            alert(data.message);
            window.location.href = data.url;
          }
        },
        error: function(xhr, status, error){
          if(xhr.status == 422) {
            $.each(xhr.responseJSON.errors, function(key, value) {
              $('#' + key + '_reset').after('<span class="error-message" style="'+ errorStyle +'">' + value[0] + '</span>');
            });
          } else if(xhr.status == 401) {
            $('#password_reset').after('<span class="error-message" style="'+ errorStyle +'">' + xhr.responseJSON.error + '</span>');
          }
          $('#resetPasswordFormBtn').attr('disabled', false).text('Submit');
        }
      });
    });

    $(document).on('click', '#applyCoupon', function(){
      $('#coupon_error, .error-message').html('');
      let coupon_cd = $('#coupon_cd').val();
      let orderVal = $(this).data('val');
      let url = $(this).data('url');
      
      if(coupon_cd !== '') {
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            'coupon_cd': coupon_cd,
            'orderVal': orderVal
          },
          success: function(res) {
            if(res.status === 'error') {
              $('#coupon_error').css('color', 'red').html(res.error);
            } else {
              $('#coupon_error').css('color', 'green').html(res.message);
              $('#totalPrice').html('$' + res.orderVal);
              $('.coupon_cd_row').html('<th>Coupon <small style="color: red; font-size: 10px; cursor: pointer;">Remove</small></th><th>'+ coupon_cd.toUpperCase() +'</th>').removeClass('hidden');
              $('#coupon_cd').hide();
              setTimeout(function(){
                $('#coupon_error').html('');
              }, 1500);
            }
          }
        });
      } else {
        $('#coupon_error').css('color', 'red').html('Please Enter a Valid Coupon.');
        $('#coupon_cd').focus();
      }
    });

    $(document).on('click', 'th > small', function(){
      $('#coupon_error').html('');
      $('#coupon_cd').show().val('');
      $('.coupon_cd_row').html('').addClass('hidden');
      let orderVal = $('#applyCoupon').attr('data-val');
      $('#totalPrice').html('$' + orderVal);
    });

    $(document).on('submit', '#orderForm', function(e){
      e.preventDefault();
      $('.error-message').remove();
      $('#coupon_error').html('');
      $('#orderFormBtn').attr('disabled', true).val('Loading...');

      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){
          if(data.status === 'success') {
            if(data.payment_url !== '') {
              window.location.href = data.payment_url;
            } else {
              window.location.href = data.url;
            }
          }
          if(data.status === 'error') {
            $('#coupon_error').css('color', 'red').html(data.error);
            $('#orderFormBtn').attr('disabled', false).val('Place Order');
          }
        },
        error: function(xhr, status, error){
          if(xhr.status == 422) {
            errorStyle = errorStyle.replace('-10px', 0);
            $.each(xhr.responseJSON.errors, function(key, value) {
              console.log(key)
              $('#' + key).after('<span class="error-message" style="'+ errorStyle +'">' + value[0] + '</span>');
            });
          }
          $('#orderFormBtn').attr('disabled', false).val('Place Order');
        }
      });
    });

    // user order pagination
    var page = 1;

    $(document).on('click', '#loadMoreOrder', function(){
      let url = $(this).data('url');
      let EL = $(this);
      page++;
      loadMoreOrders(page, url, EL);
    });

  function loadMoreOrders(page, url, buttonEle) {

    $.ajax({
      url: url + "?page=" + page,
      datatype: "html",
      type: "GET",
      beforeSend: function () {
        buttonEle.attr('disabled', true).html('Loading...');
      }
    })
    .done(function (response) {
      console.log(response.html);
      if (response.html == '') {
        buttonEle.hide();
        return;
      }
      buttonEle.attr('disabled', false).html('Load More Orders...');
      $("#orderTblBody").append(response.html);
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
      console.log('Server error occured');
    });  
  }
});

