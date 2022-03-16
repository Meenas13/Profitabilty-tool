$(window).load(function () {
  $('.quater').select2({
    placeholder: "Select Quarter",
    allowClear: true
  });
  $('.customer_unique').select2({
    placeholder: "Select linked customers",
    allowClear: true
  });
  $('.category').select2({
    placeholder: "Select category of an aricle",
    allowClear: true
  });
})


$(document).ready(function () {

  // JS to get all Unique customers on checkbox click - starts
  $('.refresh_unique').click(function () {

    if ($(".refresh_unique").is(":checked")) {
      $("#customer").prop("disabled", true);
      $('#customer').prop('selectedIndex', 0).trigger("change");
      $('#customer').prop("required", false);
      $('#customer_unique').prop("required", true);
      $('#customer_unique').parent().find("span.error").css('display', 'inline-block');
      $('#customer').parent().find("span.error").css('display', 'none');
      $('#customer_unique').prop("multiple", false);

      $.ajax({
        url: 'get_allUniqueCustomer',
        type: "GET",
        dataType: "json",
        success: function (data) {
          console.log(data);
          $('select[name="customer_unique[]"]').empty();
          $('select[name="customer_unique[]"]').append('<option value="">Unique Customers</option>').fadeIn("fast");
          jQuery.each(data, function (key, value) {
            $('select[name="customer_unique[]"]').append('<option value="' + value.cust_no_unique + '">' + value.cust_no_unique + '</option>');
          });

          $(".customer_unique").select2({
            placeholder: {
              id: '-1', // the value of the option
              text: 'Linked Customers'
            }
          });
        }
      }); // Ajax to get all Unique customers End

    } else {
      $('#customer').prop("required", true);
      $("#customer").prop("disabled", false);
      $('#customer_unique').prop("required", false);
      $('#customer').parent().find("span.error").css('display', 'inline-block');
      $('#customer_unique').parent().find("span.error").hide();
      $('#customer_unique').prop("multiple", true);
      $('select[name="customer_unique[]"]').empty();
    }
  }); // JS to get all Unique customers starts


  //If from-year is selected then add required to select To-year field
  $('.show_data').click(function () {
    if ($('.from_year').val().length == "4") {
      $('.to_year').prop("required", true);
    }

    if ($('.from_year ').val() == "" && $('.to_year ').val() == "") {
      //If nothing is added then keep it as it is
    } else {
      if (($('.to_year ').val() - $('.from_year').val()) == 1) {
        $("#year_err").hide();
        return true;
      } else {
        $("#year_err").show();
        return false;
      }
    }
  }); //.show_data click end


  $(function () {
    $(".year_id.from_year").datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      startView: 2,
      defaultViewDate: {
        year: '1950'
      },
      startDate: '-2y', //2022 - 2020
      endDate: '-1y', //2022- 2021
      autoclose: true //to close picker once year is selected
    });

    $(".year_id.to_year").datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      startView: 2,
      defaultViewDate: {
        year: '1950'
      },
      startDate: '-1y', //2022 -2021
      endDate: '-0y', //2022- 2022
      autoclose: true //to close picker once year is selected
    });

  }); // datepicker Js Func end

}); //ready End


$(document).ready(function () {

  // get Linked customers list onChange of Ico no. starts
  $('select[name="customer_ico"]').on('change', function () {
    $(".selected_ico").val(this.value);
    var selected_ico = $(this).val();
    if (selected_ico) {
      $.ajax({
        url: 'get_uniqueCustomer',
        data: {
          selected_ico: selected_ico
        },
        type: "GET",
        dataType: "json",
        success: function (data) {
          $('select[name="customer_unique[]"]').empty();
          jQuery.each(data, function (key, value) {
            $('select[name="customer_unique[]"]').append('<option value="' + value.cust_no_unique + '">' + value.cust_no_unique + '</option>');
          });

          $(".customer_unique").select2({
            placeholder: {
              id: '-1', // the value of the option
              text: 'Linked Customers'
            }
          });
        }
      }); //ajax

    } else {
      $('select[name="customer_unique[]"]').append('<option value="">Linked Customers</option>');
    }
  }) // get Linked customers list onChange of Ico no. end


  var oldStart = 0;
  var table = $('.final_table').DataTable({
    "scrollY": "auto",
    "scrollX": true,
    columnDefs: [{
      orderable: true,
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
    ],
    "bJQueryUI": true,
    "sPaginationType": "full_numbers",
    "fnDrawCallback": function (o) {
      if (o._iDisplayStart != oldStart) {
        var targetOffset = $('.final_table').offset().top;
        $('html,body').animate({ scrollTop: targetOffset }, 500);
        oldStart = o._iDisplayStart;
      }
    }
  }); //datatable end


  //Datatable add class to select Article Row
  $('.final_table tbody').on('click', 'tr', function () {
    $(this).toggleClass('selected');
    $(this).find('td .custom-control-input').toggleClass("selected_box");
  });


  //Go to OfferList Page JS
  $("#customer-offer").click(function () {

    var cOfferID = [];
    var ids = $.map(table.rows('.selected').data(), function (item) {
      return item[0];
    });

    cOfferID += ids;

    // if (cOfferID.length > 0) {
    $('#customer-offer').prop('disabled', true);
    var token = $('meta[name="_token"]').attr('content');
    var cust_id = $(".selected_ico").val();
    var cust_unique = $(".selected_unique").val();
    var selected_quarter = $(".selected_quater").val();
    var selected_artCategory = $(".selected_artCategory").val();
    var selected_channel = $(".selected_channel").val();
    var selected_yearId = $(".selected_yearId").val();
    var selected_monthId = $(".selected_monthId").val();

    $('<form>', {
      "id": "customerOfferFrom",
      "html": '<input type="text" id="cOfferID" name="cOfferID" value="' + cOfferID + '" /><input type="text" id="cust_unique" name="cust_unique" value="' + cust_unique + '" /> <input type="text" id="token" name="_token" value="' + token + '" /><input type="text" id="cust_id" name="cust_id" value="' + cust_id + '" /> <input type="text" id="sel_quarter" name="sel_quarter" value="' + selected_quarter + '" /><input type="text" id="sel_artCategory" name="sel_artCategory" value="' + selected_artCategory + '" /><input type="text" id="sel_channel" name="sel_channel" value="' + selected_channel + '" /><input type="text" id="sel_yearId" name="sel_yearId" value="' + selected_yearId + '" /><input type="text" id="sel_monthId" name="sel_monthId" value="' + selected_monthId + '" /> ',
      "action": "customer-offer-data",
      "method": "POST"
    }).appendTo(document.body).submit();
    //  }
  });


}); //Ready End