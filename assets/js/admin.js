jQuery(function ($) {

  $(".sidebar-dropdown > a").click(function () {
    $(".sidebar-submenu").slideUp(200);
    if (
      $(this)
        .parent()
        .hasClass("active")
    ) {
      $(".sidebar-dropdown").removeClass("active");
      $(this)
        .parent()
        .removeClass("active");
    } else {
      $(".sidebar-dropdown").removeClass("active");
      $(this)
        .next(".sidebar-submenu")
        .slideDown(200);
      $(this)
        .parent()
        .addClass("active");
    }
  });

  $("#close-sidebar").click(function () {
    $(".page-wrapper").removeClass("toggled");
  });
  $("#show-sidebar").click(function () {
    $(".page-wrapper").addClass("toggled");
  });

});


$(function () {
  let $sortable = $("#resources-list > tbody");
  $sortable.sortable({
    stop: function (event, ui) {
      let params = $sortable.sortable("toArray");
      console.log(params);

    }
  })

  let tag = document.getElementsByClassName('table')[0];
  let table_id = tag.id;
  let url = tag.getAttribute('data-url');

  console.log(table_id, url);

  $(document).ready(function () {
    $('#' + table_id).DataTable({
      "ajax": {
        url,
        type: 'POST'
      },
      "columnDefs": [{
        "width": "10%",
        "targets": 0
      },
      {
        "width": "20%",
        "targets": 3
      }
      ],
      "oLanguage": {
        "sSearch": "Filter records:"
      },
      "aoColumns": [{
        "bSortable": true
      },
      {
        "bSortable": true
      },
      {
        "bSortable": true
      },
      {
        "bSortable": false
      },
      ]
    });
  });
});