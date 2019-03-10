<!DOCTYPE html>
<html>
<head>
  <title>Official Receipt</title>
  <style type="text/css">
    .my-table {
       
        width: 100%;
        border-collapse: : collapse;
    }
    table {
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid black;
      text-align: left;
      padding-top: 5px;
      margin-top: 2px;
      font-size: 12.5px;
    }
    .blank_row
    {
        height: 20px !important; /* overwrites any other rules */
    } 
    tr
    {
      height: 20px !important;
    }

  </style>
</head>
<body>
<div style = "width: 35%; display: inline-block; float: left; margin-left: 5px;">
  <br/>
  <br/>
  <br/>
  <table style="width: 90%;">
    <tr>
      <td colspan="3" style = "border: none">
          <b>In settlement of the following</b>
      </td>
    </tr>
    <tr>
      <td style = "width: 60%;"><b>Particulars</b></td>
      <td style = "width: 30%;"><b>Amount</b></td>
      <td style = "width: 10%;"></td>
    </tr>
    <tr>
      <td style = "width: 60%;"><span style = "color: white;">l</td>
      <td style = "width: 30%;"></td>
      <td style = "width: 10%;"></td>
    </tr>
    </tr>
    <tr>
      <td style = "">Vat Zero-Rated Service</td>
      <td style = ""><b></b></td>
      <td style = ""></td>
    </tr>
    <tr>
      <td style = "">Vat Exempt Service</td>
      <td style = ""><b></b></td>
      <td style = ""></td>
    </tr>
    <tr>
      <td style = "">Vatable Service</td>
      <td style = ""><b></b></td>
      <td style = ""></td>
    </tr>
    <tr>
      <td style = "">Value-Added Tax</td>
      <td style = ""><b></b></td>
      <td style = ""></td>
    </tr>
    <tr>
      <td style = "">Gross Due PHP</td>
      <td style = ""><b></b></td>
      <td style = ""></td>
    </tr>
    <tr>
      <td style = "">Gross Due PHP</td>
      <td style = ""><b></b></td>
      <td style = ""></td>
    </tr>
    <tr>
      <td style = "">Withholding Tax</td>
      <td style = ""><b></b></td>
      <td style = ""></td>
    </tr>
    <tr>
      <td style = "">Total Taxes</td>
      <td style = ""><b></b></td>
      <td style = ""></td>
    </tr>
    <tr>
      <td style = "">Total Amount Due</td>
      <td style = ""><b></b></td>
      <td style = ""></td>
    </tr>
    <tr>
      <td colspan="3" style="text-align: center;  >
        FORM OF PAYMENT
      </td>
    </tr>
    <tr>
      <td colspan="3">
        CASH
      </td>
    </tr>
    <tr>
      <td colspan="3">
        CHECK
      </td>
    </tr>

    <tr>
      <td colspan="3">
        BANK
      </td>
    </tr>
    <tr>
      <td colspan="3">
        CHECK NO.
      </td>
    </tr>

    <tr>
      <td colspan="3">
        CHECK DATE
      </td>
    </tr>
    <tr>
      <td colspan="3">
        AMOUNT
      </td>
    </tr>
  </table>

 </div>
 <div style = "width: 65%; display: inline-block; float: right;">
    <div class="row" style="text-align: center;">
          <h3>{{$company->company_name}}</h3>
          {{$company->company_address}}, {{$company->city}}, {{$company->province}} <br>
          Contact no: {{$company->contact_no}} <br>
          VAT Registered TIN: {{$company->companyTIN}} <br>
        </div>
        <div class="row">
          <div class="col-md-6">
            <b><u><h3>Official Receipt</h3></u></b>
          </div>
          <div class="col-md-6" style="text-align: right">
            <b><u><h4>NO. {{$payment_no}}</h4></u></b>
            Date:
          </div>
        </div>
        <div class="row" style="font-family:Arial, Helvetica, sans-serif; font-size: 12.5px;">
          RECEIVED from ____________________________________________ with TIn ___________
          and address at _______________________________________________________ engaged in the business style of __________________________________ the sum of ________________________Pesos ___________________
          in partial/full payment of __________________________________________________
        </div>
        <div class="row" style="margin-top: 30px; font-size: 12.5px;">
          <div style="float: left; display: inline-block;">
            <b>Date Issued:</b> {{$now}} <br>
            <b>Valid From:</b> {{$now}}<br>
            <b>Valid Until:</b> <br>
          </div>
          <div style="float: right; display: inline-block;">
            <b>Software Provider's Name:</b> Earl Dixon Geraldez<br>
            <b>Software Provider's Address:</b> ftygvubhkjnlmjkhg <br>
            <b>Software and System Version:</b> Version 1.0.1
          </div>
        </div>        
      </div>
    </div>
 </div>
 
</body>
</html>