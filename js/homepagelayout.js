$(document).ready(function() {

  var $span = $(".parent .col-3");
  for (var i = 0; i < $span.length; i += 4) {
   var $div = $("<div/>", {
       class: 'row'
    });
 $span.slice(i, i + 4).wrapAll($div);
 }

 $('.parent .col-3').each(function() {
   var image = $(this).find("img").attr("src");
   $(this).find("a").attr("href", image);
 });

});
