@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')


<div class="content-body">

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Products Sold</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">4565</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Net Profit</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">$ 8541</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body">
                        <h3 class="card-title text-white">New Customers</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">4565</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body">
                        <h3 class="card-title text-white">Customer Satisfaction</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">99%</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                    </div>
                </div>
            </div>
            <div class="container my-5">
                <div class="row">
                    <div class="col-6 col-sm-12 col-md-6">
                        <div id="chartContainerCategory" style="height: 370px; width: 100%;"></div>
                    </div>
                    <div class="col-6 col-sm-12 col-md-6">
                        <div id="chartContainerBrand" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
                <div class="container my-5">
                    <div class="row">
                        <div class="col-12">
                            <div id="chartContainerOrders" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script>
    window.onload = function () {
        // Products per Category Chart
        var dataPointsCategory = @json($categories->map(function ($category) {
            return ['label' => $category->name, 'y' => $category->products_count];
        }));

        var chartCategory = new CanvasJS.Chart("chartContainerCategory", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Products per Category"
            },
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "##0.0\"%\"",
                indexLabel: "{label} {y}",
                dataPoints: dataPointsCategory
            }]
        });
        chartCategory.render();

        // Products per Brand Chart
        var dataPointsBrand = @json($brands->map(function ($brand) {
            return ['label' => $brand->name, 'y' => $brand->products_count];
        }));

        var chartBrand = new CanvasJS.Chart("chartContainerBrand", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Products per Brand"
            },
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "##0.0\"%\"",
                indexLabel: "{label} {y}",
                dataPoints: dataPointsBrand
            }]
        });
        chartBrand.render();

        // Orders for Today Line Chart
        var dataPointsOrders = @json($data); // Make sure $data is an array of data for orders

        var chartOrders = new CanvasJS.Chart("chartContainerOrders", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Orders for Today"
            },
            axisY: {
                title: "Number of Orders"
            },
            data: [{
                type: "line",
                markerType: "square",
                markerSize: 6,
                dataPoints: dataPointsOrders
            }]
        });
        chartOrders.render();
    }
</script>


@include('backend.admin.components.footer')