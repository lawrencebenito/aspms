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
  var td_pair = '<td style="text-align: center;"><input type="checkbox" class="pair"></td>';
  var td_allowance = '<td><input type="number" class="form-control allowance" name="allowance[]" placeholder="Percentage" required autocomplete="off" value="5" min=1 max=1000></td>';
  var td_price = '<td><input type="number" class="form-control price" name="unit_price[]" placeholder="Enter unit price" required autocomplete="off" min=1 max=10000></td>';
  
  
  //readonly textfields
  var td_fabric_display = '<input type="text" class="form-control fabric_display" value="Click the icon to choose a fabric" autocomplete="off" readonly style="width: 300px">';
  var td_gsm = '<td><input type="number" class="form-control gsm" value="0" autocomplete="off" readonly style="width: 80px"></td>';
  var td_rqkp = '<td><input type="number" class="form-control rqkp" value="0" autocomplete="off" readonly></td>';
  var td_rqkpwa = '<td><input type="number" class="form-control rqkpwa" value="0" autocomplete="off" readonly></td>';
  var td_rqkdz = '<td style="background-color: #fffcd3"><input type="number" class="form-control rqkd" value="0" autocomplete="off" readonly></td>';
  var td_fabric_width = '<td><input type="number" class="form-control fabric_width" value="0" autocomplete="off" readonly></td>';
  var td_rqydz = '<td style="background-color: #fffcd3"><input type="number" class="form-control rqydz" value="0" autocomplete="off" readonly></td>';

  //hidden forms
  var td_fabric = '<input type="hidden" class="fabric_counter form-control fabric" name="fabric[]" required>';

  //button groups (wraps buttons)
  var opt1 = `<td>${btn_row_add_consumption}</td>`;
  var opt2 = `<td>${btn_row_delete}</td>`;
  var opt3 = `<td>${td_fabric_display}${td_fabric}</td>`;
  
  //misc
  var td_space = '<td></td>';
  // var tr_prod_end= '<tr class="prod_end" bgcolor="#f5f5f5"><td colspan="3"></td></tr>';
  


  function initFabricSelect() {
    return {
      placeholder: "Select or search a fabric",
      ajax: {
        method: 'get',
        url: '../get_fabric_list',
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
      ${opt1} ${td_segment} ${opt3} ${btn_fabric} ${td_length} ${td_width} ${td_pair} ${td_gsm} ${td_rqkp} ${td_allowance} ${td_rqkpwa} ${td_rqkdz} ${td_fabric_width} ${td_rqydz}
    </tr>`
  );
  $('tbody#fabric_consumption').append(
    `<tr>
      ${opt2} ${td_segment} ${opt3} ${btn_fabric} ${td_length} ${td_width} ${td_pair} ${td_gsm} ${td_rqkp} ${td_allowance} ${td_rqkpwa} ${td_rqkdz} ${td_fabric_width} ${td_rqydz}
    </tr>`
  );
  $('tbody#fabric_consumption').append(
    `<tr>
      ${opt2} ${td_segment} ${opt3} ${btn_fabric} ${td_length} ${td_width} ${td_pair} ${td_gsm} ${td_rqkp} ${td_allowance} ${td_rqkpwa} ${td_rqkdz} ${td_fabric_width} ${td_rqydz}
    </tr>`
  );
    
  $('.segment.select2').select2(initSegmentSelect());
  $('.fabric.select2').select2(initFabricSelect());
  
  
  //BUTTON ACTION LISTENERS
  $('tbody#fabric_consumption').on('click','.row_add_consumption' ,function () {
    $('tbody#fabric_consumption').append(
      `<tr>
        ${opt2} ${td_segment} ${opt3} ${btn_fabric} ${td_length} ${td_width} ${td_pair} ${td_gsm} ${td_rqkp} ${td_allowance} ${td_rqkpwa} ${td_rqkdz} ${td_fabric_width} ${td_rqydz}
      </tr>`
    );
    $('.segment.select2').select2(initSegmentSelect());
    $('.fabric.select2').select2(initFabricSelect());
  });

  $('tbody#fabric_consumption').on('click','.row_delete', function () {
    $(this).closest('tr').remove();
  });
  
  $('tbody#fabric_consumption').on('click','.row_fabric', function () {
    var row = $(this).parent().parent().parent().children().index($(this).parent().parent());
    $('#modal-fabrics').attr('for-row', row);
  });
  //* ============================================ MODAL SCRIPTS =========================================*//
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
        { title: " "}
    ],
    "fnCreatedRow": function( nRow, aData, iDataIndex ) {
      $(nRow).attr('id', aData['id']);
    },
    "aLengthMenu": [[5, 10, 25],[5, 10, 25]],
    "iDisplayLength": 5,
    "order": [[3,"asc"]],
    "columnDefs": [
      {
        defaultContent: btn_view + btn_edit,
        className: "action-buttons",
        width: "50px",
        sortable: false,
        "targets": -1
      },
      {
        defaultContent: btn_select,
        className: "select-button",
        width: "20px",
        sortable: false,
        "targets": 0
      }
    ]
  } );

  var source_ref_fabrics = "../fabrics/";

  $('#data_table_fabrics').on('click','button.btn_view',function(e){
    href = source_ref_fabrics + $(this).closest('tr').attr('id');
    window.open(href, '_blank');
  });
  
  $('#data_table_fabrics').on('click','button.btn_edit',function(e){
    href =  source_ref_fabrics + $(this).closest('tr').attr('id') + "/edit";
    window.open(href, '_blank');
  });

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
  });

  $('#modal-fabrics').on('hide.bs.modal',function(e){
    dtable_fabrics.search('').columns().search( '' ).draw();
    //$('#modal-fabrics').attr('for-row', -1);
  });
  
}); //end of document.ready