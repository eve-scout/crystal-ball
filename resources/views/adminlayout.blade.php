<!DOCTYPE html>
<html>
<head>
	<title>Crystal Ball</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/css/tokenfield-typeahead.min.css">
  <link rel="stylesheet" href="/css/bootstrap-tokenfield.css">
  <link rel="stylesheet" href="/css/dropzone.css">
  <link rel="stylesheet" href="/css/bootstrap-markdown-editor.css">
  <link rel="stylesheet" href="/css/bootstrap3-editable/css/bootstrap-editable.css">
  <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Crystal Ball</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="#">About</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Login</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('/admin/items') }}"><i class="fa fa-btn fa-sign-out"></i>Admin</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </ul>
            </li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
<div class="container" style="padding-top: 100px;">
  <div class="row">
    <div class="col-md-3">
      <div class="list-group table-of-contents affix" style="width: 228px; margin-top: 30px;">
        <a class="list-group-item" href="/admin/releases">Releases</a>
        <a class="list-group-item" href="/admin/builds">Builds</a>
        <a class="list-group-item" href="/admin/items">Items</a>
        <a class="list-group-item" href="#">Bulk Import</a>
      </div>
    </div>

    <div class="col-md-9">
      @yield('content')
    </div>
  </div>
</body>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script src="/js/bootstrap-tokenfield.min.js"></script>
<script src="/js/typeahead.bundle.min.js"></script>
<script src="/js/dropzone.js"></script>
<script src="/js/nanobar.min.js"></script>
<script src="/js/underscore-min.js"></script>
<script src="/js/ace/ace.js"></script>
<script src="/js/bootstrap-markdown-editor.js"></script>
<script src="/js/bootstrap3-editable/bootstrap-editable.js"></script>
@stack('scripts')
</html>