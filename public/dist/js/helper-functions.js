const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

function get_full_date (){
  date_object =  new Date();
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