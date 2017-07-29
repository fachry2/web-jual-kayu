@extends('layouts.app-admin')

@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
          <div class="count">{{ $user->count() }}</div>
          <h3>Users</h3>
          <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-comments-o"></i></div>
          <div class="count">{{ $produk->count() }}</div>
          <h3>Produk</h3>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
          <div class="count">{{ $usaha->count() }}</div>
          <h3>Usaha</h3>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-check-square-o"></i></div>
          <div class="count">179</div>
          <h3>New Sign ups</h3>
          <p>Lorem ipsum psdea itgum rixt.</p>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-4">
        <div class="x_panel">
          <div class="x_title">
            <h2>Top Profiles <small>Sessions</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item One Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Two Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Two Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Two Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Three Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="x_panel">
          <div class="x_title">
            <h2>Top Profiles <small>Sessions</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item One Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Two Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Two Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Two Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Three Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="x_panel">
          <div class="x_title">
            <h2>Top Profiles <small>Sessions</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item One Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Two Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Two Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Two Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">April</p>
                <p class="day">23</p>
              </a>
              <div class="media-body">
                <a class="title" href="#">Item Three Title</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<!-- Chart.js -->
    <script src="{{ asset('admins/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{ asset('admins/vendors/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('admins/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admins/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('admins/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('admins/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('admins/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('admins/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('admins/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('admins/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('admins/vendors/DateJS/build/date.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('admins/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admins/js/datepicker/daterangepicker.js') }}"></script>
    
@endsection