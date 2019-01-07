$(document).ready(function(){
  
  /*
  * THIS SECTION IF FOR MANIPULATING THE TABLE
  */ 
  
  //buttons
  var btn_design = '<td><button type="button" class="btn btn-success row_design" data-toggle="modal" data-target="#modal-design"><i class="ion ion-android-star"></i></button></td>';
  var btn_upload = '<td><button type="button" class="btn btn-success">Select Image</button></td>';
  var btn_row_delete = '<input class="btn btn-danger btn-sm row_delete" type="button" value="-" data-toggle="tooltip" title="Delete this row." />';
  var btn_row_add_design = '<input class="btn btn-success btn-sm row_add_design" type="button" value="+" data-toggle="tooltip" title="Add row below.">';

  //input elements
  var td_quantity = '<td><input type="number" class="form-control quantity" name="quantity[]" placeholder="Quantity" required autocomplete="off" min=1 max=100></td>';

  //readonly textfields
  var td_design_display = '<input type="text" class="form-control design_display" value="Click the icon to choose a design" readonly style="width: 300px">';
  var td_design_price = '<td><input type="number" class="form-control design_price" value="0" readonly></td>';
  var td_quantity_unit = '<td><input type="text" class="form-control quantity_unit" readonly></td>';
  var td_measurement_type_display = '<input type="text" class="form-control measurement_type_display" readonly>';
  var td_cost_per_piece = '<td style="background-color: #fffcd3"><input type="number" class="form-control cost" value="0" readonly></td>';
  
  //hidden forms
  var td_measurement_type = '<input type="hidden" class="form-control measurement_type" readonly>';
  var td_design = '<input type="hidden" class="form-control design" name="design[]" required>';

  //button groups (wraps buttons)
  var opt1 = `<td>${btn_row_add_design}</td>`;
  var opt2 = `<td>${btn_row_delete}</td>`;
  var opt3 = `<td>${td_design_display} ${td_design}</td>`;
  var opt4 = `<td>${td_measurement_type_display} ${td_measurement_type}</td>`;

  /*
  * Initial Rows
  */
  var first_line = 
    `<tr>
      ${opt1} ${opt3} ${btn_design} ${btn_upload} ${td_cost_per_piece}
    </tr>`
  
  var dynamic_line =
    `<tr>
      ${opt2} ${opt3} ${btn_design} ${btn_upload} ${td_cost_per_piece}
    </tr>`

  $('tbody#table_design').append(first_line);
  $('tbody#table_design').append(dynamic_line);
  $('tbody#table_design').append(dynamic_line);
    
  //BUTTON ACTION LISTENERS
  $('tbody#table_design').on('click','.row_add_design' ,function () {
    $('tbody#table_design').append(dynamic_line);
  });

  $('tbody#table_design').on('click','.row_delete', function () {
    $(this).closest('tr').remove();
  });
  
  $('tbody#table_design').on('click','.row_design', function () {
    var row = $(this).parent().parent().parent().children().index($(this).parent().parent());
    $('#modal-accessories').attr('for-row', row);
  });

  //* ============================================ MODAL SCRIPTS =========================================*//
  
  var btn_select = `<button type="button" class="btn btn-xs btn-primary btn_select" data-dismiss="modal">Select</button>`;

  /**
  * For Tbody Accessories
  */
  var dtable_design = $('#data_table_design').DataTable( {
    "ajax": {
      "url": "../list_designs",
      "dataSrc": ""
    },
    columns: [
        { title: "Choose one"},
        { title: "Type", data:"type_name" }, 
        { title: "Supplier", data:"supplier" },
        { 
          title: "Size", data:"category_size",
          render: function(data){
            if(data === 0){
              return "Small"
            }else if(data === 1){
              return "Medium"
            }else if(data === 2){
              return "Large"
            }else{
              return "Error. Check index.blade.php"
            }
          }
        },
        { title: "Size Range", data:"size_range" },
        { title: "Color Count", data:"color_count" },
        { title: "Price", data: "unit_price"}
    ],
    "fnCreatedRow": function( nRow, aData, iDataIndex ) {
      $(nRow).attr('id', aData['id']);
    },
    "aLengthMenu": [[5, 10, 25],[5, 10, 25]],
    "iDisplayLength": 5,
    "order": [[2,"asc"]],
    "columnDefs": [
      {
        defaultContent: btn_select,
        width: "20px",
        sortable: false,
        "targets": 0
      }
    ]
  } );

  $('#data_table_design').on('click','button.btn_select',function(e){
    $('#modal-accessories').modal('hide');
    var row_index = $('#modal-accessories').attr('for-row');
    var modal_data = dtable_design.row($(this).closest('tr')).data();

    var display_design_text = `${modal_data.type_name} from ${modal_data.supplier}`;

    var row = $('#table_design tr').eq(row_index);
    $(row).find('td input.design_display').val(display_design_text);
    $(row).find('td input.cost').val(modal_data.unit_price);
    
    
    calculateTotalDesignCost();
  });

  $('#modal-accessories').on('hide.bs.modal',function(e){
    dtable_design.search('').columns().search( '' ).draw();
  });

  //* ============================================ COMPUTATION SCRIPTS =========================================*//

  function calculateTotalDesignCost() {

    var sum = 0;
    // iterate through each td based on class and add the values
    $("#table_design tr td input.cost").each(function() {

      var value = $(this).val();
      // add only if the value is number
      if(!isNaN(value) && value.length != 0) {
          sum += parseFloat(value);
      }
    });
    
    $('#total_design_pc').val(sum.toFixed(2));
    $('#total_design_dz').val((sum.toFixed(2)*12).toFixed(2));
    
    computeFinal();
    
  };

}); //end of document.ready