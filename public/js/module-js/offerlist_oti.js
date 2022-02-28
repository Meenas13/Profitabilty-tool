
//Add new row/article to existance table JS
$(document).ready(function () {
  var oldStart = 0;
  var table = $('.final_table').DataTable({
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
  });


  $('.final_table.AddArticle tbody').on('click', 'tr', function () {
    $(this).toggleClass('selected');
  });


  $("#customer-offer").click(function () {
    var cOfferIDs = [];

    // $(".custom-control-input:checked").each(function() {
    //     cOfferIDs.push($(this).val());
    // });

    var ids = $.map(table.rows('.selected').data(), function (item) {
      return item[0];
    });

    cOfferIDs = ids;

    if (cOfferIDs.length > 0) {
      $('#customer-offer').prop('disabled', true);
      var token = $('meta[name="_token"]').attr('content');

      var cust_id = jQuery("#cust_id").val();
      console.log(cust_id);

      var cust_unique = $(".c_unique").val();
      var selected_quarter = $(".selected_quarter").val();

      var selected_artCategory = $(".selected_artCategory").val();
      var selected_channel = $(".selected_channel").val();
      var selected_yearId = $(".selected_yearId").val();
      var selected_monthId = $(".selected_monthId").val();

      $('<form>', {
        "id": "customerOfferFrom",
        "html": '<input type="text" id="cOfferID" name="cOfferID" value="' + cOfferIDs + '" /> <input type="text" id="cust_unique" name="cust_unique" value="' + cust_unique + '" /> <input type="text" id="token" name="_token" value="' + token + '" /> <input type="text" id="cust_id" name="cust_id" value="' + cust_id + '" />  <input type="text" id="sel_quarter" name="sel_quarter" value="' + selected_quarter + '" /> <input type="text" id="sel_quarter" name="sel_quarter" value="' + selected_quarter + '" /><input type="text" id="sel_artCategory" name="sel_artCategory" value="' + selected_artCategory + '" /><input type="text" id="sel_channel" name="sel_channel" value="' + selected_channel + '" /><input type="text" id="sel_yearId" name="sel_yearId" value="' + selected_yearId + '" /><input type="text" id="sel_monthId" name="sel_monthId" value="' + selected_monthId + '" /> ',
        "action": 'customer-offer-data',
        "method": "POST"
      }).appendTo(document.body).submit();

    }

  });

});


