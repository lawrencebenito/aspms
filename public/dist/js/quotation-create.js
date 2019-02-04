$(document).ready(function(){
  
  //Initialize Today's date
  var date = get_full_date();
  $('#date').text(date.text);
  $('#date_form').val(date.numeric);
  
  //Initialize Select2 Elements
  $('#client.select2').select2({
    placeholder: "Search a client",
    ajax: {
      method: 'get',
      url: '../get_client_list',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: data
        };
      }
    }
  });

  /*
  * THIS SECTION RUNS WHEN THE USER SELECTED AN ITEM -> FOR CLIENT
  */ 

  $('#client').on("select2:select", function(e) { 
    var client = e.params.data;
    //console.log(client.id +" "+ client.text);

    $.ajax({
      url: "../get_client_info",
      type: "get",
      data: { 
        id: client.id
      },
      dataType: 'json',
      success: function(response) {
        $('#company_group').hide();
        $('#address_group').hide();
        
        if(response[0].company_name){
          $('#company_name').text(response[0].company_name);
          $('#company_group').fadeIn(700);
        }

        $('#address').text(response[0].address);
        $('#address_group').fadeIn(700);
      },
      error: function(xhr) {
        alert(xhr.responseText);
      }
    });
  });

  /*
  * THIS SECTION IF FOR MANIPULATING THE TABLE
  */ 
  var td_product = '<td><select class="form-control product select2" name="product[]"style="width: 450px; font-weight: bold;" required></select></td>';
   var td_delete = '<input class="btn btn-danger btn-sm row_delete" type="button" value="-" data-toggle="tooltip" title="Delete this row." />';
  var td_delete_product = '<td><input class="btn btn-danger btn-sm delete_product" type="button" data-toggle="tooltip" title="Delete Product Group" value="-" /></td>';
  var opt1 = `<td>${td_delete}</td>`;
  var td_price = '<td><input type="number" class="form-control price" placeholder="Enter unit price" name="unit_price[]" required autocomplete="off" min=1 max=10000></td>';
  var td_space = '<td></td>';
  var tr_prod_end= '<tr class="prod_end" bgcolor="#f5f5f5"><td colspan="3"></td></tr>';
  var td_desc = '<td colspan="2"><textarea rows="3" class="form-control" name="description[]" placeholder="(Optional) Enter product description here" maxlength="200" style="resize:none;"></textarea></td>';

  function initProductSelect() {
    return {
      placeholder: "Select a product for this client",
      ajax: {
        method: 'get',
        url: '../list_products?id='+document.getElementById("client").value,
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results: data
          };
        }
      }
    }//end of return
  }//end of function

  /*
  * Initial Product
  */
  $('tbody').append(`<tr class="prod_start">${td_product} ${td_price} ${td_space}</tr>`);
  $('tbody').append(`<tr>${td_desc} ${td_space}</tr>`);
  $('tbody').append(`${tr_prod_end}`);
  
  $('.product.select2').select2(initProductSelect());
  
  $('.row_add_product').click(function () {
    $('tbody').append(`<tr class="prod_start">${td_product} ${td_price} ${td_delete_product}</tr>`);
    $('tbody').append(`<tr>${td_desc} ${td_space}</tr>`);
    $('tbody').append(`${tr_prod_end}`);
    $('.product.select2').select2(initProductSelect());
  });

  $('.row_add_desc').click(function () {
    $('tbody').append(`<tr>${td_desc} ${opt1}</tr>`);
  });
  
  $('#client').on('change', function(){
    $('.product.select2').select2(initProductSelect());
  })

  $('tbody').on('click','.delete_product', function () {
    row = $(this).closest('.prod_start');
    
    $(row).nextUntil('tr.prod_start').fadeOut('slow', function() {
      console.log(this);
      $(this).remove();
    });
    $(row).fadeOut('slow', function() {
      $(row).remove();
    });
  })


}); //end of document.ready