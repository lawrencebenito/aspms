$(document).ready(function(){
  
  //Date picker - use this code for jquery date picker
  // $('#datepicker').datepicker({
  //   autoclose: true
  // });

  //Initialize Today's date
  var date = get_full_date();
  $('#date').text(date.text);
  $('#date_form').val(date.numeric);

  function calculateSum() {

    var sum = 0;
    // iterate through each td based on class and add the values
    $(".price").each(function() {

      var value = $(this).text();
      value = stripCommas(value);
      value = parseFloat(value,10);
      // add only if the value is number
      if(!isNaN(value) && value.length != 0) {
          sum += parseFloat(value);
      }
    });
    $('#total_price').val(includeCommas(sum));    
  };

  $('table').on('keyup','.quantity', function(){
    value = $(this).val();

    unit_price = $(this).closest('tr').find('.unit_price').html();
    unit_price = parseFloat(unit_price.substring(4));
    total = value * unit_price;

    cell = $(this).closest('tr').find('.price');
    $(cell).html(includeCommas(total)).fadeIn(200);
    calculateSum();
  });

  $('table').on('click','.row_add' ,function () {
    clicked_tr = $(this).closest('tr');
    rows = clicked_tr.clone();
    $(rows).insertAfter(clicked_tr).hide().fadeIn(700);

    if(!$(clicked_tr).next().find('.row_delete').length){
      $(clicked_tr).next().find('.row_add').after(' <input class="btn btn-danger btn-xs row_delete" type="button" value="-" data-toggle="tooltip" title="Delete this row" />');
    }
    calculateSum();
  });

  $('table').on('click','.row_delete' ,function () {
    $(this).closest('tr').remove();
    calculateSum();
  });
  
  

}); //end of document.ready