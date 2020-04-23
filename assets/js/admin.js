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

  /**
   * datatable sorting
   */
  let $sortable = $("#resources-list > tbody");
  $sortable.sortable({
    stop: function (event, ui) {
      let params = $sortable.sortable("toArray");
      console.log(params);

    }
  })

  /**
   * datatable get data
   */
  let tag = document.getElementsByClassName('table')[0];
  if (tag) {
    let table_id = tag.id;
    let url = tag.getAttribute('data-url');
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
  }

  /**
   * resource file
   */

  $("select#type").change(function () {
    let value = $(this).children(":selected").attr("value");

    let image = `<div class="form-group" id="image">
                    <label for="image">image<span class="text-danger">*</span></label>
                    <input type="file" class="form-control p-0 border-0" id="image" name="image">
                  </div>`;

    let link = `<div class="form-group" id="url">
                  <label for="url">Link<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="url" name="url" placeholder="http://..">
                  <small class="text-danger"><?php echo form_error('url'); ?></small>
                </div>`;

    if (value == "image") {
      $('#resource_file').html(image);
    } else {
      $('#resource_file').html(link);
    }
    console.log(value);
  });
});