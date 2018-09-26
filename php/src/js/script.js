$(document).ready(function() {
  $('#buscar').click(function() {
    $.getJSON('http://localhost:41071/pessoa', function(data, status) {
      $('#resultado').html('')
      var items = []
      $.each(data, function(key, val) {
        console.log(key)
        items.push("<li id='" + val.id + "'>" + val.nome + '</li>')
      })

      $('<ul/>', {
        class: 'vermelho',
        html: items.join('')
      }).appendTo('#resultado')
    })
  })

  $('#gravar').click(function() {
    //enviado
    $.ajax({
      type: 'POST',
      url: 'http://localhost:41071/pessoa',
      data: '{"nome":"marcondes 2"}', //JSON.stringify ({nome: 'aluno'}),
      success: function(data) {
        //alert("data: " + data);
      },
      contentType: 'application/json',
      dataType: 'json'
    }).then(res => {
      $('#buscar').click()
    })
  })
})
