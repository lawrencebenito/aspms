$(document).ready(function(){
  
   /*
  * THIS SECTION IF FOR MANIPULATING THE TABLE
  */ 
  
  //buttons
  var btn_accessory = '<td><button type="button" class="btn btn-success row_accessory" data-toggle="modal" data-target="#modal-accessories"><i class="ion ion-ios-pricetags"></i></button></td>';
  var btn_row_delete = '<input class="btn btn-danger btn-sm row_delete" type="button" value="-" data-toggle="tooltip" title="Delete this row." />';
  var btn_row_add_accessory = '<input class="btn btn-success btn-sm row_add_accessory" type="button" value="+" data-toggle="tooltip" title="Add row below.">';

  //input elements
  var td_quantity = '<td><input type="number" class="form-control quantity" name="quantity[]" placeholder="Quantity" autocomplete="off" min=1 max=100></td>';

  //readonly textfields
  var td_accessory_display = '<input type="text" class="form-control accessory_display" value="Click the icon to choose a accessory" readonly style="width: 300px">';
  var td_accessory_price = '<td><input type="number" class="form-control accessory_price" value="0" readonly></td>';
  var td_quantity_unit = '<td><input type="text" class="form-control quantity_unit" readonly></td>';
  var td_measurement_type_display = '<input type="text" class="form-control measurement_type_display" readonly>';
  var td_cost_per_piece = '<td style="background-color: #fffcd3"><input type="number" class="form-control cost" value="0" readonly></td>';
  
  //hidden forms
  var td_measurement_type = '<input type="hidden" class="form-control measurement_type" readonly>';
  var td_accessory = '<input type="hidden" class="form-control accessory" name="accessory[]">';

  //button groups (wraps buttons)
  var opt1 = `<td>${btn_row_add_accessory}</td>`;
  var opt2 = `<td>${btn_row_delete}</td>`;
  var opt3 = `<td>${td_accessory_display} ${td_accessory}</td>`;
  var opt4 = `<td>${td_measurement_type_display} ${td_measurement_type}</td>`;

  /*
  * Initial Rows
  */
  var first_line = 
    `<tr>
      ${opt1} ${opt3} ${btn_accessory} ${td_quantity} ${td_quantity_unit} ${td_accessory_price} ${opt4} ${td_cost_per_piece}
    </tr>`
  
  var dynamic_line =
    `<tr>
      ${opt2} ${opt3} ${btn_accessory} ${td_quantity} ${td_quantity_unit} ${td_accessory_price} ${opt4} ${td_cost_per_piece}
    </tr>`

  $('tbody#table_accessories').append(first_line);
  $('tbody#table_accessories').append(dynamic_line);
  $('tbody#table_accessories').append(dynamic_line);
    
  //BUTTON ACTION LISTENERS
  $('tbody#table_accessories').on('click','.row_add_accessory' ,function () {
    $('tbody#table_accessories').append(dynamic_line);
  });

  $('tbody#table_accessories').on('click','.row_delete', function () {
    $(this).closest('tr').remove();
  });
  
  $('tbody#table_accessories').on('click','.row_accessory', function () {
    var row = $(this).parent().parent().parent().children().index($(this).parent().parent());
    $('#modal-accessories').attr('for-row', row);
  });

  //* ============================================ MODAL SCRIPTS =========================================*//
  
  var btn_select = `<button type="button" class="btn btn-xs btn-primary btn_select" data-dismiss="modal">Select</button>`;

  /**
  * For Tbody Accessories
  */
  var dtable_accessories = $('#data_table_accessories').DataTable( {
    "ajax": {
      "url": "../list_accessories",
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

  $('#data_table_accessories').on('click','button.btn_select',function(e){
    $('#modal-accessories').modal('hide');
    var row_index = $('#modal-accessories').attr('for-row');
    var modal_data = dtable_accessories.row($(this).closest('tr')).data();

    var display_accessory_text = `${modal_data.color} ${modal_data.type_name} - ${modal_data.reference_num}`;

    var row = $('#table_accessories tr').eq(row_index);
    $(row).find('td input.accessory').val(modal_data.id);
    $(row).find('td input.accessory_display').val(display_accessory_text);
    $(row).find('td input.accessory_price').val(modal_data.unit_price);

    if(modal_data.measurement_type == '0'){
      $(row).find('td input.quantity_unit').val('yard/s');
      $(row).find('td input.measurement_type_display').val('per yard');
    
    }else{
      $(row).find('td input.quantity_unit').val('pc/pcs');
      $(row).find('td input.measurement_type_display').val('per piece');
    
    }
  });

  $('#modal-accessories').on('hide.bs.modal',function(e){
    dtable_accessories.search('').columns().search( '' ).draw();
  });

  //* ============================================ COMPUTATION SCRIPTS =========================================*//

  $('tbody#table_accessories').on('keyup','input', function(){
    row = $(this).closest('tr');
    accessories_compute(row);
  });

  function accessories_compute(row){
    quantity= row.find('.quantity').val();
    price = row.find('.accessory_price').val();
    
    result = (quantity * price).toFixed(2);

    row.find('.cost').val(result);

    calculateTotalAccCost();

  }

  function calculateTotalAccCost() {

    var sum = 0;
    // iterate through each td based on class and add the values
    $("#table_accessories tr td input.cost").each(function() {

      var value = $(this).val();
      // add only if the value is number
      if(!isNaN(value) && value.length != 0) {
          sum += parseFloat(value);
      }
    });
    
    $('#total_acc_pc').val(sum.toFixed(2));
    $('#total_acc_dz').val((sum.toFixed(2)*12).toFixed(2));
    computeFinal();
  };

}); //end of document.ready