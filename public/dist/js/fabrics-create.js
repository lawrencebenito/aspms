$(document).ready(function(){
  
  //Initialize Select2 Elements
  $('#type.select2').select2({
    placeholder: "Select Fabric Type",
    ajax: {
      method: 'get',
      url: '../get_fabric_type_list',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: data
        };
      }
    }
  });

  $('#type').on("select2:select", function(e) { 
    var type = e.params.data;
    $('#type_name').val(type.text);
  });
  
  $('#pattern.select2').select2({
    placeholder: "Select Fabric Pattern",
    ajax: {
      method: 'get',
      url: '../get_fabric_pattern_list',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: data
        };
      }
    }
  });

  $('#pattern').on("select2:select", function(e) { 
    var pattern = e.params.data;
    $('#pattern_name').val(pattern.text);
  });
  
  var date = get_full_date();
  $('#display_date').val(date.text);
  $('#date_effective').val(date.numeric);
  

}); //end of document.ready