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
      url: '../../get_client_list',
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
      url: '../../get_client_info',
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
  * THIS SECTION INITIALIZE THE CLIENT INFORMATION
  */
  var quotation = JSON.parse($('#quotation').val());
  var client_id = quotation.client;
  var full_name = quotation.full_name;
  var client_select = '#client';

  set_select_value(client_select,full_name,client_id);

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
  var td_price = '<td><input type="number" class="form-control price" placeholder="Enter unit price" name="unit_price[]" required autocomplete="off" min=1 max=10000></td>';
  var td_space = '<td></td>';
  var tr_prod_end= '<tr class="prod_end" bgcolor="#f5f5f5"><td colspan="3"></td></tr>';
  var td_fabric_counter = '<td><input type="hidden" class="fabric_counter form-control" name="fabric_count[]" value="1"></td>';
  var td_desc = '<td colspan="2"><textarea rows="3" class="form-control" name="description[]" placeholder="(Optional) Enter product description here" maxlength="200" style="resize:none;"></textarea></td>';
  
  function initFabricSelect() {
    return {
      placeholder: "Select or search a fabric",
      ajax: {
        method: 'get',
        url: '../../get_fabric_list',
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
      placeholder: "Select or search a garment",
      ajax: {
        method: 'get',
        url: '../../get_garment_list',
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
  var products = JSON.parse($('#products').val());
  var length = products.length;
  
  var first_fabric = true;
  for (index = 0; index < length; ++index) {
    
    //GARMENT
    if(index == 0 || (index > 0 && products[index].garment != products[index-1].garment)){
      is_delete = (index == 0)? td_space : td_delete_product ;
      
      $('tbody').append(`
        <tr class="prod_start">
          '<td><select class="form-control garment select2" id="garment${products[index].garment_id}" name="garment[]" style="width: 450px" required></select></td>'
          ${td_fabric_counter}
          ${is_delete}
        </tr>
      `);
      
      $('.garment.select2').select2(initGarmentSelect());
      set_select_value("#garment"+products[index].garment_id, products[index].garment, products[index].garment_id);
      first_fabric = true;
    }
    
    //FABRIC
    if(first_fabric){ opt_fabric = opt3; first_fabric=false; }else{opt_fabric = opt2;} 
    $('tbody').append(`
      <tr>
        '<td><select class="form-control fabric select2" id="fabric${products[index].fabric_id}" 
          name="fabric[]" style="width: 450px" value="${products[index].fabric}" required></select></td>'
        '<td><input type="number" class="form-control price" placeholder="Enter unit price"
          name="unit_price[]" value="${products[index].unit_price}" required min=1 max=10000></td>'
        ${opt_fabric}
      </tr>
    `);
    
    $('.fabric.select2').select2(initFabricSelect());
    set_select_value("#fabric"+products[index].fabric_id, products[index].fabric, products[index].fabric_id);

    //DESCRIPTION
    if(index == length-1 || (index < length-1 && products[index].garment != products[index+1].garment)){
      if(products[index].description){
        $('tbody').append(`
          <tr>
            '<td colspan="2"><textarea rows="3" class="form-control" name="description[]" 
                placeholder="(Optional) Enter product description here" 
                maxlength="200" style="resize:none;">${products[index].description}
                </textarea></td>' 
            ${td_space}
          </tr>
        `);
      }else{
        $('tbody').append(`<tr>${td_desc} ${td_space}</tr>`);
      }

      $('tbody').append(`${tr_prod_end}`);
    }

  }
   
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
      //console.log(this);
      $(this).remove();
    });
    $(row).fadeOut('slow', function() {
      $(row).remove();
    });
  })


}); //end of document.ready