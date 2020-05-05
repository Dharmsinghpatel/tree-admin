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
  sort($("#resources_list > tbody"));
  sort($("#documents_list > tbody"))
  sort_content($("#aditional_sort"))

  function sort($sortable) {
    $sortable.sortable({
      stop: function (event, ui) {
        let $table = $(".table-data")[0];
        let url = $table.getAttribute('data-url-sort');
        let params = $sortable.sortable("toArray");

        $.ajax({
          url,
          data: { 'sort_array': params },
          dataType: 'json',
          type: 'POST',
          success: function (res) {
            // datatable_list();
          }
        });

      }
    })

  }

  function sort_content($sortable) {
    $sortable.sortable({
      stop: function (event, ui) {
        let params = $sortable.sortable("toArray");
        console.log(params);
      }
    })
  }

  /**
   * datatable get data
   */
  datatable_list();
  function datatable_list() {

    let tag = document.getElementsByClassName('table')[0];
    console.log('hi', tag);
    let table;
    if (tag) {
      let table_id = tag.id;
      let url = tag.getAttribute('data-url');
      $(document).ready(function () {
        table = $('#' + table_id).DataTable({
          "ajax": {
            url,
            type: 'POST'
          },
          // "columnDefs": [
          //   {
          //     "targets": 0,
          //     "orderable": false
          //   }
          // ],
          "oLanguage": {
            "sSearch": "Filter records:"
          },
          // "aoColumnDefs": [{
          //   "targets": 0,
          //   "bSortable": false
          // }
          // ]
        });

        // Add event listener for opening and closing details
        $('tbody').on('click', 'a.show-topics', function () {
          let start_topic = $(this).attr("data-topic-start"), tr = $('tr.topic' + start_topic);
          tr.toggleClass('d-none show');
        });
      });
    }
  }

  /**
   * resource file
   */

  $('select#type').unbind('change').on('change', (function () {
    let value = $(this).children(":selected").attr("value"),

      image = `<div class="form-group" id="image">
                    <label for="image">image<span class="text-danger">*</span></label>
                    <input type="file" class="form-control p-0 border-0" id="image" name="image">
                  </div>`,

      link = `<div class="form-group" id="url">
                  <label for="url">Link<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="url" name="url" placeholder="http://..">
                  <small class="text-danger"><?php echo form_error('url'); ?></small>
                </div>`,

      video = `
                <div class="form-group" id="video_thumbnail">
                    <label for="video_thumbnail">Video Thumbnail<span class="text-danger">*</span></label>
                    <input type="file" class="form-control p-0 border-0" id="video_thumbnail" name="video_thumbnail">
                </div>

                <div class="form-group" id="url">
                    <label for="url">Link<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="http://..">
                    <small class="text-danger"><?php echo form_error('url'); ?></small>
                </div>`;

    switch (value) {
      case 'image': {
        $('#resource_file').html(image);
        break;
      }
      case 'site': {
        $('#resource_file').html(link);
        break;

      }
      case 'video': {
        $('#resource_file').html(video);
        break;
      }
      case 'topic': {

      }
      default: {
        $('#resource_file').html('');
      }
    }
  }));

  /**
   * resource delete
   */
  $(document).on('click', '.delete', function (e) {
    let url = $(this).attr("data-delete-url");
    $('#modal').modal('show');
    $('#modal_label').html('Delete');
    $('#modal_body').html('Do you want to delete this item!');
    $('#btn_close').html('No');
    $('#btn-save').html('Yes');
    $('#btn-save').attr('value', url);
  });

  $(document).on('click', '#btn-save', function (e) {
    $("#modal").modal('hide');
    let url = $('#btn-save').attr('value')
    $.ajax({
      url,
      dataType: 'json',
      type: 'GET',
      success: function (res) {
        if (res.status == 'success') {
          location.reload();
        }
      }
    });
  });

  /**
   * get resource
   */

  $('select#add_content').change(function () {
    let value = $(this).children(":selected").attr("value"),
      url = $(this).attr("data-url"),
      file_url = $(this).attr("data-file-url"),
      ckeditor = $('.description') ? $('.description') : [],
      last_desc = ckeditor ? ckeditor.length + 1 : 1;

    if (value != 'topic' && value != 'description') {
      $.ajax({
        url,
        dataType: 'json',
        method: 'POST',
        data: { data: { type: value } },
        success: function (res) {
          if (res.status == 'success') {
            let options = '';
            res.resources.forEach(ele => {
              options += '<option data-file-id-2="' + ele.file_id_2 + '" data-file-id="' + ele.file_id + '" value="' + ele.id + '">' + ele.title + '</option>'
            });
            let html = `
            <div class="form-row form-document">
              <div class="col-4">
                <div class="form-group">
                <label>`+ value + `</label>
                <select class="form-control add-file" name="documents[][0][]" data-file-url="`+ file_url + `">
                    <option value="">Please select</option>
                    `+ options + `
                </select>
              </div>
              </div>
                <div class="col-7">
                    <div class="form-group show-file row justify-content-end"></div>
                </div>
                <div class="col-1">
                    <div class="form-group text-center">
                        <label>Delete</label>
                        <a class="delete-document" href="javascript:void(0)">
                            <button class="btn btn-outline-secondary" ><span class="fa fa-trash-o f-24"></span></button>
                        </a>
                    </div>
                </div>
            </div>`;
            $('#aditional_sort').append(html);
          }
        }
      });
    } else if (value == 'topic') {
      let topic = `                              
                  <div class="form-row form-document">
                    <div class="col-11">
                        <div class="form-group" id="topic">
                            <input type="hidden" name="exist_topics[]" value="" >
                            <label>Topic<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="documents[][1][]" placeholder="">
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-group text-center">
                            <label>Delete</label>
                            <a class="delete-document" href="javascript:void(0)">
                                <button class="btn btn-outline-secondary"><span class="fa fa-trash-o f-24"></span></button>
                            </a>
                        </div>
                    </div>
                  </div>
                   `;

      $('#aditional_sort').append(topic);
    } else if (value == 'description') {
      let description = `<div class="form-group form-document">
                              <div class="d-flex justify-content-between mb-10 mr-10" >
                                <label for="description`+ last_desc + `">Description</label>
                                <a class="delete-document" href="javascript:void(0)">
                                  <button class="btn btn-outline-secondary"><span class="fa fa-times f-12"></span></button>
                                </a>
                              </div>
                              <textarea class="form-control description" id="description`+ last_desc + `" rows="3" name="documents[][2][]"></textarea>
                          </div>`;

      $('#aditional_sort').append(description);
      CKEDITOR.replace('description' + last_desc + '');
      CKEDITOR.add;
    }
  });

  /**
   * content delete
   */
  $(document).on('click', '.delete-document', function (e) {
    // e.preventDefault();
    $(this).parents('.form-document').remove();
  });

  /**
   * show file
   */
  $(document).on('change', '.add-file', function (e) {
    let id = $(this).children(":selected").attr("data-file-id"),
      id_2 = $(this).children(":selected").attr("data-file-id-2"),
      url = $(this).attr("data-file-url");

    $.ajax({
      url,
      dataType: 'json',
      method: 'POST',
      data: { data: { file_id: id, file_id_2: id_2 } },
      success: (res) => {
        if (res.status == 'success') {
          $(this).parents('.form-row').find('.show-file').html(res.file);
        }
      }
    });
  });
});


/**
 * ckeditor dynamic add in description class
 */
jQuery(function ($) {
  ckeditor = $('.description') ? $('.description') : null;

  for (let i = 1; i <= ckeditor.length; i++) {
    CKEDITOR.replace('description' + i);
  }
});