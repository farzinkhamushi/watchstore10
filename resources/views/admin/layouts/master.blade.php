<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{config('app.name','watchstore10')}}</title>
	<link rel="shortcut icon" href="{{url('panel/assets/media/image/favicon.png')}}">
	<meta name="theme-color" content="#5867dd">
	<link rel="stylesheet" href="{{url('panel/vendors/bundle.css')}}" type="text/css">
	<link rel="stylesheet" href="{{url('panel/vendors/slick/slick.css')}}">
	<link rel="stylesheet" href="{{url('panel/vendors/slick/slick-theme.css')}}">
	<link rel="stylesheet" href="{{url('panel/vendors/vmap/jqvmap.min.css')}}">
	<link rel="stylesheet" href="{{url('panel/assets/css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('panel/vendors/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('panel/plugins/sweet_alert/sweetalert2.min.css')}}">
	<link rel="stylesheet" href="{{url('panel/plugins/colorpicker/css/bootstrap-colorpicker.min.css')}}">
	<link rel="stylesheet" href="{{url('panel/plugins/datepicker/kamadatepicker.min.css')}}">
	<link rel="stylesheet" href="{{url('panel/plugins/dropzone/css/dropzone.css')}}">

    @yield('google_recapthcha')

</head>
<body class="small-navigation">
	@include('admin.layouts.navigation')
	@include('admin.layouts.header',[ $title = $title ?? ""])
    @livewireStyles
    @yield('content')
	@livewireScripts
	<script src="{{url('panel/vendors/bundle.js')}} "></script>
	<script src="{{url('panel/vendors/slick/slick.min.js')}} "></script>
	<script src="{{url('panel/vendors/vmap/jquery.vmap.min.js')}} "></script>
	<script src="{{url('panel/assets/js/app.js')}} "></script>
    <script src="{{url('panel/vendors/select2/js/select2.min.js')}}"></script>
    <script src="{{url('panel/plugins/sweet_alert/sweetalert2.all.min.js')}}"></script>
	<script src="{{url('panel/plugins/colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{url('panel/plugins/colorpicker/js/colorpicker.js')}}"></script>
	<script src="{{url('panel/plugins/datepicker/kamadatepicker.min.js')}}"></script>
	<script src="{{url('panel/plugins/datepicker/kamadatepicker.holidays.js')}}"></script>
	<script src="{{url('panel/plugins/ckeditor/ckeditor.js')}}"></script>
	<script src="{{url('panel/plugins/dropzone/js/dropzone.js')}}"></script>

    <script>
        $('select').select2({
            dir: "rtl",
            dropdownAutoWidth: true,
            dropdownParent: $('#parent')
        });
    </script>
    @yield('scripts')

</body>
</html>
