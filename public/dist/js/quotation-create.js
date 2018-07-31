$(document).ready(function(){
  
  //Initialize Today's date
  $('#date').text(get_full_date());
  
  //Initialize Select2 Elements
  $('#client.select2').select2({
    placeholder: "Search a client",
    ajax: {
      method: 'get',
      url: './get_client_list',
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
      url: "./get_client_info",
      type: "get",
      data: { 
        id: client.id
      },
      dataType: 'json',
      success: function(response) {
        $('#help').hide();
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
        alert(xhr);
      }
    });
  });

  /*
  * THIS SECTION IF FOR MANIPULATING THE TABLE
  */ 
  var td_garment = '<td><select class="form-control garment select2" name="garment[]"style="width: 450px; font-weight: bold;" required></select></td>';
  var td_fabric = '<td><select class="form-control fabric select2" name="fabric[]" style="width: 450px" required></select></td>';
  var td_delete = '<input class="btn btn-danger btn-sm row_delete" type="button" value="-" data-toggle="tooltip" title="Delete this row." />';
  var td_delete_product = '<td><input class="btn btn-danger btn-sm delete_product" type="button" data-toggle="tooltip" title="Delete Product Group" value="-" /></td>';
  var td_add_fabric = '<input class="btn btn-success btn-sm row_add_fabric" type="button" value="+" data-toggle="tooltip" title="Add fabric row.">';
  var opt1 = `<td>${td_delete}</td>`;
  var opt2 = `<td>${td_add_fabric} ${td_delete}</td>`;
  var opt3 = `<td>${td_add_fabric}</td>`;
  var td_price = '<td><input type="number" class="form-control price" placeholder="Enter unit price" name="price[]" required autocomplete="off" min=1 max=10000></td>';
  var td_space = '<td></td>';
  var tr_prod_end= '<tr class="prod_end" bgcolor="#f5f5f5"><td colspan="3"></td></tr>';
  var td_fabric_counter = '<td><input type="hidden" class="fabric_counter form-control" name="fabric_count[]" value="1"></td>';
  //<input type="hidden" id="custId" name="custId" value="3487">
  var td_desc = '<td colspan="2"><textarea rows="3" class="form-control" name="description[]" placeholder="(Optional) Enter product description here" maxlength="200" style="resize:none;"></textarea></td>';
  
  function initFabricSelect() {
    return {
      placeholder: "Select or search a garment",
      ajax: {
        method: 'get',
        url: './get_fabric_list',
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

  function initGarmentSelect() {
    return {
      placeholder: "Select or search a fabric",
      ajax: {
        method: 'get',
        url: './get_garment_list',
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
  $('tbody').append(`<tr class="prod_start">${td_garment} ${td_fabric_counter} ${td_space}</tr>`);
  $('tbody').append(`<tr>${td_fabric} ${td_price} ${opt3}</tr>`);
  $('tbody').append(`<tr>${td_desc} ${td_space}</tr>`);
  $('tbody').append(`${tr_prod_end}`);
  
  $('.fabric.select2').select2(initFabricSelect());
  $('.garment.select2').select2(initGarmentSelect());
  
  
  $('.row_add_product').click(function () {
    $('tbody').append(`<tr class="prod_start">${td_garment} ${td_fabric_counter} ${td_delete_product}</tr>`);
    $('tbody').append(`<tr>${td_fabric} ${td_price} ${opt3}</tr>`);
    $('tbody').append(`<tr>${td_desc} ${td_space}</tr>`);
    $('tbody').append(`${tr_prod_end}`);
    $('.fabric.select2').select2(initFabricSelect());
    $('.garment.select2').select2(initGarmentSelect());
  });

  $('tbody').on('click','.row_add_fabric' ,function () {
    fabric_row = $(this).parent().parent();
    $(`<tr>${td_fabric} ${td_price} ${opt2}</tr>`).insertAfter(fabric_row);
    
    $('.fabric.select2').select2(initFabricSelect());
    
    fabric_counter = $(this).closest('tr').prevAll('.prod_start:first').find('.fabric_counter');
    $(fabric_counter).val(parseInt($(fabric_counter).val()) + 1);
  });

  $('.row_add_desc').click(function () {
    $('tbody').append(`<tr>${td_desc} ${opt1}</tr>`);
  });

  $('tbody').on('click','.row_delete', function () {
    fabric_counter = $(this).closest('tr').prevAll('.prod_start:first').find('.fabric_counter');
    $(fabric_counter).val(parseInt($(fabric_counter).val()) - 1);

    $(this).closest('tr').remove();
  });

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