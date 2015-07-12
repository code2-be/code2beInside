$('.dropdown-toggle').dropdown();

$('table.thread tr').click(function() {
  var url = $(this).data('path');

  if (url != undefined) {
    window.location = url;
  }
});
