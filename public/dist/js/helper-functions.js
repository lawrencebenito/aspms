const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

function get_full_date(){
  date_object =  new Date();
  year = date_object.getFullYear();
  month = date_object.getMonth();// + 1 if will be using number
  day = date_object.getDate();
  
  return { 
    text:  monthNames[month] + " " + day + ", " + year,
    numeric: `${year}-${month + 1}-${day}`
  }
}

function get_mysql_date(mysql_string){ 
  var t, result = null;

   if( typeof mysql_string === 'string' )
   {
      t = mysql_string.split(/[- :]/);

      //when t[3], t[4] and t[5] are missing they defaults to zero
      result = new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);          
   }

   return result;   
}

function parse_date(mysql_date){
  date_object = get_mysql_date(mysql_date);
  year = date_object.getFullYear();
  month = date_object.getMonth();// + 1 if will be using number
  day = date_object.getDate();
  
  return { 
    text:  monthNames[month] + " " + day + ", " + year,
    numeric: `${year}-${month + 1}-${day}`
  }
}

function validate(form) {
  valid = true;
  // validation code here ...
    
  if(!valid) {
    alert('Please correct the errors in the form!');
    return false;
  }
  else {
    return confirm('Do you really want to submit the form?');
  }
}

function set_select_value(selector, text, id){
  // Fetch the preselected item, and add to the control
  var Select = $(selector).closest('select');
  
  // create the option and append to Select2
  var option = new Option(text, id, true, true);
  Select.append(option).trigger('change');

  // manually trigger the `select2:select` event
  Select.trigger({
    type: 'select2:select',
    params: {
      data: { id:id }      
    }
  });
}

const includeCommas = (value) => {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
const stripCommas = (value) => {
  return value.replace(/\,/g,'');
}

var btn_view = "<button class='btn btn-xs btn_view' data-toggle='tooltip' title='View'><i class='fa fa-eye'></i></button> ";
var btn_edit = "<button class='btn btn-xs btn_edit' data-toggle='tooltip' title='Edit'><i class='fa fa-edit'></i></button> ";
var btn_delete = "<button class='btn btn-xs btn_delete' data-toggle='tooltip' title='Delete'><i class='fa fa-trash-o'></i></button> ";
var btn_order = "<button class='btn btn-xs btn_order' data-toggle='tooltip' title='Order'><i class='fa fa-shopping-cart'></i></button> ";

$(document).ready(function(){
  
  // disable mousewheel on a input number field when in focus
  $('form').on('focus', 'input[type=number]', function (e) {
    $(this).on('mousewheel.disableScroll', function (e) {
      e.preventDefault()
    })
  })

  // (to prevent Cromium browsers change the value when scrolling)
  $('form').on('blur', 'input[type=number]', function (e) {
    $(this).off('mousewheel.disableScroll')
  })

  // animation for the alert
  $('.alert').slideDown(700).delay(5000).slideUp(700);
});//end of document.ready