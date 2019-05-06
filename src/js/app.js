import 'jquery';
import 'owl.carousel2';
import '@fancyapps/fancybox';
import 'bootstrap';

$(document).ready(function() {
  $('#order').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever'); 
    //var title = button.data('title');
    var modal = $(this);
    modal.find('.modal-title').text(recipient);
    modal.find('.modal-body input[name=hidden]').val(recipient);

    $(this).find('.alert').addClass('d-none');
    $(this).find('form')[0].reset();
  });

  //   scroll
  $( 'a.scroll' ).click(function( event ) {
    $('.m-nav').removeClass('m-nav--is-open');
    $('body').removeClass('overflow');
    event.preventDefault();
    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top }, 500);
  });


  //   m-nav
  $(document).on('click', '.burger', function(e) {
    $('.m-nav').addClass('m-nav--is-open');
    $('body').addClass('overflow');
  });
  $(document).on('click', '.m-nav__close', function(e) {
    $('.m-nav').removeClass('m-nav--is-open');
    $('body').removeClass('overflow');
    e.preventDefault();
  });



  //   form
  $('.form-submit').submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    let form = $(this);
    let url = form.attr('action');
    console.log(form.serialize());
    
    $.ajax({
      type: 'POST',
      url: url,
      dataType: 'html',
      data: form.serialize(), // serializes the form's elements.
      success: function(response) {
        $(e.target).find('.alert-success').removeClass('d-none');
      },
      error: function(response) {
        $(e.target).find('.alert-danger').removeClass('d-none');
      },
    });
  });
});
