(function() {
  $(function() {
    $('#link-description').keyup(function(event) {
      var char, len, max;
      max = 300;
      len = $(this).val().length;
      if (len >= max) {
        $('#characters_remaining').text('Character limit reached!');
        return $(this).value.substring(0, max);
      } else {
        char = max - len;
        return $('#characters_remaining').text(char + ' characters left');
      }
    });
    $.ajaxSetup({
      beforeSend: function(xhr) {
        return xhr.setRequestHeader("X-CSRF-Token", $('meta[name="_token"]').attr('content'));
      }
    });
    $('#category-box').change(function(event) {
      var form, option;
      form = $('#filter-form');
      option = $(this).find('option:selected');
      if (option.length) {
        return window.location = form.attr('action') + '/' + option.attr('value');
      }
    });
    $(".outbound").click(function(event) {
      event.preventDefault();
      return $.ajax('/link/outbound', {
        type: 'POST',
        dataType: 'json',
        data: {
          id: $(this).data("id")
        },
        context: this,
        error: function(jqXHR, textStatus, errorThrown) {
          return window.location = $(this).attr("href");
        },
        success: function(data, textStatus, jqXHR) {
          return window.location = $(this).attr("href");
        }
      });
    });
    return $(".favorite").submit(function(event) {
      event.preventDefault();
      return $.ajax('/link/favorite', {
        type: 'POST',
        dataType: 'json',
        data: {
          id: $(this).find('input[name=id]').val()
        },
        context: this,
        error: function(jqXHR, textStatus, errorThrown) {},
        success: function(data, textStatus, jqXHR) {
          if (data.status === 'up') {
            $('#lic_' + data.id).html(parseInt($('#lic_' + data.id).html()) + 1);
            $('#star_' + data.id).removeClass('glyphicon-heart-empty');
            $('#star_' + data.id).addClass('glyphicon-heart');
          } else {
            $('#lic_' + data.id).html(parseInt($('#lic_' + data.id).html()) - 1);
            $('#star_' + data.id).removeClass('glyphicon-heart');
            $('#star_' + data.id).addClass('glyphicon-heart-empty');
          }
        }
      });
    });
  });

}).call(this);

//# sourceMappingURL=application.js.map