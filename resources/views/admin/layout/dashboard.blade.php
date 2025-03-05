<!DOCTYPE html>
<html lang="en">

<head>
    <title>CaseManagementSystem</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=url('')?>/assets/bootstrap-5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <script src="<?=url('')?>/assets/js/jquery-3.7.1.min.js"></script>

    <script src="<?=url('')?>/assets/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>




    <link rel="stylesheet" href="<?=url('')?>/assets/calendar/simple-calendar.css">
    <link rel="stylesheet" href="<?=url('')?>/assets/calendar/style.css">
    <script src="<?=url('')?>/assets/calendar/jquery.simple-calendar.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--- sweet alert cdn  --->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--- end swal alert cdn 3--->


    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link rel="stylesheet" href="<?=url('')?>/assets/DataTables/dataTables.css">
    <script src="<?=url('')?>/assets/DataTables/dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!--- sweet alert cdn  --->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--- end swal alert cdn --->


    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <link href="<?=url('')?>/assets/css/style.css" rel="stylesheet">

    <script src="<?=url('')?>/assets/js/main.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')


    <script>
        var base_url = '<?=url('/')?>';
    </script>

</head>

<body>
    <div class="d-flex">
        @include('admin.layout.sidebar')
        <div class="body_content">
            @include('admin.layout.headerbar')
            <div class="main_content">
                @yield('content')
            </div>
        </div>
    </div>
    @stack('scripts')
    <script>

        function clearValidationError()
        {
            document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
        }

        function displayCommonError(error)
        {
            let errorMessage = 'An unexpected error occurred.';
            if (error.responseJSON && error.responseJSON.message) {
                errorMessage = error.responseJSON.message;
            }
            else if (error.responseText) {
                errorMessage = error.responseText;
            }
            toastr.error(errorMessage, 'Error');
        }

        function displayErrors(errors) {
            // Clear previous errors
            document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

            for (let field in errors) {
                if (errors.hasOwnProperty(field)) {
                    const errorElement = document.getElementById(`error_${field}`);
                    if (errorElement) {
                        errorElement.style.display = 'block';
                        errorElement.textContent = errors[field][0]; // Display the first error message
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "2000", // 2 seconds
            "extendedTimeOut": "1000",
            "positionClass": "toast-top-right"
        };
    </script>
</body>
</html>
