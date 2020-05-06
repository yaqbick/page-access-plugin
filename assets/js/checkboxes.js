var pages = document.getElementsByClassName("apa_page");
// alert(apa_checkboxes.pluginsUrl);
for (i = 0; i < pages.length; i++) {
  console.log(pages[i].innerText);
}
// var sports = document.forms["apa_checkbox"].elements["sports[]"];
jQuery(document).ready(function ($) {
  //   $(".access_button").on("click", function (event) {
  var data = {
    action: "my_action",
    whatever: "dupa",
  };

  $.post(apa_checkboxes.ajax_url, data, function (response) {
    console.log("response");
  });
});
// });
