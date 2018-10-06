$(document).ready(function(){
  
  //Initialize Select2 Elements
  $('#type.select2').select2({
    placeholder: "Select Design Type",
    ajax: {
      method: 'get',
      url: '../list_design_types',
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
  

}); //end of document.ready