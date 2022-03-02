$ ->

  $('#link-description').keyup (event) ->
   max = 300
   len = $(this).val().length
   if len >= max
     $('#characters_remaining').text('Character limit reached!')
     $(this).value.substring(0, max)
   else
     char = max - len
     $('#characters_remaining').text(char + ' characters left')

  $.ajaxSetup
    beforeSend: (xhr) ->
      xhr.setRequestHeader "X-CSRF-Token", $('meta[name="_token"]').attr 'content'

  $('#category-box').change (event) ->
    form = $('#filter-form');
    option = $(this).find('option:selected');
    if option.length
      window.location = form.attr('action') + '/' + option.attr('value')

  $(".outbound").click (event) ->
    event.preventDefault()
    $.ajax '/link/outbound',
        type: 'POST'
        dataType: 'json'
        data: { id: $(this).data("id") }
        context: this
        error: (jqXHR, textStatus, errorThrown) ->
            window.location = $(this).attr("href")
        success: (data, textStatus, jqXHR) ->
            window.location = $(this).attr("href")

  $(".favorite").submit (event) ->
    event.preventDefault()

    $.ajax '/link/favorite',
        type: 'POST'
        dataType: 'json'
        data: { id: $(this).find('input[name=id]').val() }
        context: this,
        error: (jqXHR, textStatus, errorThrown) ->

        success: (data, textStatus, jqXHR) ->
            
            if data.status == 'up'
              $('#lic_' + data.id).html(parseInt($('#lic_' + data.id).html()) + 1)
              $('#star_' + data.id).removeClass('glyphicon-star-empty')
              $('#star_' + data.id).addClass('glyphicon-star')
            else
              $('#lic_' + data.id).html(parseInt($('#lic_' + data.id).html()) - 1)
              $('#star_' + data.id).removeClass('glyphicon-star')
              $('#star_' + data.id).addClass('glyphicon-star-empty')
            return