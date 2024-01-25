<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Scripts -->
{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

<!-- Bootstrap core JavaScript-->
{{-- <script src="{{ asset('adminPanel/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminPanel/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

<!-- Core plugin JavaScript-->
<script src="{{ asset('adminPanel/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Page level plugin JavaScript-->
<script src="{{ asset('adminPanel/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('adminPanel/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminPanel/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('adminPanel/js/sb-admin.min.js') }}"></script>

<!-- Demo scripts for this page-->
<script src="{{ asset('adminPanel/js/demo/datatables-demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{ asset('adminPanel/js/demo/chart-area-demo.js') }}"></script>

<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
        
        //$(".livesearch").chosen();
    });
    // delete alert 
    $('a.delete-btn').on('click', function(e){
        e.preventDefault();
        var self = $(this);
        swal({
            title             : "Are you sure?",
            text              : "You will not be able to recover this!",
            type              : "warning",
            showCancelButton  : true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText : "Yes, Delete it!",
            cancelButtonText  : "No, Cancel delete!",
            closeOnConfirm    : false,
            closeOnCancel     : false
        },
        function(isConfirm){
            if(isConfirm){
                swal("Deleted!","It has been deleted", "success");
                setTimeout(function() {
                    self.parents(".delete_form").submit();
                }, 2000); //2 second delay (2000 milliseconds = 2 seconds)
            }
            else{
                  swal("Cancelled","It is safe", "error");
            }
        });
    });
</script>