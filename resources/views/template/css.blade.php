<!-- Simple bar CSS -->
<link rel="stylesheet" href="{{asset('public/template/light/css/simplebar.css')}}">
<!-- Fonts CSS -->
<link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!-- Icons CSS -->
<link rel="stylesheet" href="{{asset('public/template/light/css/feather.css')}}">
<link rel="stylesheet" href="{{asset('public/template/light/css/select2.css')}}">
<link rel="stylesheet" href="{{asset('public/template/light/css/dropzone.css')}}">
<link rel="stylesheet" href="{{asset('public/template/light/css/uppy.min.css')}}">
<link rel="stylesheet" href="{{asset('public/template/light/css/jquery.steps.css')}}">
<link rel="stylesheet" href="{{asset('public/template/light/css/jquery.timepicker.css')}}">
<link rel="stylesheet" href="{{asset('public/template/light/css/quill.snow.css')}}">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{asset('public/template/light/css/daterangepicker.css')}}">
<!-- App CSS -->
<link rel="stylesheet" href="{{asset('public/template/light/css/app-light.css')}}" id="lightTheme">
<link rel="stylesheet" href="{{asset('public/template/light/css/app-dark.css')}}" id="darkTheme" disabled>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('public/template/css/summernote-audio.css')}}">
    <link rel="stylesheet" href="{{asset('public/template/light/css/dataTables.bootstrap4.css')}}">


<style type="text/css">
	.mt--2{
		display: block;
		margin-top: -20px !important;
	}
	.icon-big i{
		font-size: 40px;
	}
	.card-stats i:hover{
		cursor: pointer;
	}
	.card-stats a:hover{
		text-decoration: none;
	}
	.card-stats:hover{
		margin-top: -4px;
	}
	
</style>
@yield('css')