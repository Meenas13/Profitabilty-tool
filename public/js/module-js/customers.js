$(window).load(function () {
  $('#customer').select2({
    placeholder: "Select Customer",
    allowClear: true
  });
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

  if (sessionStorage.getItem("Page2Visited")) {
    sessionStorage.removeItem("Page2Visited");
    window.location.reload(true); // force refresh page1
}

  // JS to get all Unique customers on checkbox click - starts
  $('.refresh_unique').click(function () {

    // $("#loader").show();

    if ($(".refresh_unique").is(":checked")) {
      $("#loader").show();
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
          $("#loader").hide();
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
      $("#loader").hide();
      $('#customer').prop("required", true);
      $("#customer").prop("disabled", false);
      $('#customer_unique').prop("required", false);
      $('#customer').parent().find("span.error").css('display', 'inline-block');
      $('#customer_unique').parent().find("span.error").hide();
      $('#customer_unique').prop("multiple", true);
      $('select[name="customer_unique[]"]').empty();
    }
  }); // JS to get all Unique customers starts


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
    $("#loader").show();

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
          $("#loader").hide();
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
      $("#loader").hide();
      $('select[name="customer_unique[]"]').append('<option value="">Linked Customers</option>');
    }
  }) // get Linked customers list onChange of Ico no. end

  var cOfferID = [];
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
    processing: true,
    serverSide: true,
    'searching': false,
    "lengthChange": false,
    "info": false,
    "ordering": false,
    "paging": true,
    language: {
      processing: ''
    },
    scroller: {
      loadingIndicator: false
    },
    ajax: {
      url: 'get-all-domainlist',
      type: "get",
      data: function (data) {
        data.filterByKeyword = $("#customer-form").serializeArray().reduce((o, kv) => ({ ...o, [kv.name]: kv.value }), {});
        data.filterByKeyword.customer_unique = $('#customer_unique').val();
        data.filterByKeyword.customer_ico = $('#customer').val();
        data.filterByKeyword.quater = $('#quater').val();
        data.filterByKeyword.channel = $('#channel').val();
        data.filterByKeyword.month_id = $('.month_id').val();
        data.filterByKeyword.from_year = $('.from_year').val();
        data.filterByKeyword.to_year = $('.to_year').val();
        data.filterByKeyword.category = $('.category').val();
        var info = $('.final_table').DataTable().page.info();
        data.page = info.page + 1;
        $(".loader").show();
      }
    },
    columns: [
      { data: "buy_subsys_no", "visible": false },
      { data: "buy_domain" },
      { data: "subsys_art_no" },
      { data: "subsys_art_name" },
      { data: "status_article" },
      { data: "qtymonths" },
      { data: "sales" },
      { data: "colli" },
      { data: "noofinvoice" },
      { data: "sales_per_month" },
      { data: "colli_per_month" },
      { data: "invoices_per_month" }
    ],
    'createdRow': function (row, data, dataIndex) {
      if (typeof cOfferID !== 'undefined' && cOfferID.length > 0) {
        $.each(cOfferID, function (index, val) {
          if (data.buy_subsys_no === val) {
            $(row).addClass('selected');
          }
        });
      }
    },
    "fnDrawCallback": function (response) {

      var catSaleShare = response.json.catSaleShare;
      var salesOti = response.json.salesOti;
      if (typeof catSaleShare !== 'undefined' && catSaleShare !== null) {
        $("#catSaleShareTBody").empty();
        $("#catSaleShareTBody").append(catSaleShare);
      }
      if (typeof salesOti !== 'undefined' && salesOti !== null) {
        $("#salesOtiTBody").empty();
        $("#salesOtiTBody").append(salesOti);
      }
      if (response._iDisplayStart != oldStart) {
        var targetOffset = $('.final_table').offset().top;
        $('html,body').animate({ scrollTop: targetOffset }, 500);
        oldStart = response._iDisplayStart;
      }
      $(".loader").hide();
    },
    "error": function (xhr, error, thrown) {

    }
  }); //datatable end
  // $.fn.dataTable.ext.errMode = 'none';
  $('.final_table').on('error.dt', function (e, settings, techNote, message) {
    $(".loader").hide();
  })

  $("#customer-button").click(function (e) {
    e.preventDefault();
    if ($('.from_year').val().length == "4") {
      $('.to_year').prop("required", true);
    }
    if ($('.from_year ').val() == "" && $('.to_year ').val() == "") {
      //If nothing is added then keep it as it is
    } else {
      if (($('.to_year ').val() - $('.from_year').val()) == 1) {
        $("#year_err").hide();
        //return true;
      } else {
        $("#year_err").show();
        return false;
      }
    }
    if (!$('#customer').val() && !$('#customer_unique').val()) {
      alert('Please select cutomer ico or linked customer ');
      return false;
    }
    cOfferID = [];
    table.draw();
  });


  //Datatable add class to select Article Row
  $('.final_table tbody').on('click', 'tr', function () {
    $(this).toggleClass('selected');
    $(this).find('td .custom-control-input').toggleClass("selected_box");

    var trData = $('.final_table').DataTable().row(this).data();
    if ($(this).hasClass("selected")) {
      cOfferID.push(trData['buy_subsys_no']);
    } else {
      cOfferID.splice($.inArray(trData['buy_subsys_no'], cOfferID), 1);
    }
  });


  //Go to OfferList Page JS
  $("#customer-offer").click(function () {

    // if (cOfferID.length > 0) {
    $(".loader").show();
    $('#customer-offer').prop('disabled', true);
    var token = $('meta[name="_token"]').attr('content');
    var cust_id = $(".selected_ico").val() || $('#customer').val();
    var cust_unique = $(".selected_unique").val() || $('#customer_unique').val();
    var selected_quarter = $(".selected_quater").val() || $('#quater').val();
    var selected_artCategory = $(".selected_artCategory").val() || $('.category').val();
    var selected_channel = $(".selected_channel").val() || $('#channel').val();
    var selected_yearId =  '' +$('.from_year').val()+$('.to_year').val() || $(".selected_yearId").val() ;
    var selected_monthId = $(".selected_monthId").val() || $('.month_id').val();

    $('<form>', {
      "id": "customerOfferFrom",
      "html": '<input type="text" id="cOfferID" name="cOfferID" value="' + cOfferID + '" /><input type="text" id="cust_unique" name="cust_unique" value="' + cust_unique + '" /> <input type="text" id="token" name="_token" value="' + token + '" /><input type="text" id="cust_id" name="cust_id" value="' + cust_id + '" /> <input type="text" id="sel_quarter" name="sel_quarter" value="' + selected_quarter + '" /><input type="text" id="sel_artCategory" name="sel_artCategory" value="' + selected_artCategory + '" /><input type="text" id="sel_channel" name="sel_channel" value="' + selected_channel + '" /><input type="text" id="sel_yearId" name="sel_yearId" value="' + selected_yearId + '" /><input type="text" id="sel_monthId" name="sel_monthId" value="' + selected_monthId + '" /> ',
      "action": "customer-offer-data",
      "method": "POST"
    }).appendTo(document.body).submit();

    //}

  });


}); //Ready End