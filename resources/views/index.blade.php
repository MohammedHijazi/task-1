@extends('layouts.app')


@section('content')
    <div class="hee">
        <div class="category">
            <h6>الصنف</h6>
            <select name="category" id="category">
                <option value="بنزين">بنزين</option>
                <option value="سولار">سولار</option>
                <option value="كاز">كاز</option>

            </select>
        </div>

        <div class="quantity-type">
            <label for="quantity_type">لترات</label>
            <input name="quantity_type" type="radio" class="quantity_type" value="liter">
            <br>
            <label for="quantity_type">مبلغ</label>
            <input name="quantity_type" type="radio" class="quantity_type" value="shekel">
        </div>

        <div class="quantity-type">
            <h6>الكمية</h6>
            <input type="text" id="quantity">
        </div>

        <div class="driver">
            <h6>السائق</h6>
            <select name="driver" id="driver">

            </select>
        </div>

        <button class="accordion-button add_request " type="submit" >اعتماد</button>

    </div>
    <hr>

    <div>
        <h3 id="req">الطلبات السابقة</h3>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">

                    <div id="success_message"></div>

                    <div class="card">
                        <div class="card-body">
                            <table id="requests" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>التاريخ</th>
                                    <th>الصنف</th>
                                    <th>الكمية</th>
                                    <th>السائق</th>
                                    <th>الحالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function () {

            fetchdrivers();
            fetchrequests();

            function fetchdrivers()
            {
                $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/api/drivers",
                    dataType: "json",
                    success: function (drivers) {
                        console.log(drivers);
                        $('#driver').html("");
                        $.each(drivers,function (key,item) {
                            $('#driver').append(
                                new Option(item.name, item.id)
                            )
                        })
                    }
                });
            }

            function fetchrequests()
            {
                $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/api/requests",
                    dataType: "json",
                    success: function (requests) {
                        // console.log(requests);
                        $('tbody').html("");
                        $.each(requests,function (key,item) {
                            if (item.status==="تم الاستلام")
                            {
                                var button=  '<button class="stop_request" type="submit" >ايقاف</button>' +
                                    '<input class="req_id" type="hidden" value='+item.id+'>'

                            }
                            else
                            {
                                button =''
                            }
                            $('tbody').append
                            (
                                '<tr>\
                                 <td >' + item.id + '</td>\
                                 <td>' + item.created_at + '</td>\
                                 <td>' + item.category + '</td>\
                                 <td>' + item.quantity+ item.quantity_type +'</td>\
                                 <td>' + item.driver_name + '</td>\
                                 <td>' + item.status+' '  + button + '</td>\
                                 \</tr>'
                                )
                        })
                    }
                });
            }

            $(document).on('click', '.add_request', function (e) {
                e.preventDefault();

                var data = {
                    'category': $('#category').val(),
                    'quantity_type':  $(this).parent().find('input[name="quantity_type"]:checked').val(),
                    'quantity': $('#quantity').val(),
                    'driver_id': $('#driver').val(),
                }
                 console.log(data)

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "http://127.0.0.1:8000/api/requests",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        fetchrequests();

                    }
                });

            });

            $(document).on('click', '.stop_request', function (e) {
                e.preventDefault();
                var id = $(this).parent().find('input.req_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    url: "http://127.0.0.1:8000/api/requests/"+id,
                    data: id,
                    dataType: "json",
                    success: function (response) {
                        console.log(response)
                        fetchrequests();

                    }
                });


            });

        });


    </script>
@endsection
