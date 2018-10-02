$(document).ready(function(){
  
  //Initialize Select2 Elements
  $('#type.select2').select2({
    placeholder: "Select Accessories Type",
    ajax: {
      method: 'get',
      url: '../get_accessory_type_list',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: data
        };
      }
    }
  });
  
  var date = get_full_date();
  $('#display_date').val(date.text);
  $('#date_effective').val(date.numeric);

  $('#measurement_type').on("change", function(e) { 
    //per roll
    if(this.value == 0){

      $('#price').val('');
      $('#quantity').val('');
      $('#quantity').removeAttr('readonly');
      $('#display_quantity').val('yards');
      $('#unit_price').val('');
      $('#display_unit_price').val('per yard');
    
    //per gross
    }else if(this.value == 1){

      $('#price').val('');
      $('#quantity').val('144');
      $('#quantity').attr('readonly','readonly');
      $('#display_quantity').val('pieces');
      $('#unit_price').val('');
      $('#display_unit_price').val('per piece');

    //per piece
    }else if(this.value == 2){

      $('#price').val('');
      $('#quantity').val('1');
      $('#display_quantity').val('piece');
      $('#unit_price').val('');
      $('#display_unit_price').val('per piece');
    }
  });

  $('#quantity').on('keyup', function(){
    if($(this).val() && $('#price').val()){
      quantity = $(this).val();
      price = $('#price').val();
      compute(quantity,price);
    }else{
      $('#unit_price').val('');
    }
  });

  $('#price').on('keyup', function(){
    if($(this).val() && $('#quantity').val()){
      price = $(this).val();
      quantity = $('#quantity').val();
      compute(quantity,price);
    }else{
      $('#unit_price').val('');
    }
  });

  function compute(quantity, price){
    computed = (parseFloat(price)/parseInt(quantity)).toFixed(2);
    $('#unit_price').val(includeCommas(computed));
  }

}); //end of document.ready