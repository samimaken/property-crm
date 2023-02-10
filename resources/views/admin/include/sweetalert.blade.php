
{{-- 

@foreach ($errors->all() as $error)
	<div class="alert alert-danger alert-dismissible">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
	    {{ $error }}
	</div>
@endforeach --}}

@if (Session::has('success'))

<script>
	swal({
		  title: "Good job!",
		  text: "{!! Session::get('success') !!}",
		  icon: "success",
		  button: "Ok",
		});
</script>
@endif

@if (Session::has('error'))
	<script>
	swal({
		  title: "Oooops!",
		  text: "{!! Session::get('error') !!}",
		  icon: "error",
		  button: "Ok",
		});
</script>
@endif

@if (count($errors->all())>0)
	<script>
	swal({
		  title: "Oooops!",
		  text: "{{ $errors->all()[0] }}",
		  icon: "error",
		  button: "Ok",
		});
</script>
@endif