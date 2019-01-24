$(document).ready(function(){
  
  //Initialize Today's date
  var date = get_full_date();
  $('#date').html(date.text);
  $('#date_created').val(date.numeric);
  
  //Initialize Select2 Elements
  $('#client.select2').select2({
    placeholder: "Select Client",
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
  
  $('#garment.select2').select2({
    placeholder: "Select Garment",
    ajax: {
      method: 'get',
      url: '../get_garment_list',
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
  * THIS SECTION IF FOR MANIPULATING THE TABLE
  */ 
  //selects
  var td_segment = '<td><select class="form-control segment select2" name="segment[]" style="width: 150px; font-weight: bold;" required></select></td>';
  
  //buttons
  var btn_fabric = '<td><button type="button" class="btn btn-success row_fabric" data-toggle="modal" data-target="#modal-fabrics"><i class="ion ion-tshirt"></i></button></td>';
  var td_delete_product = '<td><input class="btn btn-danger btn-sm delete_product" type="button" data-toggle="tooltip" title="Delete Product Group" value="-" /></td>';
  var btn_row_delete = '<input class="btn btn-danger btn-sm row_delete" type="button" value="-" data-toggle="tooltip" title="Delete this row." />';
  var btn_row_add_consumption = '<input class="btn btn-success btn-sm row_add_consumption" type="button" value="+" data-toggle="tooltip" title="Add row below.">';

  //input elements
  var td_length = '<td><input type="number" class="form-control length" name="length[]" placeholder="Length" required autocomplete="off" min=1 max=1000></td>';
  var td_width = '<td><input type="number" class="form-control width" name="width[]" placeholder="Width" required autocomplete="off" min=1 max=1000></td>';
  var td_pair = '<td style="text-align: center;"><input type="checkbox" class="pair"> <input type="hidden" class="is_pair" name="pair[]" value="0"></td>';
  var td_allowance = '<td><input type="number" class="form-control allowance" name="allowance[]" placeholder="Percentage" required autocomplete="off" value="5" min=1 max=100></td>';

  //readonly textfields
  var td_fabric_display = '<input type="text" class="form-control fabric_display" value="Click the icon to choose a fabric" readonly style="width: 300px">';
  var td_gsm = '<td><input type="number" class="form-control gsm" value="0" readonly style="width: 80px"></td>';
  var td_rqkp = '<td><input type="number" class="form-control rqkp" value="0" readonly></td>';
  var td_rqkpwa = '<td><input type="number" class="form-control rqkpwa" value="0" readonly></td>';
  var td_rqkdz = '<td style="background-color: #fffcd3"><input type="number" class="form-control rqkdz" value="0" readonly></td>';
  var td_fabric_width = '<td><input type="number" class="form-control fabric_width" value="0" readonly></td>';
  var td_rqydz = '<td style="background-color: #fffcd3"><input type="number" class="form-control rqydz" value="0" readonly></td>';
  var td_fabric_price = '<td><input type="number" class="form-control fabric_price" value="0" readonly></td>';
  var td_fabric_price_type_display = '<input type="text" class="form-control fabric_price_type_display" readonly>';
  var td_consum_cost = '<td style="background-color: #fffcd3"><input type="number" class="form-control consum_cost" value="0" readonly></td>';
  
  //hidden forms
  var td_fabric_price_type = '<input type="hidden" class="form-control fabric_price_type" readonly>';
  var td_fabric = '<input type="hidden" class="fabric_counter form-control fabric" name="fabric[]" required>';

  //button groups (wraps buttons)
  var opt1 = `<td>${btn_row_add_consumption}</td>`;
  var opt2 = `<td>${btn_row_delete}</td>`;
  var opt3 = `<td>${td_fabric_display}${td_fabric}</td>`;
  var opt4 = `<td>${td_fabric_price_type_display} ${td_fabric_price_type}</td>`;

  function initSegmentSelect() {
    return {
      placeholder: "Select Segment",
      ajax: {
        method: 'get',
        url: '../list_segments',
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
  * Initial Rows
  */
  $('tbody#fabric_consumption').append(
    `<tr>
      ${opt1} ${td_segment} ${opt3} ${btn_fabric} ${td_length} ${td_width} ${td_pair} ${td_gsm} ${td_rqkp} ${td_allowance} ${td_rqkpwa} ${td_rqkdz} ${td_fabric_width} ${td_rqydz} ${td_fabric_price} ${opt4} ${td_consum_cost}
    </tr>`
  );
  $('tbody#fabric_consumption').append(
    `<tr>
      ${opt2} ${td_segment} ${opt3} ${btn_fabric} ${td_length} ${td_width} ${td_pair} ${td_gsm} ${td_rqkp} ${td_allowance} ${td_rqkpwa} ${td_rqkdz} ${td_fabric_width} ${td_rqydz} ${td_fabric_price} ${opt4} ${td_consum_cost}
    </tr>`
  );
  $('tbody#fabric_consumption').append(
    `<tr>
      ${opt2} ${td_segment} ${opt3} ${btn_fabric} ${td_length} ${td_width} ${td_pair} ${td_gsm} ${td_rqkp} ${td_allowance} ${td_rqkpwa} ${td_rqkdz} ${td_fabric_width} ${td_rqydz} ${td_fabric_price} ${opt4} ${td_consum_cost}
    </tr>`
  );
    
  $('.segment.select2').select2(initSegmentSelect());
  
  
  //BUTTON ACTION LISTENERS
  $('tbody#fabric_consumption').on('click','.row_add_consumption' ,function () {
    $('tbody#fabric_consumption').append(
      `<tr>
        ${opt2} ${td_segment} ${opt3} ${btn_fabric} ${td_length} ${td_width} ${td_pair} ${td_gsm} ${td_rqkp} ${td_allowance} ${td_rqkpwa} ${td_rqkdz} ${td_fabric_width} ${td_rqydz} ${td_fabric_price} ${opt4} ${td_consum_cost}
      </tr>`
    );
    $('.segment.select2').select2(initSegmentSelect());
  });

  $('tbody#fabric_consumption').on('click','.row_delete', function () {
    $(this).closest('tr').remove();
  });
  
  $('tbody#fabric_consumption').on('click','.row_fabric', function () {
    var row = $(this).parent().parent().parent().children().index($(this).parent().parent());
    $('#modal-fabrics').attr('for-row', row);
  });

  //* ============================================ MODAL SCRIPTS =========================================*//
  
  var btn_select = `<button type="button" class="btn btn-xs btn-primary btn_select" data-dismiss="modal">Select</button>`;
  var btn_view = `<button type="button" class='btn btn-xs btn_view'><i class='fa fa-eye'></i></button>`;
  var btn_edit = `<button type="button" class='btn btn-xs btn_edit'><i class='fa fa-pencil'></i></button>`;

  /**
  * For Fabric Consumption
  */
  var dtable_fabrics = $('#data_table_fabrics').DataTable( {
    "ajax": {
      "url": "../list_fabrics",
      "dataSrc": ""
    },
    columns: [
        { title: "Choose one"}, 
        { title: "Color", data:"color" }, 
        { title: "Pattern", data:"pattern_name" },
        { title: "Type", data:"type_name" },
        { title: "Supplier", data:"supplier_name" },
        { title: "Ref #", data:"reference_num" },
        { title: "GSM", data:"gsm" },
        { title: "Width", data:"width" },
        { title: "Price Date", data:"date_effective" },
        { title: "Price", data:"unit_price" }
    ],
    "fnCreatedRow": function( nRow, aData, iDataIndex ) {
      $(nRow).attr('id', aData['id']);
    },
    "aLengthMenu": [[5, 10, 25],[5, 10, 25]],
    "iDisplayLength": 5,
    "order": [[3,"asc"]],
    "columnDefs": [
      {
        defaultContent: btn_select,
        width: "20px",
        sortable: false,
        "targets": 0
      }
    ]
  } );

  $('#data_table_fabrics').on('click','button.btn_select',function(e){
    $('#modal-fabrics').modal('hide');
    var row_index = $('#modal-fabrics').attr('for-row');
    var modal_data = dtable_fabrics.row($(this).closest('tr')).data();

    var display_fabric_text = `${modal_data.color} ${modal_data.pattern_name} ${modal_data.type_name} (${modal_data.reference_num})`;

    var row = $('#fabric_consumption tr').eq(row_index);
    $(row).find('td input.fabric_display').val(display_fabric_text);
    $(row).find('td input.fabric').val(modal_data.id);
    $(row).find('td input.gsm').val(modal_data.gsm);
    $(row).find('td input.fabric_width').val(modal_data.width);
    $(row).find('td input.fabric_price').val(modal_data.unit_price);
    $(row).find('td input.fabric_price_type').val(modal_data.measurement_type);

    if(modal_data.measurement_type == '0'){
      $(row).find('td input.fabric_price_type_display').val('per kgs');
    }else{
      $(row).find('td input.fabric_price_type_display').val('per yards');
    }

  });

  $('#modal-fabrics').on('hide.bs.modal',function(e){
    dtable_fabrics.search('').columns().search( '' ).draw();
    //$('#modal-fabrics').attr('for-row', -1);
  });

  //* ============================================ COMPUTATION SCRIPTS =========================================*//

  $('tbody#fabric_consumption').on('keyup','input', function(){
    row = $(this).closest('tr');
    compute(row);
  });

  $('tbody#fabric_consumption').on('change','.pair', function(){
    row = $(this).closest('tr');
    compute(row);
    if($(this).is(':checked')) {
      row.find('.is_pair').val("1");
    } else {
      row.find('.is_pair').val("0");
    }
  });

  function compute(row){
    length = row.find('.length').val();
    width = row.find('.width').val();
    is_pair = row.find('.pair').prop("checked");
    allowance = row.find('.allowance').val() / 100;
    gsm = row.find('.gsm').val();
    fabric_width = row.find('.fabric_width').val();
    fabric_price = row.find('.fabric_price').val();
    
    rqkp = ( length * width * (is_pair? 2 : 1) ) * gsm / 10000000;
    row.find('.rqkp').val(rqkp.toFixed(4));
    
    rqkpwa = (rqkp * allowance) + rqkp;
    row.find('.rqkpwa').val(rqkpwa.toFixed(4));
    
    rqkdz = rqkpwa * 12;
    row.find('.rqkdz').val(rqkdz.toFixed(4));
    
    rqydz = rqkdz / (fabric_width * gsm / 1550 / 1000) / 36;
    row.find('.rqydz').val(rqydz.toFixed(4));

    fabric_price_type = row.find('.fabric_price_type').val();

    if(fabric_price_type == 0){
      value = fabric_price * row.find('.rqkdz').val();
      
      row.find('.consum_cost').val(value.toFixed(2));

    }else if(fabric_price_type == 1){
      value = fabric_price * row.find('.rqydz').val();
      
      row.find('.consum_cost').val(value.toFixed(2));
    }

    calculateTotalKgSum();
    calculateTotalYdsSum();
    calculateTotalConsumptionCost();

  }

  function calculateTotalKgSum() {

    var sum = 0;
    // iterate through each td based on class and add the values
    $("#fabric_consumption tr td input.rqkdz").each(function() {

      var value = $(this).val();
      // add only if the value is number
      if(!isNaN(value) && value.length != 0) {
          sum += parseFloat(value);
      }
    });
    
    $('#total_kg_dz').val(sum.toFixed(4));    
  };

  function calculateTotalYdsSum(){

    var sum = 0;
    // iterate through each td based on class and add the values
    $("#fabric_consumption tr td input.rqydz").each(function() {

      var value = $(this).val();
      // add only if the value is number
      if(!isNaN(value) && value.length != 0) {
          sum += parseFloat(value);
      }
    });
    
    $('#total_yd_dz').val(sum.toFixed(4));    
  };

  function calculateTotalConsumptionCost(){

    var sum = 0;
    // iterate through each td based on class and add the values
    $("#fabric_consumption tr td input.consum_cost").each(function() {

      var value = $(this).val();
      // add only if the value is number
      if(!isNaN(value) && value.length != 0) {
          sum += parseFloat(value);
      }
    });
    
    $('#total_consum_cost').val(sum.toFixed(2));
    $('#total_consum_cost_per_piece').val((sum.toFixed(2)/12).toFixed(2));

    computeFinal();
  };

  $('#markup').on('keyup','input', function(){
    computeFinal();
  });

}); //end of document.ready

/**
 * This function must be outside the document.ready to be called by other external js files
 */
function computeFinal(){
  $('#final_fabric').val( $('#total_consum_cost_per_piece').val());
  $('#final_accessory').val( $('#total_acc_pc').val() );
  $('#final_design').val( $('#total_design_pc').val() );
  $('#final_operation').val( $('#total_operation_cost').val());
  
  
  val1 = parseFloat($('#final_fabric').val());
  val2 = parseFloat($('#final_accessory').val());
  val3 = parseFloat($('#final_design').val());
  val4 = parseFloat($('#final_operation').val());

  
  /* parseFloat is needed to make sure the variable don't treat val() as strings */
  total = parseFloat(val1 + val2 + val3 + val4);
  
  $('#final_product').val(total.toFixed(2));

  markup = total * ($('#markup').val() / 100);
  total_with_markup = (total + markup);
  // console.log("total: " +  total);
  // console.log("markup: " + markup);
  // console.log("with markup: " + total_with_markup);
  
  $('#final_cost').val(total_with_markup.toFixed(2));

}