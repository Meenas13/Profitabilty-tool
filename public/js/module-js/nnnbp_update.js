$(document).ready(function () {
  var table = $('.nnnbp_table').DataTable({
    "scrollY": "auto",
    "scrollX": true,
    // "ordering": false,
    columnDefs: [{
      orderable: true,
      // className: 'reorder',
      targets: 1
    },
    {
      orderable: false,
      targets: '_all'
    }
    ],
    "lengthMenu": [
      [50, 150, 200, -1],
      [50, 150, 200, "All"]
    ]
  }); //nnnbp Datatable end


  //get nnnbp_src as per DB and show them as a toggled ON
  if ($(".nnnbp_columns").hasClass("selected_nnnbp")) {
    $(".nnnbp_columns.selected_nnnbp").find("input:checkbox").prop("checked", true);
  }

  //Change NNNBP-Source JS
  $rows_count = 1;
  $("#nnnbp_table tbody tr").each(function (key, value) {
    key = key + 1;
    var make_key = "table_rowCnt" + key;

    if ($("#nnnbp_table tbody tr").hasClass(make_key)) {

      $("." + make_key + " .nnnbp_columns .switch input:checkbox").on('click', function () {

        if ($("." + make_key + " .nnnbp_columns").hasClass("selected_nnnbp")) {
          $("." + make_key + " .nnnbp_columns").removeClass("selected_nnnbp");
          $("." + make_key + " .nnnbp_columns .slider").addClass("not_selected");
        } else {
          $("." + make_key + " .nnnbp_src").text("");
        }

        //    $("." + make_key + " .nnnbp_columns .switch input:checkbox").change(function() {
        if ($("." + make_key + " .nnnbp_columns .switch input:checkbox").is(":checked")) {
          $(this).parent().parent().addClass("selected_nnnbp");
          $(this).parent().find(".slider").removeClass("not_selected");
          $(this).parent().parent().find("input:checkbox").prop("checked", true);

          var get_attrId = $(this).parent().parent().attr("id");
          $("." + make_key + " .nnnbp_src").text(get_attrId);

          var buy_domain_no = $("." + make_key + " .buy_domain_no ").text();

          $.ajax({

            method: "POST",
            url: "update_nnnbpSrc",
            dataType: "json",
            data: {
              '_token': $('meta[name="_token"]').attr('content'),
              'selected_src': get_attrId,
              'buy_domain_no': buy_domain_no,
            },
            success: function (response) {

              $(response).each(function (k, i) {
                $.alert({
                  title: 'Great..!!',
                  content: 'Source Updated',
                  closeIcon: true
                });
                return false;
              });

            },
            fail: function (response) {
              $.alert({
                title: 'ohh..',
                content: 'Source could not updated',
                closeIcon: true
              });
            }
          }); //Ajax end

        } else {
          $(this).parent().parent().removeClass("selected_nnnbp");
          $(this).parent().parent().find("input:checkbox").prop("checked", false);
          $("." + make_key + " .nnnbp_columns .slider").addClass("not_selected");

        }
        //   }); //OnChangeinput-checkbox end

      }); //OnClick input-checkbox end

    }

  }); // table each row end

}); //Ready end
