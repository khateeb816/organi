@include('backend.admin.components.header')

    <div class="login-form-bg h-100 mt-5">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html"> <h4>Login</h4></a>

                                <form class="mt-5 mb-5 login-input" action="{{url('/login-check')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit">Sign In</button>
                                </form>
                                {{-- <p class="mt-5 login-form__footer">Dont have account? <a href="page-register.html" class="text-primary">Sign Up</a> now</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('/backendAssets/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('/backendAssets/js/custom.min.js') }}"></script>
    <script src="{{ asset('/backendAssets/js/settings.js') }}"></script>
    <script src="{{ asset('/backendAssets/js/gleek.js') }}"></script>
    <script src="{{ asset('/backendAssets/js/styleSwitcher.js') }}"></script>

    <!-- Chartjs -->
    <script src="{{ asset('/backendAssets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ asset('/backendAssets/plugins/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datamap -->
    <script src="{{ asset('/backendAssets/plugins/d3v3/index.js') }}"></script>
    <script src="{{ asset('/backendAssets/plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ asset('/backendAssets/plugins/datamaps/datamaps.world.min.js') }}"></script>
    <!-- Morrisjs -->
    <script src="{{ asset('/backendAssets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('/backendAssets/plugins/morris/morris.min.js') }}"></script>
    <!-- Pignose Calender -->
    <script src="{{ asset('/backendAssets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/backendAssets/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <!-- ChartistJS -->
    <script src="{{ asset('/backendAssets/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('/backendAssets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

    <script src="{{ asset('/backendAssets/js/dashboard/dashboard-1.js') }}"></script>

</body>
</html>





