<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'Backend | Blog')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/back/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/back/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/back/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/back/css/skins/_all-skins.min.css">
  <!-- bootstrap wysihtml5 - text editor -->


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('layouts.backend.navbar')

    @include('layouts.backend.sidebar')


    @yield('content')

  <footer class="main-footer">
    <strong>Copyright &copy; 2020 tearofenemy</a>.</strong>
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="/back/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/back/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/back/js/app.min.js"></script>

@yield('scripts')

</body>
</html>
