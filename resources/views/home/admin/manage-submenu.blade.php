@extends('layouts.main')
@section('content')
<style>
    table#tbl-menu td,
    table#tbl-menu th {
        padding: 8px;
        text-align: center; /* Align text for better visuals */
        vertical-align: middle; /* Align content vertically */
    }

    #loading-overlay {
        position: relative;
        top: 50;
        /* left: 0;  */
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
        display: flex;
        justify-content: center;
        align-items: center;
        /* z-index: 9999; Ensure it stays on top */
    }

    /* Blur effect on body */
    body.loading {
        filter: blur(4px); /* Add blur */
        pointer-events: none; /* Disable interactions */
    }
</style>
<div class="card">
    <div class="card-body">
      <div class="table-responsive text-nowrap">
          <table class="table" id="tbl-menu">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Active</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="tbody-tbl-menu">
            </tbody>
        </table>
        <div id="loading-overlay" style="display: none;">
            <img src="{{ asset('assets/img/loading/loading.gif') }}" alt="Loading" />
        </div>
      </div>
    </div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">Edit Menu</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form action="/auth/logout" method="get">
        <div class="modal-body">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Sure</button>
        </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });

        $.ajax({
            url: '/manage-menu/menus/all',
            type: 'get',
            dataType: 'json',
            beforeSend: function () {
                // Show the loading overlay
                $('#loading-overlay').show();
            },
            success: function (res) {
                if (res && res.length > 0) {
                    for (var i = 0; i < res.length; i++) {
                        $('#tbody-tbl-menu').append(`
                            <tr>
                                <td>${i + 1}</td>
                                <td>${res[i].name}</td>
                                <td>
                                    ${res[i].is_active == "1" 
                                    ? "<i class='bx bxs-check-circle' style='color: blue;'></i>" 
                                    : "<i class='bx bxs-x-circle' style='color: red;'></i>"}
                                </td>
                                <td>
                                    <button class="badge bg-warning mx-1" style="border-color: white" data-bs-toggle="modal"
                        data-bs-target="#editModal">Edit</button> 
                                    <button class="badge bg-danger mx-1" style="border-color: white">Delete</button> 
                                </td>
                            </tr>
                        `);
                    }
                    // Initialize DataTable only once after appending all rows
                    new DataTable('#tbl-menu');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.error(xhr.statusText);
            },
            complete: function () {
                // Hide the loading overlay and remove the 'loading' class
                $('#loading-overlay').hide();
                // $('.container-xxl').removeClass('loading');
            }
        });
    });
</script>
@endsection