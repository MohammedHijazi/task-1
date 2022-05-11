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
            <input type="radio" name="quantity_type" value="liter">
            <br>
            <label for="quantity_type">مبلغ</label>
            <input type="radio" name="quantity_type" value="shekel">
        </div>

        <div class="quantity-type">
            <h6>الكمية</h6>
            <input type="text" name="quantity">
        </div>

        <div class="driver">
            <h6>السائق</h6>
            <select name="driver" id="driver">

            </select>
        </div>

        <button class="accordion-button" type="submit">اعتماد</button>
    </div>
    <hr>

    <div>
        <h3>الطلبات السابقة</h3>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">

                    <div id="success_message"></div>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
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

            function fetchdrivers() {
                $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/api/drivers",
                    dataType: "json",
                    success: function (drivers) {
                        console.log(drivers);
                        $('#driver').html("");
                        $.each(drivers,function (key,item) {
                            $('#driver').append(
                                new Option(item.name, item.name)
                            )
                        })
                    }
                });
            }

            function fetchrequests() {
                $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/api/requests",
                    dataType: "json",
                    success: function (requests) {
                        console.log(requests);
                        $('tbody').html("");
                        $.each(requests,function (key,item) {
                            $('tbody').append(
                                '<tr>\
                            <td>' + item.id + '</td>\
                            <td>' + item.created_at + '</td>\
                            <td>' + item.category + '</td>\
                            <td>' + item.quantity+ item.quantity_type +'</td>\
                            <td>' + item.driver_name + '</td>\
                            <td>' + item.status + '</td>\
                        \</tr>'
                            )
                        })
                    }
                });
            }




        });


    </script>
@endsection