// Backcbonus Calculation JS
$(document).ready(function () {

  $('#refresh_bonusTypes').click(function () {
    $('input.amount, input.percent, input.from_amount, input.to_amount ,  input.percentage').val("");

    $(".row_count1 td.type1_bb").find('.amount').prop('disabled', false);
    $(".row_count1 td.type1_bb ").find('.percent').prop('disabled', false);
    $(".row_count1 td.type2_bb").find('.addLevel').prop('disabled', false);

    $(".bb_returns").fadeOut('slow', function () { });

    $('.error').fadeOut("fast", function () { });
    $('.BonusType_error').fadeOut("fast", function () { });

  });

  //insert Ero symbol before amount
  $('input.amount, input.from_amount, input.to_amount ').keyup(function () {
    $(this).val(function (i, v) {
      return '€' + v.replace('€', ''); //remove exisiting, add back.
    });
  });

  //insert % symbol after percent digit
  $('input.percent, input.percentage').keyup(function () {
    $(this).val(function (i, v) {
      return v.replace('%', '') + '%'; //remove exisiting, add back.
    });
  });

  $("#bb_table .row_count1 td.type1_bb .amount,#bb_table .row_count1 td.type1_bb .percent").on('click', function () {
    $(".row_count1 td.type2_bb").find('.addLevel').prop('disabled', true);
  });


  $("#bb_table .row_count1 td.type2_bb .addLevel").click(function () {
    $(".row_count1 td.type1_bb").find('.amount').prop('disabled', true);
    $(".row_count1 td.type1_bb ").find('.percent').prop('disabled', true);
  });


  var countt = 1;

  //calculate Backbonus function 
  function cal_bb() {
    var row = [];
    var customer_unique = [];
    // var bulk = $(".bulk").val();
    // var spirits = $(".spirits").val();
    // var regular = $(".regular").val();
    // var promo = $(".promo").val();
    // var cip = $(".cip").val();
    // var amount = $(".amount").val();
    // var percent = $(".percent").val();
    var from_amount = [];
    var to_amount = [];
    var percentage = [];

    $('.row_count').each(function () {
      row.push($(this).text());
    });

    $('.selected_unique').each(function () {
      customer_unique.push($(this).val());
    });

    $('.from_amount').each(function () {
      from_amount.push($(this).val().replace("€", ""));
    });
    $('.to_amount').each(function () {
      to_amount.push($(this).val().replace("€", ""));
    });

    $('.percentage').each(function () {
      percentage.push($(this).val().replace("%", ""));
    });

    $.ajax({
      url: 'calculate_backBonus',
      // method: "POST",
      type: "GET",
      data: {
        "_token": "{{ csrf_token() }}",
        rows: countt,
        customer_ico: $(".selected_ico").val(),
        // customer_unique: customer_unique,
        customer_unique: $(".c_unique").val(),
        selected_quarter: $(".selected_quarter").val(),
        selected_artCategory: $(".selected_artCategory").val(),
        selected_channel: $(".selected_channel").val(),
        selected_yearId: $(".selected_yearId").val(),
        selected_monthId: $(".selected_monthId").val(),
      },

      success: function (data) {
        var bulk_sales_sum = [];
        var spirit_sales_sum = [];
        var regular_sales_sum = [];
        var promo_sales_sum = [];
        var cip_sales_sum = [];
        var arr_count = "";

        var historical_oti = data.historical_oti[0].total_oti_percentage;

        $(data.data).each(function (key, index) {

          console.log(index);

          ind_count = index.length;
          arr_count = data.data.length;
          console.log(ind_count);

          if ($(".selected_ico").val() != "NULL" && customer_unique == "NULL") {
            $(index).each(function (k, i) {
              if (i.ico == $(".selected_ico").val()) {
                bulk_sales_sum.push(i.bulk_sales);
                spirit_sales_sum.push(i.spirit_sales);
                regular_sales_sum.push(i.regular_sales);
                promo_sales_sum.push(i.promo_sales);
                cip_sales_sum.push(i.cip_sales);
                // historical.push(i.oti_percentage);
              }
            });
          } else if ($(".selected_ico").val() != "NULL" && customer_unique != "NULL") {

            $(index).each(function (k, i) {
              for ($s = 0; $s < (customer_unique).length; $s++) {
                if (i.ico == $(".selected_ico").val() && i.cust_no_unique == customer_unique[$s]) {

                  bulk_sales_sum.push(i.bulk_sales);
                  spirit_sales_sum.push(i.spirit_sales);
                  regular_sales_sum.push(i.regular_sales);
                  promo_sales_sum.push(i.promo_sales);
                  cip_sales_sum.push(i.cip_sales);
                  // historical.push(i.oti_percentage);
                }
              }
            });
          } else if ($(".selected_ico").val() == "NULL" && customer_unique != "NULL") {

            $(index).each(function (k, i) {
              for ($s = 0; $s < (customer_unique).length; $s++) {
                if (i.cust_no_unique == customer_unique[$s]) {
                  bulk_sales_sum.push(i.bulk_sales);
                  spirit_sales_sum.push(i.spirit_sales);
                  regular_sales_sum.push(i.regular_sales);
                  promo_sales_sum.push(i.promo_sales);
                  cip_sales_sum.push(i.cip_sales);
                  // historical.push(i.oti_percentage);
                }
              }
            });
          } else {
            console.log("Else");
            bulk_sales_sum.push(index[0].bulk_sales);
            spirit_sales_sum.push(index[0].spirit_sales);
            regular_sales_sum.push(index[0].regular_sales);
            promo_sales_sum.push(index[0].promo_sales);
            cip_sales_sum.push(index[0].cip_sales);
            // historical.push(index[0].oti_percentage);
          }
          // console.log(ind_count);
        });

        //Calculate Sum of all Sales individually
        var bulk_sum = eval(bulk_sales_sum.join("+"));
        console.log(bulk_sum);
        var spirit_sum = eval(spirit_sales_sum.join("+"));
        var regular_sum = eval(regular_sales_sum.join("+"));
        var promo_sum = eval(promo_sales_sum.join("+"));
        var cip_sum = eval(cip_sales_sum.join("+"));
        // var history_sum = eval(historical.join("+"));

        // var historical_otiSum = history_sum / arr_count;
        // var historical_otiSum = historical;

        //Calculate Limit Base
        var Limit_base = [];
        if ($(".bulk").val() == "limitBase" || $(".bulk").val() == "limitAndBonusBase") {
          Limit_base.push(bulk_sum);
        }
        if ($(".spirits").val() == "limitBase" || $(".spirits").val() == "limitAndBonusBase") {
          Limit_base.push(spirit_sum);
        }
        if ($(".regular").val() == "limitBase" || $(".regular").val() == "limitAndBonusBase") {
          Limit_base.push(regular_sum);
        }
        if ($(".promo").val() == "limitBase" || $(".promo").val() == "limitAndBonusBase") {
          Limit_base.push(promo_sum);
        }
        if ($(".cip").val() == "limitBase" || $(".cip").val() == "limitAndBonusBase") {
          Limit_base.push(cip_sum);
        }

        if (Limit_base.length >= 1) {
          var limit_base_amount = eval(Limit_base.join("+")).toFixed(2);
        } else {
          var limit_base_amount = "0";
        }


        //Calculate Bonus Base
        var bonus_base = [];
        if ($(".bulk").val() == "limitAndBonusBase") {
          bonus_base.push(bulk_sum);
        }
        if ($(".spirits").val() == "limitAndBonusBase") {
          bonus_base.push(spirit_sum);
        }
        if ($(".regular").val() == "limitAndBonusBase") {
          bonus_base.push(regular_sum);
        }
        if ($(".promo").val() == "limitAndBonusBase") {
          bonus_base.push(promo_sum);
        }
        if ($(".cip").val() == "limitAndBonusBase") {
          bonus_base.push(cip_sum);
        }

        if (bonus_base.length >= 1) {
          var bonus_base_amount = eval(bonus_base.join("+")).toFixed(2);
        } else {
          var bonus_base_amount = "0";
        }


        var err_flag = 0;
        //Check if Amount/Percent is added then calculate BackBonus
        var bonus_amount = $(".amount").val().replace("€", "");

        var bonus_percent = $(".percent").val().replace("%", "");
        var back_bonus = "";;
        if (bonus_base_amount && bonus_amount && bonus_percent) {
          console.log(bonus_amount);
          if (parseFloat(bonus_base_amount) > parseFloat(bonus_amount)) {
            err_flag = 2;
            console.log('%' + bonus_percent);
            var back_bonus = parseFloat(bonus_base_amount) * (parseFloat(bonus_percent) / 100);
            back_bonus = parseFloat(back_bonus).toFixed(2);
          } else if (parseFloat(bonus_base_amount) == "0") {
            err_flag = 2;
            back_bonus = "0";
          }
          else {
            err_flag = 1;
            $.alert({
              title: 'Alert',
              content: 'Bonus_From amount (€' + bonus_amount + ') is greater than Bonus_base amount (€' + bonus_base_amount + '), please make sure to enter correct Bonus_From amount.',
              closeIcon: true
            });
            $(".bb_returns").css('display', 'none');
            return false;
          }
        } else if (bonus_base_amount && bonus_amount && !(bonus_percent)) {
          $('<div class="error"> Enter percent(%) </div>').insertAfter(".BonusType_error");
          $(".bb_returns").css('display', 'none');
          return false;
        } else if (bonus_base_amount && !(bonus_amount) && bonus_percent) {
          $('<div class="error"> Enter Amount(€) </div>').insertAfter(".BonusType_error");
          $(".bb_returns").css('display', 'none');
          return false;
        } else if (bonus_base_amount && !(bonus_amount) && !(bonus_percent)) {
          var isDisabled = $('.amount,.percent').prop('disabled');
          if (isDisabled == false) {
            $('<div class="error"> Enter Amount(€) & percent(%) </div>').insertAfter(".BonusType_error");
            $(".bb_returns").css('display', 'none');
            return false;
          }
        }


        //Check if Amount-Levels are added then calculate BackBonus
        if (bonus_base_amount && percentage && from_amount) {

          $(from_amount).each(function (f_key, f_index) {

            if (((f_index && percentage[f_key]) || to_amount[f_key]) || ((f_index && percentage[f_key]) && to_amount[f_key])) {

              if (((bonus_base_amount >= parseFloat(from_amount[f_key])) && (bonus_base_amount < parseFloat(to_amount[f_key]))) || ((bonus_base_amount >= parseFloat(from_amount[f_key])) && (to_amount[f_key] == ""))) {
                err_flag = 2;

                var bb = parseFloat(bonus_base_amount) * (parseFloat(percentage[f_key]) / 100);
                if (bb == "undefined") {
                  back_bonus = "";
                  $.alert({
                    title: 'Error',
                    content: 'Oops !! Something Went wrong',
                    closeIcon: true
                  });
                  return false;
                } else {
                  console.log("bb und Else " + bb);
                  back_bonus = bb.toFixed(2);
                  // return false;
                }
              } else if (parseFloat(bonus_base_amount) == "0") {
                err_flag = 2;
                back_bonus = "0";
              }

              if ((bonus_base_amount >= parseFloat(from_amount[f_key])) && (bonus_base_amount > parseFloat(to_amount[f_key]))) {
                err_flag = 5;
              }

            }
            if (f_index != "" && percentage[f_key] == "") {

              err_flag = 3;
              $('<div class="error"> Enter percentage(%) for from-amount ' + f_index + '</div>').insertAfter(".BonusType_error");
              $(".bb_returns").css('display', 'none');
              return false;
            }
            if (f_index == "" && percentage[f_key] != "") {

              err_flag = 3;
              $('<div class="error"> Enter From amount(€) for ' + percentage[f_key] + ' percentage </div>').insertAfter(".BonusType_error");
              $(".bb_returns").css('display', 'none');
              return false;
            }

          }); //each end

          // if ( (err_flag != 2 && err_flag != 3) || (err_flag != 2) ) {
          if ((err_flag != 1 && err_flag != 2 && err_flag != 3 && err_flag != 5)) {
            console.log("bb Else - False(Show Alert) Flag:" + err_flag);
            err_flag = 4;
            $.alert({
              title: 'Error',
              content: 'Bonus_From amount is greater than Bonus_base amount (€' + bonus_base_amount + '), please make sure to enter correct from-amount',
              closeIcon: true
            });

            $(".bb_returns").css('display', 'none');
            return false;
          } else if (err_flag == 5) {
            $(".bb_returns").css('display', 'none');
            $.alert({
              title: 'Error',
              content: 'Bonus_From and To amount range is not matching for Bonus_Base amount (€' + bonus_base_amount + '), Please make sure to enter correct range',
              closeIcon: true
            });
            return false;

          }

        } else if (bonus_base_amount && from_amount && !(percentage)) {
          $('<div class="error"> Enter percentage(%) </div>').insertAfter(".BonusType_error");
          $(".bb_returns").css('display', 'none');
          return false;
        } else if (bonus_base_amount && !(from_amount) && percentage) {
          $('<div class="error"> Enter From amount(€) </div>').insertAfter(".BonusType_error");
          $(".bb_returns").css('display', 'none');
          return false;
        }


        if (err_flag == 0 || err_flag == 2) {


          function custom_number_format(number_input, decimals, dec_point, thousands_sep) {
            var number = (number_input + '').replace(/[^0-9+\-Ee.]/g, '');
            var finite_number = !isFinite(+number) ? 0 : +number;
            var finite_decimals = !isFinite(+decimals) ? 0 : Math.abs(decimals);
            var seperater = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
            var decimal_pont = (typeof dec_point === 'undefined') ? '.' : dec_point;
            var number_output = '';
            var toFixedFix = function (n, prec) {
              if (('' + n).indexOf('e') === -1) {
                return +(Math.round(n + 'e+' + prec) + 'e-' + prec);
              } else {
                var arr = ('' + n).split('e');
                let sig = '';
                if (+arr[1] + prec > 0) {
                  sig = '+';
                }
                return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec);
              }
            }
            number_output = (finite_decimals ? toFixedFix(finite_number, finite_decimals).toString() : '' + Math.round(finite_number)).split('.');
            if (number_output[0].length > 3) {
              number_output[0] = number_output[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, seperater);
            }
            if ((number_output[1] || '').length < finite_decimals) {
              number_output[1] = number_output[1] || '';
              number_output[1] += new Array(finite_decimals - number_output[1].length + 1).join('0');
            }
            return number_output.join(decimal_pont);
          }



          //Append Result to div 
          $(".bb_returns").show("slide", {
            direction: "left"
          }, 1000);

          $("#backBonus").text(" = € " + custom_number_format(back_bonus));
          $("#backBonus_amt").text(back_bonus);
          $("#limitBase").text(" = € " + custom_number_format(limit_base_amount));
          $("#bonusBase").text(" = € " + custom_number_format(bonus_base_amount));
          $("#historical_oti").text(" = " + parseFloat(historical_oti).toFixed(2) + "%");

          //   $("#calculate_backBonus").prop("disabled", true);
          $("#calculate").prop("disabled", false);

        }

      }

    }); //Ajax end

  } //calculate Backbonus function (cal_bb) end

  //Function to Check for bonus type Amount and Percentage is entered or not 
  function check_inputVal() {
    $('.BonusType_error').fadeOut("fast", function () { });

    //Check if which type (Type 1/Type 2) is entered
    if ($('.amount').val().length > 0) {
      if ($('.percent').val().length > 0) {
        $('.error').fadeOut("fast", function () { });
        $('.BonusType_error').fadeOut("fast", function () { });
        cal_bb();
      } else {
        $('<div class="error"> Enter percent(%) </div>').insertAfter(".BonusType_error");
        $('.percent').prop("required", true);
        $('.BonusType_error').fadeOut("fast", function () { });
      }
    } else {
      if ($('.percent').val().length > 0) {
        $('.BonusType_error').fadeOut("fast", function () { });
        $('<div class="error"> Enter amount(€) </div>').insertAfter(".BonusType_error");
      } else {
        if ($('.from_amount').val().length > 0 && $('.percentage').val().length > 0) {
          $('.error').fadeOut("fast", function () { });
          $('.BonusType_error').fadeOut("fast", function () { });
          cal_bb();
        } else if ($('.to_amount').val().length > 0) {
          $('.BonusType_error').fadeOut("fast", function () { });
          if ($('.from_amount').val().length > 0) {
            $('<div class="error"> Enter percentage (%) </div>').insertAfter(".BonusType_error");
          } else {
            $('<div class="error"> Enter From amount(€) & percentage (%) </div>').insertAfter(".BonusType_error");
          }

        } else if ($('.from_amount').val().length > 0) {
          $('.BonusType_error').fadeOut("fast", function () { });
          $('<div class="error"> Enter percentage (%) </div>').insertAfter(".BonusType_error");
        } else if ($('.percentage').val().length > 0) {
          $('.BonusType_error').fadeOut("fast", function () { });
          $('<div class="error"> Enter From amount(€) </div>').insertAfter(".BonusType_error");
        } else {
          $('.BonusType_error').fadeIn("fast", function () { });
        }

      }
    }
  } //check_inputVal function end


  $("#calculate_backBonus").on('click', function () {
    if ($('.bulk option:selected').val().trim() && $('.spirits option:selected').val().trim() && $('.regular option:selected').val().trim() && $('.promo option:selected').val().trim() && $('.cip option:selected').val().trim()) {
      $('.BonusType_error').fadeOut("fast", function () { });
      check_inputVal();
      $(".bt_error").fadeOut("fast", function () { });
    } else {
      $(".bt_error").fadeIn("slow", function () { });
      return false;
    }
  }); // backbonus onClick end



}); //ready end


