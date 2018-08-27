$(document).ready(function(){

  $(".quantity").each(function() {
    value = $(this).html();
    unit_price = $(this).closest('tr').find('.unit_price').html();
    unit_price = parseInt(unit_price);
    total = value * unit_price;

    cell = $(this).closest('tr').find('.price');
    $(cell).html(includeCommas(total)).fadeIn(200);
  });

  var sum = 0;
  // iterate through each td based on class and add the values
  $(".price").each(function() {

    var value = $(this).text();
    value = stripCommas(value);
    value = parseInt(value,10);
    // add only if the value is number
    if(!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
    }
  });
  $('#total_price').val(includeCommas(sum));  

}); //end of document.ready