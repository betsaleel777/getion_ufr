(function($) {
$(function() {
  //recuperer le contenu de l'element de d'id notifier
  // recuperer à l'interieur de le texte de l'alerte soit warning etc ;
  // recuperer le contenu de l'element à afficher


  if ($("#notifier>#message").text().length > 0) {
    var message = $("#notifier>#message").text();
    var color = $("#notifier>#color").text();
    var alerte = $("#notifier>#alert").text();
    var animIn = $("#notifier>#animIn").text();
    var animOut = $("#notifier>#animOut").text();

    $.notify({
      // options
      title: '<strong style="font-size:20px">notification:</strong>',
      message: '<p style="color:' + color + ',font-size:10px" >' + message + '</p>',
    }, {
      // settings
      type: alerte,
      position: null,
      allow_dismiss: true,
      newest_on_top: false,
      showProgressbar: false,
      placement: {
        from: "top",
        align: "right"
      },
      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 5000,
      timer: 1000,
      animate: {
        enter: 'animated ' + animIn,
        exit: 'animated ' + animOut,
      },
      mouse_over: null,
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: 'class',
      template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '</div>'
    });
  }
});
})(jQuery);