//Forcasted OTI Calculation JS
$(document).ready(function () {

  // Calculate Forcasted OTI % 
  $("#calculate").on("click", function () {

    if ($('.collis').length && $('.selling').length) {

      if ($('.collis').val().length <= 0 && $('.selling').val().length <= 0) {
        $.alert({
          title: 'Error',
          content: 'Please enter Colli & Requested Price/MU of an article(s)',
          closeIcon: true
        });
        return false;
      } else if ($('.collis').val().length > 0 && $('.selling').val().length <= 0) {
        $.alert({
          title: 'Error',
          content: 'Please enter Requested Price/MU of an article(s)',
          closeIcon: true
        });
        return false;
      } else if ($('.collis').val().length <= 0 && $('.selling').val().length > 0) {
        $.alert({
          title: 'Error',
          content: 'Please enter Colli of an article(s)',
          closeIcon: true
        });
        return false;
      } else {

        $('#calculate').prop('disabled', true);

        if ($('#backBonus_amt').text()) {
          var backBonus_amount = $('#backBonus_amt').text();
        } else {
          var backBonus_amount = "0";
        }

        var selling = [];
        $(".selling").each(function () {
          selling.push($(this).val());
        });

        var collis = [];
        $(".collis").each(function () {
          collis.push($(this).val());
        });

        var buy_domain_no = [];
        $(".buy_domain_no").each(function () {
          buy_domain_no.push($(this).val());
        });

        var subsys_art_no = [];
        $(".subsys_art_no").each(function () {
          subsys_art_no.push($(this).val());
        });

        var buy_subsys_no = [];
        $(".buy_subsys_no").each(function () {
          buy_subsys_no.push($(this).val());
        });

        var cust_id = jQuery("#cust_id").val();
        var cust_unique = $(".c_unique").val();

        var customer_unique = [];

        $('.selected_unique').each(function () {
          customer_unique.push($(this).val());
        });


        $.ajax({
          // type: "POST",
          url: 'forcasted-cal',
          type: "GET",
          dataType: "json",
          data: {
            '_token': $('meta[name="_token"]').attr('content'),
            'ico': cust_id,
            'cust_unique': cust_unique,
            'selling': selling,
            'colli': collis,
            'buy_domain_no': buy_domain_no,
            'buy_subsys_no': buy_subsys_no,
            'subsys_art_no': subsys_art_no,
            'backBonus_amount': backBonus_amount,

            'customer_ico': $(".selected_ico").val(),
            // 'customer_unique': customer_unique,
            'customer_unique': $(".c_unique").val(),
            'selected_quarter': $(".selected_quarter").val(),
            'selected_artCategory': $(".selected_artCategory").val(),
            'selected_channel': $(".selected_channel").val(),
            'selected_yearId': $(".selected_yearId").val(),
            'selected_monthId': $(".selected_monthId").val(),

          },
          success: function (response) {
            console.log(response);
            console.log(response.last_yearSales);
            var fc = parseFloat(response.forecastedOTI) * 100;

            $('#calculate').prop('disabled', false);
            // if (response == "Less Then Zero") {
            if (fc < 0) {
              $("#forecasted").text(fc.toFixed(2) + '%');
              $("#forecasted").css("color", "red");
            } else {
              $("#forecasted").css("color", "");
              $("#forecasted").text(fc.toFixed(2) + '%');

              // var history_oti = $("#historical_oti").text().replace("%", "");
              var history_oti = response.sales_sum;

              var historical = [];
              var arr_count = "";
              $(history_oti).each(function (key, index) {

                console.log(index);
                arr_count = history_oti.length;

                if ($(".selected_ico").val() != "NULL" && customer_unique == "NULL") {
                  $(index).each(function (k, i) {
                    if (i.ico == $(".selected_ico").val()) {
                      historical.push(i.oti_percentage);
                    }
                  });
                } else if ($(".selected_ico").val() != "NULL" && customer_unique != "NULL") {
                  $(index).each(function (k, i) {
                    for ($s = 0; $s < (customer_unique).length; $s++) {
                      if (i.ico == $(".selected_ico").val() && i.cust_no_unique == customer_unique[$s]) {
                        historical.push(i.oti_percentage);
                      }
                    }
                  });
                } else if ($(".selected_ico").val() == "NULL" && customer_unique != "NULL") {
                  $(index).each(function (k, i) {
                    for ($s = 0; $s < (customer_unique).length; $s++) {
                      if (i.cust_no_unique == customer_unique[$s]) {
                        historical.push(i.oti_percentage);
                      }
                    }
                  });
                } else {
                  historical.push(index[0].oti_percentage);
                }

              });

              //Calculate Sum of all Sales individually
              var history_sum = eval(historical.join("+"));

              var historical_otiSum = (history_sum / arr_count).toFixed(2);
              // console.log("H OTI" + historical_otiSum);

              var last_yearSales_sum = [];

              $(response.last_yearSales).each(function (key, index) {
                last_yearSales_sum.push(index.sales);
              });

              var previous_sales_sum = eval(last_yearSales_sum.join("+"));
              console.log(previous_sales_sum);
              console.log("fc " + fc);
              console.log("history_oti" + historical_otiSum);
              console.log("(fc - history_oti)" + (fc - historical_otiSum));

              //Show alert if Forecasted OTI% - Historical OTI % is greater than 5%
              if (((fc - historical_otiSum) > 5.00)) {
                $.alert({
                  title: 'Alert !!',
                  content: 'Forecasted OTI% - Historical OTI % is greater than 5%',
                  closeIcon: true
                });
              } else if (((fc - historical_otiSum) <= 5.00) && ((fc - historical_otiSum) > -5.00)) {
                console.log("Forecasted OTI% - Historical OTI % is less than 5 and greater than -5");
              } else {
                console.log("Forecasted OTI% - Historical OTI % is less than -5%");
              }

              //Show alert if current sales not greater than 25% than previous year
              if ((((response.colli_sp_sum / previous_sales_sum) - 1) * 100) > 25.00) {
                console.log("Percentage Sales greater than 25%");
              } else {
                $.alert({
                  title: 'Alert !!',
                  content: 'Percentage Sales not increased by 25% compared to previous year',
                  closeIcon: true
                });
              }

              //Show alert if current sales not greater than 20000 Eur than previous year
              if (((response.colli_sp_sum - previous_sales_sum) * 4) > 20000.00) {
                console.log("absolute sales greater than 20000 Eur");
              } else {
                $.alert({
                  title: 'Alert !!',
                  content: 'Absolute Sales not increased by 20000(EUR) compared to previous year',
                  closeIcon: true
                });
              }

              //Show alert if OTI is not incresed
              if ((historical_otiSum / fc) > ((previous_sales_sum / response.colli_sp_sum) * 50 / 100)) {
                console.log("OTI Increase OK");
              } else {
                // $.alert({
                //     title: 'Alert !!',
                //     content: 'OTI not Increase: NOT OK',
                //     closeIcon: true
                // });
                console.log("OTI Not Increase: NOT OK");
                console.log("history_oti / fc: " + historical_otiSum / fc);
              }

            }
          },
          fail: function (response) {

          }
        });
        $('#calculate').prop('disabled', false);
      }

    } else {

      $.alert({
        title: 'Error',
        content: 'No Article is selected to calculate OTI',
        closeIcon: true
      });
      return false;

    }

  }); // Calculate Forcasted OTI % End

});