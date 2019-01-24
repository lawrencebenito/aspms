$(document).ready(function(){
  
  function initOperationSelect() {
    return {
      placeholder: "Select Operation",
      ajax: {
        method: 'get',
        url: '../list_operations',
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
  * THIS SECTION IF FOR MANIPULATING THE TABLE
  */ 
 var td_operation = '<td><select class="form-control operation select2" name="operation[]" style="width: 350px; font-weight: bold;" required></select></td>';

  //buttons
  var btn_row_delete = '<input class="btn btn-danger btn-sm row_delete" type="button" value="-" data-toggle="tooltip" title="Delete this row." />';
  var btn_row_add_operation = '<input class="btn btn-success btn-sm row_add_operation" type="button" value="+" data-toggle="tooltip" title="Add row below.">';

  //input elements
  var td_rate = '<td><input type="number" class="form-control rate" name="rate[]" placeholder="Rate" required autocomplete="off" step="any" max=20></td>';

  //readonly textfields
  var td_operation_display = '<input type="text" class="form-control operation_display" value="Click the icon to choose a operation" readonly style="width: 300px">';
  var td_measurement_type_display = '<input type="text" class="form-control measurement_type_display" readonly>';
  
  //hidden forms
  var td_measurement_type = '<input type="hidden" class="form-control measurement_type" readonly>';
  //var td_operation = '<input type="hidden" class="form-control operation" name="operation[]" required>';

  //button groups (wraps buttons)
  var opt1 = `<td>${btn_row_add_operation}</td>`;
  var opt2 = `<td>${btn_row_delete}</td>`;

  /*
  * Initial Rows
  */
  var first_line = 
    `<tr>
      ${opt1} ${td_operation} ${td_rate}
    </tr>`
  
  var dynamic_line =
    `<tr>
      ${opt2} ${td_operation} ${td_rate}
    </tr>`

  $('tbody#table_operation').append(first_line);
  $('tbody#table_operation').append(dynamic_line);
  $('tbody#table_operation').append(dynamic_line);

  $('.operation.select2').select2(initOperationSelect());
    
  //BUTTON ACTION LISTENERS
  $('tbody#table_operation').on('click','.row_add_operation' ,function () {
    $('tbody#table_operation').append(dynamic_line);
    $('.operation.select2').select2(initOperationSelect());
  });

  $('tbody#table_operation').on('click','.row_delete', function () {
    $(this).closest('tr').remove();
  });
  
  $('tbody#table_operation').on('click','.row_operation', function () {
    var row = $(this).parent().parent().parent().children().index($(this).parent().parent());
    $('#modal-operation').attr('for-row', row);
  });

  //* ============================================ MODAL SCRIPTS =========================================*//
  
  var btn_select = `<button type="button" class="btn btn-xs btn-primary btn_select" data-dismiss="modal">Select</button>`;

  /**
  * For Tbody operation
  */
  var dtable_operation = $('#data_table_operation').DataTable( {
    "ajax": {
      "url": "../list_operation",
      "dataSrc": ""
    },
    columns: [
        { title: "Choose one"}, 
        { title: "Color", data:"color" }, 
        { title: "Type", data:"type_name" },
        { title: "Description", data:"description" }, 
        { title: "Supplier", data:"supplier" },
        { title: "Ref #", data:"reference_num" },
        { title: "Price Date", data:"date_effective" },
        { title: "Price", data:"unit_price" }
    ],
    "fnCreatedRow": function( nRow, aData, iDataIndex ) {
      $(nRow).attr('id', aData['id']);
    },
    "aLengthMenu": [[5, 10, 25],[5, 10, 25]],
    "iDisplayLength": 5,
    "order": [[2,"asc"]],
    "columnDefs": [
      {
        defaultContent: "N/A",
        "targets": 3
      },
      {
        defaultContent: btn_select,
        width: "20px",
        sortable: false,
        "targets": 0
      }
    ]
  } );

  $('#data_table_operation').on('click','button.btn_select',function(e){
    $('#modal-operation').modal('hide');
    var row_index = $('#modal-operation').attr('for-row');
    var modal_data = dtable_operation.row($(this).closest('tr')).data();

    var display_operation_text = `${modal_data.color} ${modal_data.type_name} - ${modal_data.reference_num}`;

    var row = $('#table_operation tr').eq(row_index);
    $(row).find('td input.operation_display').val(display_operation_text);
    $(row).find('td input.operation_price').val(modal_data.unit_price);

    if(modal_data.measurement_type == '0'){
      $(row).find('td input.quantity_unit').val('yard/s');
      $(row).find('td input.measurement_type_display').val('per yard');
    
    }else{
      $(row).find('td input.quantity_unit').val('pc/pcs');
      $(row).find('td input.measurement_type_display').val('per piece');
    
    }
  });

  $('#modal-operation').on('hide.bs.modal',function(e){
    dtable_operation.search('').columns().search( '' ).draw();
  });

  //* ============================================ COMPUTATION SCRIPTS =========================================*//

  $('tbody#table_operation').on('keyup','input', function(){
    row = $(this).closest('tr');
    calculateTotalOperationCost();
  });

  
  function calculateTotalOperationCost() {

    var sum = 0;
    // iterate through each td based on class and add the values
    $("#table_operation tr td input.rate").each(function() {

      var value = $(this).val();
      // add only if the value is number
      if(!isNaN(value) && value.length != 0) {
          sum += parseFloat(value);
      }
    });
    
    $('#total_operation_cost').val(sum.toFixed(2));
    
    computeFinal();
  };

}); //end of document.ready