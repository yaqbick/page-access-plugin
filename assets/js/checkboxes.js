jQuery(document).ready(function ($) {
  var pages = document.getElementsByClassName("apa_page");
  $(".access_button").on("click", function (event) {
    var selectedChecboxes = JSON.stringify(getSelectedCheckboxes(pages));
    // alert(selectedChecboxes);
    var data = {
      action: "my_action",
      post_type: "POST",
      data: selectedChecboxes,
    };
    console.log(data);
    $.post(
      apa_checkboxes.ajax_url,
      data,
      function (response) {
        console.log(data.data);
      },
      "json"
    );
  });

  $(".delete_button ").on("click", function (event) {
    pageID = event.target.value;
    var data = {
      action: "delete_page",
      post_type: "POST",
      data: pageID,
    };
    $.post(
      apa_checkboxes.ajax_url,
      data,
      function (response) {
        console.log(data.data);
      },
      "json"
    );
  });
});

function getSelectedCheckboxes(pages) {
  checkboxes = [];
  for (i = 0; i < pages.length; i++) {
    // alert(pages[i].innerText);
    var pageCheckboxes =
      document.forms["apa_checkbox"].elements[pages[i].innerText + "[]"];
    checkboxes.push({
      pageID: pages[i].id,
      value: getSelectedbyPage(pageCheckboxes),
    });
  }
  return checkboxes;
}

function getSelectedbyPage(pageCheckboxes) {
  selected = [];
  for (j = 0; j < pageCheckboxes.length; j++) {
    if (pageCheckboxes[j].checked) {
      selected.push(pageCheckboxes[j].value);
    }
  }
  return selected;
}
