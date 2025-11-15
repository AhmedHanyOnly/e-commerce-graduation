@extends('admin.layouts.admin')
@section('title','تعديل الطلب')
@section('content')
<div class="main-side">
    <div class="row w-100 mx-0 my-4 bg-white">
        <div class="d-flex justify-content-end ">
            <button class="btn btn-sm text-light btn-warning" id='btn-prt-content'>
                <i class="fa-solid fa-print"></i>
            </button>
        </div>
        <div class="col-md-12" id='prt-content'>
            <div class="mx-auto print-margin">
                <h4 class="text-center position-relative mb-3">
                    فاتورة ضريبية
                    <!-- <a href="javascript:print()" class="print  not-print btn btn-info text-white btn-sm">طباعة</a> -->
                </h4>
                <div class="box-invoice">
                    <div class="row">
                        <div class="col-md-4 p-3">
                            <h6><b>بيانات الشركة</b></h6>
                            <p>
                                <b> لاسم: </b>
                            </p>
                            <p><b>الرقم الضريبي: </b></p>
                            <p><b>السجل التجاري: </b></p>
                            <p>
                                <b> شركة التأمين: </b>
                            </p>
                        </div>
                        <div class="text-center col-md-4 p-3 d-flex align-items-center justify-content-center">
                            <img class="img-fluid" src="https://sa3d2.const-tech.biz/images/new-logo.png" alt="" width="130" />
                        </div>
                        <div class="col-md-4 p-3">
                            <h6><b>بيانات العميل</b></h6>
                            <p><b>الاسم : </b></p>
                            <p><b>العنوان: </b>1</p>
                            <p><b>رقم الجوال: </b>1</p>
                            <p><b>المدينة: </b>1</p>
                            <p><b>الحي: </b>1</p>
                        </div>
                    </div>
                </div>
                <div class="scrl">
                    <table class="table table-invoice mb-2">
                        <thead>
                            <tr>
                                <th class="border-bottom">أسم الخدمة</th>
                                <th class="border-bottom">السعر</th>
                                <th class="border-bottom">العدد</th>
                                <th class="border-bottom">#الخصم</th>
                                <th class="border-bottom">الإجمالي</th>
                                <th class="border-bottom">تحمل التأمين</th>
                                <th class="border-bottom">%الضريبة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="">--</td>
                                <td class="">--</td>
                                <td class="">--</td>
                                <td class="">--</td>
                                <td class="">--</td>
                                <td class="">--</td>
                                <td class="">--</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="scrl">
                    <table class="table table-invoice mb-2">
                        <thead>
                            <tr>
                                <th class="border-bottom">
                                    رقم الفاتورة - Invoice number
                                </th>
                                <th class="border-bottom">
                                    تاريخ الفاتورة - Invoice date
                                </th>
                                <th class="border-bottom">وقت الفاتورة - Payment time</th>
                                <th class="border-bottom">
                                    حالة الفاتورة - Payment method
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-danger">3</td>
                                <td>2023-12-26</td>
                                <td>10:25</td>
                                <td><span class="text-success">غير مسددة</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="scrl">
                    <table class="table table-invoice mt-2 mb-2">
                        <thead>
                            <tr>
                                <th class="border-bottom">من - From</th>
                                <th class="border-bottom">الي - To</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> 1</td>
                                <td> 1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-4 parent-barcode text-center d-flex align-items-center justify-content-center">
                        <img width="150" src="https://th.bing.com/th/id/R.dcf4b6e228aef80dd1a58f4c76f07128?rik=Qj2LybacmBALtA&amp;riu=http%3a%2f%2fpngimg.com%2fuploads%2fqr_code%2fqr_code_PNG25.png&amp;ehk=eKH2pdoegouCUxO1rt6BJXt4avVYywmyOS8biIPp5zc%3d&amp;risl=&amp;pid=ImgRaw&amp;r=0" alt="" />
                    </div>
                    <div class="col-md-8">
                        <table class="table table-invoice">
                            <tbody>
                                <tr>
                                    <td class="border-bottom td-head">
                                        <b> قيمة الضريبة(55%) - Tax amount (55%) </b>
                                    </td>
                                    <td class="border-bottom">1800</td>
                                </tr>
                                <tr class="duble-border">
                                    <td class="td-head">
                                        <b>الاجمالي بعد الضريبة - Total after tax </b>
                                    </td>
                                    <td>13800</td>
                                </tr>
                                <tr>
                                    <td class="border-bottom td-head">
                                        <b> المدفوع - Paid up</b>
                                    </td>
                                    <td class="border-bottom">0</td>
                                </tr>
                                <tr>
                                    <td class="border-bottom td-head">
                                        <b> المتبقي - remaining </b>
                                    </td>
                                    <td class="border-bottom">13800</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection