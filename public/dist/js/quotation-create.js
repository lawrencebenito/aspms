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

        $('.prod_start').each(function(){
          $(this).nextUntil('tr.prod_start').fadeOut('slow', function() {
            //console.log(this);
            $(this).remove();
          });
          $(this).fadeOut('slow', function() {
            $(this).remove();
          });
        });

         /*
          * Initial Product
          */

        $('tbody').append(`<tr class="prod_start">${td_product} ${td_price} ${td_space}</tr>`);
        $('tbody').append(`<tr>${td_desc} ${td_space}</tr>`);
        $('tbody').append(`${tr_prod_end}`);  
        $('.product.select2').select2(initProductSelect()).on('select2:select', SelectProduct());
        
      },
      error: function(xhr) {
        alert(xhr.responseText);
      }
    });
  });

  /*
  * THIS SECTION IF FOR MANIPULATING THE TABLE
  */ 
  var td_product = '<td><select class="form-control product select2" name="product[]"style="width: 390px; font-weight: bold;" required></select></td>';
  var td_delete = '<input class="btn btn-danger btn-sm row_delete" type="button" value="-" data-toggle="tooltip" title="Delete this row." />';
  var td_delete_product = '<td><input class="btn btn-danger btn-sm delete_product" type="button" data-toggle="tooltip" title="Delete Product Group" value="-" /></td>';
  var opt1 = `<td>${td_delete}</td>`;
  var td_price = '<td><input type="text" class="form-control price" name="price[]" autocomplete="off" readonly value="Php 0.00"></td>';
  var td_space = '<td></td>';
  var tr_prod_end= '<tr class="prod_end" bgcolor="#f5f5f5"><td colspan="3"></td></tr>';
  var td_desc = '<td colspan="2"><textarea rows="10" class="form-control desc" name="description[]" style="resize:none; display:none; white-space: pre-wrap;" readonly></textarea></td>';

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

  function SelectProduct(){
    return function (event) {
      var product = event.params.data;
      row = $(this).closest('.prod_start');
      
      $.ajax({
        url: "../get_product_info",
        type: "get",
        data: { 
          id: product.id
        },
        dataType: 'json',
        success: function(response) {
          $(row).find('input.price').hide().fadeIn(700).val(response.price);
          $(row).next().find('textarea.desc').fadeIn(700).html(response.product_description);
        },
        error: function(xhr) {
          alert(xhr.responseText + "Error! Please Reselect the Item.");
        }
      });
    }
  }
    
  $('.row_add_product').click(function () {
    $('tbody').append(`<tr class="prod_start">${td_product} ${td_price} ${td_delete_product}</tr>`);
    $('tbody').append(`<tr>${td_desc} ${td_space}</tr>`);
    $('tbody').append(`${tr_prod_end}`);
    $('.product.select2').select2(initProductSelect()).on('select2:select', SelectProduct());
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
      //console.log(this);
      $(this).remove();
    });
    $(row).fadeOut('slow', function() {
      $(row).remove();
    });
  })  
}); //end of document.ready