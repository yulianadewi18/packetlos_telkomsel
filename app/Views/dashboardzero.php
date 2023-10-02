<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?= csrf_field() ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 ">
            <h1 class="mt-4 mb-4">Dashboard Zero</h1>
            <div class="card">
                <div class="card-body">
                    <div id="map" style="width: 100%; height: 450px;">
                        <canvas id="maps-zero"></canvas>
                        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                        <script>
                            // var map = L.map('map').setView([-7.837222, 113.0275], 8);

                            // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            //     maxZoom: 19,
                            //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            // }).addTo(map);
                            var packet = <?php echo json_encode($zerotrafic_load); ?>;
                            // console.log(packet);

                            // for (let i = 0; i < packet.length; i++) {
                            //     var markerColor = 'marker-icon-2x-blue'
                            //     if (packet[i].remark === 'PAYLOAD') {
                            //         markerColor = 'marker-icon-2x-yellow'; // Jika pl_status = 'consecutive', warna merah
                            //     } else if (packet[i].remark === 'TRAFFIC') {
                            //         markerColor = 'marker-icon-2x-red'; // Jika pl_status = 'spike', warna kuning
                            //     }

                            //     var markerIcon = new L.Icon({
                            //         iconUrl: https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/${markerColor}.png,
                            //         shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                            //         iconSize: [25, 41],
                            //         iconAnchor: [12, 41],
                            //         popupAnchor: [1, -34],
                            //         shadowSize: [41, 41]
                            //     });
                            //     var marker = L.marker([packet[i].latitude, packet[i].longitude], {
                            //             icon: markerIcon
                            //         }).addTo(map)
                            //         .bindPopup('<b>' + packet[i].site_id + '<br/>' + '</b>')
                            //         .openPopup();

                            // }
                        </script>
                    </div>

                </div>
            </div>

            <div class="row mt-4">
                <!-- Trend ALL -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">

                            <script src="https://code.highcharts.com/highcharts.js"></script>
                            <script src="https://code.highcharts.com/modules/accessibility.js"></script> <!-- Include the Accessibility module -->
                            <div id="dataline"></div>
                            <script>
                                $(document).ready(function() {
                                    // Data untuk line charts
                                    $.ajax({
                                        type: "GET",
                                        url: "http://localhost:8080/dashboardzero/chartdata",
                                        success: function(response) {
                                            const zerodate = response.zerodate;
                                            console.log(zerodate);
                                            dataline(zerodate);
                                        },
                                        error: function() {
                                            console.error('An error occurred while making the AJAX request.');
                                        }
                                    });
                                });

                                function dataline(zerodate) {
                                    zerodate.forEach(item => {
                                        item.traffic_count = parseInt(item.traffic_count);
                                        item.payload_count = parseInt(item.payload_count);
                                    });

                                    Highcharts.chart('dataline', {
                                        title: {
                                            text: 'TREND DATA',
                                            align: 'left'
                                        },

                                        yAxis: {
                                            title: {
                                                text: 'VALUE'
                                            }
                                        },

                                        xAxis: {

                                            categories: zerodate.map(item => item.date)
                                        },

                                        legend: {
                                            layout: 'vertical',
                                            align: 'right',
                                            verticalAlign: 'middle'
                                        },

                                        series: [{
                                            name: 'Traffic',
                                            data: zerodate.map(item => item.traffic_count),
                                            color: 'red'
                                        }, {
                                            name: 'Payload',
                                            data: zerodate.map(item => item.payload_count),
                                            color: 'yellow'
                                        }],

                                        responsive: {
                                            rules: [{
                                                condition: {
                                                    maxWidth: 500
                                                },
                                                chartOptions: {
                                                    legend: {
                                                        layout: 'horizontal',
                                                        align: 'center',
                                                        verticalAlign: 'bottom'
                                                    }
                                                }
                                            }]
                                        }

                                    });
                                }
                            </script>


                        </div>
                    </div>
                </div>

                <!-- NOP Barchart -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div id="barChartNOP"></div>
                            <script>
                                $(document).ready(function() {
                                    // Data untuk line charts
                                    $.ajax({
                                        type: "GET",
                                        url: "http://localhost:8080/dashboardzero/barchart",
                                        success: function(response) {
                                            const dateUpdate = response.dateUpdate;
                                            console.log(dateUpdate);
                                            dataNOP(dateUpdate);
                                            trendDataNOP(dateUpdate);
                                        },
                                        error: function() {
                                            console.error('An error occurred while making the AJAX request.');
                                        }
                                    });
                                });

                                function dataNOP(dateUpdate) {
                                    dateUpdate.forEach(item => {
                                        item.traffic_count = parseInt(item.traffic_count);
                                        item.payload_count = parseInt(item.payload_count);
                                    });

                                    Highcharts.chart('barChartNOP', {
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            text: 'Data TRAFFIC-PAYLOAD NOP'
                                        },
                                        xAxis: {
                                            categories: dateUpdate.map(item => item.nop),
                                            crosshair: true
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Count'
                                            },
                                            min: 0
                                        },
                                        plotOptions: {
                                            column: {
                                                pointPadding: 0.2,
                                                borderWidth: 0
                                            }
                                        },
                                        tooltip: {
                                            shared: true
                                        },
                                        series: [{
                                            name: 'TRAFFIC',
                                            data: dateUpdate.map(item => item.traffic_count),
                                            color: 'red' // Yellow for SPIKE
                                        }, {
                                            name: 'PAYLOAD',
                                            data: dateUpdate.map(item => item.payload_count),
                                            color: 'yellow' // Green for CLEAR
                                        }, ],
                                        credits: {
                                            enabled: false
                                        }
                                    });


                                }
                            </script>
                        </div>
                    </div>
                </div>
                <!-- TREND NOP -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div id="lineChartNop"></div>
                            <script>
                                function trendDataNOP(dateUpdate) {
                                    dateUpdate.forEach(item => {
                                        item.traffic_count = parseInt(item.traffic_count);
                                        item.payload_count = parseInt(item.payload_count);
                                    });

                                    Highcharts.chart('lineChartNop', {
                                        title: {
                                            text: 'TREND DATA NOP',
                                            align: 'left'
                                        },

                                        yAxis: {
                                            title: {
                                                text: 'VALUE'
                                            }
                                        },

                                        xAxis: {

                                            categories: dateUpdate.map(item => item.nop)
                                        },

                                        legend: {
                                            layout: 'vertical',
                                            align: 'right',
                                            verticalAlign: 'middle'
                                        },

                                        series: [{
                                            name: 'Traffic',
                                            data: dateUpdate.map(item => item.traffic_count),
                                            color: 'red'
                                        }, {
                                            name: 'Payload',
                                            data: dateUpdate.map(item => item.payload_count),
                                            color: 'yellow'
                                        }],

                                        responsive: {
                                            rules: [{
                                                condition: {
                                                    maxWidth: 500
                                                },
                                                chartOptions: {
                                                    legend: {
                                                        layout: 'horizontal',
                                                        align: 'center',
                                                        verticalAlign: 'bottom'
                                                    }
                                                }
                                            }]
                                        }

                                    });
                                }
                            </script>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <form class="mt-4 mb-4" method="post">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Cari" name="keyword" aria-label="Cari" aria-describedby="btnNavbarSearch" />
                                    <button class="btn btn-primary" id="btnNavbarSearch" name="submit" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <!-- Filter by Status -->
                        <div class="col-4">
                            <form class="mt-4 mb-4" method="post" name="filter-form">
                                <div class="input-group">
                                    <select class="form-select" name="filter_nop" id="filter">
                                        <option value="">Filter by NOP</option>
                                        <option value="JEMBER">JEMBER</option>
                                        <option value="KEDIRI">KEDIRI</option>
                                        <option value="LAMONGAN">LAMONGAN</option>
                                        <option value="MADIUN">MADIUN</option>
                                        <option value="MALANG">MALANG</option>
                                        <option value="SIDOARJO">SIDOARJO</option>
                                        <option value="SURABAYA">SURABAYA</option>
                                        <!-- Add more status options as needed -->
                                    </select>
                                    <button class="btn btn-primary" type="button" id="filterButton"><i class="fas fa-filter"></i> Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table border-collapse width:100%">
                            <thead class="table-light ">
                                <tr class="">
                                    <th> </th>
                                    <th>Tech</th>
                                    <th>Date</th>
                                    <th>Cell Name</th>
                                    <th>Site ID</th>
                                    <th>Site Name</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten</th>

                                    <th>NOP</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody id="filtered-data">
                                <?= view('dashboardzero_rows', ['zerotrafic_load' => $zerotrafic_load]); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- <div class="table table-responsive">


                </div> -->
        </div>
</div>
</div>
</main>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script>
  
    var table = $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: ['print', 'copy', 'excel', 'pdf']
    });
    table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    
    $('#filterButton').on('click', function() {
        let selectedValue = $('#filter').val();
        table.search(selectedValue).draw();
    });
   

</script>
<?= $this->endSection(); ?>