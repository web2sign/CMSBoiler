jQuery(document).ready(function($){

$(document).on('click','.close',function(e){
  e.preventDefault();
  $.fancybox.close();
});



window.uploadBtn = function(selector){

  alert('test');

  var uploader = new qq.FineUploader({
      element: $(selector)[0],
      debug: true,
      multiple: false,
      request: {
      endpoint: site_url + '/admin/media/uploads',
      customHeaders: {
          "X-CSRF-Token": $("meta[name='csrf-token']").attr("content")
        }
      },
      validation: {
          allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
      },
      callbacks: {
        onComplete: function(id, name, response) {
          if( response.success ) {
            var img = $('<img />');
            img.attr('src', site_url + '/media/thumbnail/'+ response.info.id +'?w=150&h=150' );
            $('.featured-image').empty().addClass('active');
            img.appendTo('.featured-image');
            $('.input-featured-image').val( response.info.id );
            $.fancybox.close();
            $('.choose-image-btn').data('src', $('.choose-image-btn').data('url') + '?id=' + response.info.id );
          }
        }
      }
    });
}

if( $("[data-fancy]").length ) {

$("[data-fancy]").fancybox({
  afterShow : function( instance, current ) {
    uploadBtn('#fine-uploader');
  }
});

}

$.fancyConfirm = function (opts) {
  opts = $.extend(true, {
    title: 'Are you sure?',
    message: '',
    okButton: 'OK',
    noButton: 'Cancel',
    callback: $.noop
  }, opts || {});

  $.fancybox.open({
    type: 'html',
    src: '<div class="modal-dialog"><div class="modal-content">' +
      '<div class="modal-header"><button type="button" class="close"><span aria-hidden="true">×</span></button><h4 class="modal-title">' + opts.title + '</h4></div>' +
      '<div class="modal-body"><p>' + opts.message + '</p></div>' +
      '<div class="modal-footer text-right">' +
      '<a data-value="0" data-fancybox-close href="javascript:;" class="btn btn-default">' + opts.noButton + '</a> &nbsp;' +
      '<button data-value="1" data-fancybox-close class="btn btn-warning">' + opts.okButton + '</button>' +
      '</div>' +
      '</div></div>',
    opts: {
      animationDuration: 350,
      animationEffect: 'material',
      modal: true,
      baseTpl: '<div class="fancybox-container fc-container" role="dialog" tabindex="-1">' +
        '<div class="fancybox-bg"></div>' +
        '<div class="fancybox-inner">' +
        '<div class="fancybox-stage"></div>' +
        '</div>' +
        '</div>',
      afterClose: function (instance, current, e) {
        var button = e ? e.target || e.currentTarget : null;
        var value = button ? $(button).data('value') : 0;

        opts.callback(value);
      }
    }
  });
}

/* popup function */

var admin = {

  permission: function(){
    if( $('[data-required-toggle]').length < 1 ) {
      return false;
    }


    $('[data-required-toggle]').each(function(i,o){
      $(o).on('change', function(e){
        e.preventDefault();
        var _required = $(o).data('required-toggle');
        var _value = $(o).val();

        if( _required != '' ) {

          $('input[value='+ _required +']', $(o).parents('.permit-tr')).each(function(ii,oo){
            $(oo).prop('checked',true);
          });

        }

          
        $('input[data-required-toggle='+ _value +']', $(o).parents('.permit-tr')).each(function(ii,oo){
          if( $(oo).prop('checked') ){
            $(oo).prop('checked',false);
          }
        });


      });
    });

  },

  popupDelete: function(){

  },

  bind: function(){

    $('[data-delete-item]').bind('click',function(e){
      e.preventDefault();

      var src = $(this).data('href');
      $.fancyConfirm({
        title: "Please confirm",
        message: "Are you sure you want delete this?",
        okButton: 'Yes',
        noButton: 'Cancel',
        callback: function (value) {
          if (value) {
            var token = $('<input />');
            token.attr('type','hidden');
            token.attr('name','_token');
            token.val( $("meta[name='csrf-token']").attr("content") );
            var form = $('<form />');
            form.attr('method', 'post');
            form.attr('action', src);
            form.attr('action', src);
            form.append(token);
            form.appendTo('body');
            form.submit();
          }
        }
      });
    });

  },

  init: function(){
    this.bind();
    this.permission();
  }

}.init();



});