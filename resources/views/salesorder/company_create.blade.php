@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  <i class="fa fa-shopping-cart"></i> Company Setup
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Company</li>
  </ol>
@endsection

@section('content')
	<div class="container-fulid">
		<div id="maindiv">
			<form id="create_company_form" role="form" method="POST">
				{{csrf_field()}}
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="companyname">Company Name:</label>
							<input type="text" id="companyname"name="companyname" class="form-control">
						</div>
						<div class="row">
							<div class="form-group col-md-8">
								<label for="address">Street Address:</label>
								<input type="text" id="address"name="address" class="form-control">
							</div>
							<div class="form-group col-md-4">
								<label for="city">City:</label>
								<input type="text" id="city"name="city" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="province">Province:</label>
								<input type="text" id="province"name="province" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label for="zip">ZIP Code:</label>
								<input type="number" id="zip"name="zip" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-8">
								<label for="contactno">Contact no:</label>
								<input type="number" id="contactno"name="contactno" class="form-control" min="12">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-8">
								<label for="contactno">Email address:</label>
								<input type="email" id="email"name="email" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-8">
								<label for="tin">Company TIN:</label>
								<input type="text" id="tin"name="tin" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group col-md-4">
						<label class="control-label col-sm-2" for="image">Company logo :</label>
						<div class="col-sm-10" id="postimg-add">
							<input type="file" name="image" class="dropify" data-height="300" data-min-width="400" data-max-width="1000" data-min-height="400" data-max-height="1000" data-default-file=""/>
						</div>
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Save</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('extra_scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$('.dropify').dropify({
		      messages: {
		          'default': 'Drag and drop a file here or click',
		          'replace': 'Drag and drop or click to replace',
		          'remove':  'Remove',
		          'error':   'Ooops, something wrong happended.'
		        }
		    });
		});

		
		$('#create_company_form').on('submit', function(event){
		    event.preventDefault();

		    $.ajax({
		      url : "/Company/save",
		      method : 'POST',
		      data : new FormData(this),
		      dataType: 'JSON',
		      contentType : false,
		      cache : false,
		      processData :false,
		      success : function(data){
		        if(data == 0)
		        {
		        	swal({
					  title: "Success!",
					  text: "New Company has created.",
					  icon: "success",
					  button: 'Ok',
					})
					.then((value) => {
					  if (value) {
					    window.location.reload();
					  } 
					});
		        }
		      }
		    });
		});
	</script>
@endpush