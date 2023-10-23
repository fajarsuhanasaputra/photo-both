<!--   Core JS Files   -->
<script src="{{ (asset('assets/js/core/jquery.min.js')) }}"></script>
<script src="{{ (asset('assets/js/core/popper.min.js')) }}"></script>
<script src="{{ (asset('assets/js/core/bootstrap-material-design.min.js')) }}"></script>
<script src="{{ (asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')) }}"></script>
<!-- Plugin for the momentJs  -->
<script src="{{ (asset('assets/js/plugins/moment.min.js')) }}"></script>
<!-- Forms Validations Plugin -->
<script src="{{ (asset('assets/js/plugins/jquery.validate.min.js')) }}"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ (asset('assets/js/plugins/jquery.bootstrap-wizard.js')) }}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ (asset('assets/js/plugins/bootstrap-selectpicker.js')) }}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{ (asset('assets/js/plugins/jquery.dataTables.min.js')) }}"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ (asset('assets/js/plugins/bootstrap-tagsinput.js')) }}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ (asset('assets/js/plugins/jasny-bootstrap.min.js')) }}"></script>
<script src="{{ (asset('assets/js/plugins/arrive.min.js')) }}"></script>

<!-- Chartist JS -->
<script src="{{ (asset('assets/js/plugins/chartist.min.js')) }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ (asset('assets/js/plugins/bootstrap-notify.js')) }}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ (asset('assets/js/material-dashboard.min1c51.js?v=2.1.2')) }}" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ (asset('assets/demo/demo.js')) }}"></script>
<!-- Sharrre libray -->
<script src="{{ (asset('assets/demo/jquery.sharrre.js')) }}"></script>


<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "ordering": true, // Enable sorting for all columns
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "pageLength": 10,
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            },
            "initComplete": function(){
                $("#datatables").show();
            },
        });

        var table = $('#datatables').DataTable(); // Correct the selector

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');
            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        // Like record
        table.on('click', '.like', function() {
            alert('You clicked on the Like button');
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const canvas = document.getElementById('dashboard-chart');
    const value = document.getElementById('dashboard-data').value;
    const parsed = JSON.parse(value);

    const data = parsed.map(i => Math.ceil(i.amount - (i.amount * 0.007771)))
    const labels = parsed.map(i => i.tanggal)

    const options = {
        type: 'line',
        data: {
            labels,
            datasets: [{
                data,
                borderWidth: 1,
                label: "Jumlah Pendapatan (IDR) ",
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
        },
    }

    new Chart(canvas, options);
</script>
<script src="{{ (asset('assets/easy-number-separator.js' )) }}"></script>
