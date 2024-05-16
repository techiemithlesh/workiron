@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="col-md-4 my-1">Vehicle Inspections</h3>
                        <div class="col-md-4 text-end">
                            <input type="search" id="searchInput" class="form-control" placeholder="Enter Vin / Unit_number / Fleet Number" />
                        </div>
                        <div class="col-md-2 text-start">
                            <button class="btn btn-primary" id="searchButton">Search</button>
                        </div>
                        <div class="col-md-2 text-end">
                            <form action="{{ route('vehicle-inspections') }}">
                                <select class="form-select" name="inspector" onchange="this.form.submit();">
                                    <option value="">All</option>
                                    @foreach($inspectors as $id => $name)
                                    <option value="{{ $id }}" {{ $inspector == $id ? 'selected="selected"' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="inspectionTable" class="table w-100">
                        <thead>
                            <tr>
                                <th>Report #</th>
                                <th>Inspection Date</th>
                                <th>Inspector Name</th>
                                <th>VIN Number</th>
                                <th>Vehicle Make</th>
                                <th>Last updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('partials.inspection_table_rows')
                        </tbody>
                    </table>

                    {!! $inspections->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Email Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Send PDF via Email</h5>
                <button type="button" class="close closeModalButton" data-dismiss="modal" aria-label="Close" id="closeModalButton">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="email" class="form-control" id="emailInput" placeholder="Enter Email Address">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeModalButton" data-dismiss="modal" id="closeModalButton">Close</button>
                <button type="button" class="btn btn-primary" id="sendEmailBtn">Send</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    // Function to perform search using AJAX
    function searchInspections() {
        var searchText = document.getElementById("searchInput").value;
        alert(searchText);

        $.ajax({
            url: "{{ route('send-pdf-email') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                inspection_id: inspectionId,
                email: email
            },
            success: function(response) {
                // Handle success message or any other action
                $('#emailModal').modal('hide');
                console.log("response", response);
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                console.log("Error", error);
            }
        });

    }

    // Event listener for search button click
    document.getElementById("searchButton").addEventListener("click", function() {
        searchInspections();
    });

    // Event listener for input field keyup event
    $('#searchInput').keyup(function(event) {
        if (event.keyCode === 13) {
            searchInspections();
        }
    });


    // EMAIL SEND FUNCTIONALITY START HERE
    $(document).ready(function() {
        // Event listener for clicking the email icon
        $('.email-icon').click(function() {

            $('#emailModal').modal('show');

            var inspectionId = $(this).data('id');
            $('#sendEmailBtn').data('inspection-id', inspectionId);

        });

        // Event listener for clicking the send button
        $('#sendEmailBtn').click(function() {
            var inspectionId = $(this).data('inspection-id');
            var email = $('#emailInput').val();

            // AJAX request to send the email
            $.ajax({
                url: "{{ route('send-pdf-email') }}",
                method: 'POST',
                data: {
                    inspection_id: inspectionId,
                    email: email
                },
                success: function(response) {
                    // Handle success message or any other action
                    $('#emailModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $('.closeModalButton').click(function() {
        $('#emailModal').modal('hide'); // Close the modal
    });

    // EMAIL SEND FUNCTIONALITY END HERE
</script>

@endsection