const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

function get_full_date (){
    date_object =  new Date();
    year = date_object.getFullYear();
    month = date_object.getMonth();// + 1 if will be using number
    day = date_object.getDate();
    
    return monthNames[month] + " " + day + ", " + year;
}