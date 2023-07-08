@extends('layout')

@if ($result['id'] != null)
    @section('page_title', 'Contact Details')
@elseif($result['id'] == null)
    @section('page_title', 'Contact Form')
@endif

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4" style="float:none!important;margin: auto;margin-top:10% !important;">
                @if ($result['id'] != null)
                    <h4 style="margin-left: 85px;">Contact Details</h4>
                @elseif($result['id'] == null)
                    <h4 style="margin-left: 85px;">Contact Form</h4>
                @endif

                <form id="form">
                    @csrf
                    <label for="name" class="col-form-control">Name</label>
                    <input type="text" name="name" id="name" value="{{ $result['name'] }}" class="form-control" />


                    <label for="email" class="col-form-control">Email</label>
                    <input type="text" name="email" value="{{ $result['email'] }}"id="email"
                        class="form-control" />


                    <label for="number" class="col-form-control">Number</label>
                    <input type="text" name="number" value="{{ $result['number'] }}" id="number"
                        class="form-control" />

                    <label for="email" class="col-form-control">Message</label>
                    <textarea name="message" id="message" rows="5" class="form-control ">{{ $result['message'] }}</textarea>
                    <input type="hidden" name="id" value="{{ $result['id'] }}" class="form-control" />
                </form>
                @if ($result['id'] != null)
                    <a href="/"><button class="btn btn-primary subbtn" style="margin-top:10px">Back</button></a>
                @else
                    <button class="btn btn-primary subbtn" style="margin-top:10px">Submit</button>
                @endif

            </div>
        </div>
    </div>
    <script>
        $('.subbtn').click(function() {
            var formdata = new FormData($('#form')[0]);
            $.ajax({
                url: "{{ route('save_contact') }}",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: formdata,
                success: function(response) {
                    if (response.status == 1) {
                        toastr.success(response.success_message, 'Success');
                        setTimeout(function() {
                            document.getElementById("form").reset();
                        }, 2000, )
                    } else {
                        toastr.error(response.error_message, 'Error');
                    }
                }
            });
        });
    </script>
@endsection
