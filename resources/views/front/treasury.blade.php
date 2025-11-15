
  <section class=" main-section pt-4">
    <div class="container">
    <div class="d-flex align-items-center">
    <h4 class="main-heading mb-4">الخزينة</h4>
       <div class="flex-fill">
       <div class="d-flex justify-content-center">
       <div class="alert alert-primary d-flex align-items-center" role="alert">
        يمكنك اضافة راس المال من لوحة التحكم الاعدادت

        </div>
       </div>
       </div>
    </div>
<div class="row g-3 mb-4 boxes-info justify-content-center boxes-bg-color">
  <div class="col-sm-6 col-lg-3">
    <a href="#">
      <div class="box-info blue">
        <i class="fa-solid fa-dollar-sign bg-icon"></i>
        <div class="num">54</div>
        <div class="text">test</div>
      </div>
    </a>
  </div>
  <div class="col-sm-6 col-lg-3">
    <a href="#">
      <div class="box-info green">
        <i class="fa-solid fa-money-bill-trend-up bg-icon"></i>
        <div class="num">5464</div>
        <div class="text">test</div>
      </div>
    </a>
  </div>

  <div class="col-sm-6 col-lg-3">
    <a href="#">
      <div class="box-info red">
        <i class="fa-solid fa-money-bill-trend-up fa-flip-vertical bg-icon"></i>
        <div class="num">54</div>
        <div class="text">test</div>
      </div>
    </a>
  </div>
  <div class="col-sm-6 col-lg-3">
    <a href="#">
      <div class="box-info blue">
        <i class="fa-solid fa-money-bill-trend-up fa-flip-vertical bg-icon"></i>
        <div class="num">68574</div>
        <div class="text">test</div>
      </div>
    </a>
  </div>
 
</div>
<div class=" bg-white p-3 rounded-2 shadow">
<canvas id="myChartDate" height="100"></canvas>

</div>

    </div>
</section>
  <!-- Chart Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
var xValues = ["January","February","March ","April","may","June","July","August ","September","September","October","November","December"];

new Chart("myChartDate", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      data: [860,1140,1060,1060,1070,1070,1070,1070,1110,1330,2210,7830,2478],

      borderWidth: "1px",
      pointRadius: 0,
      borderColor: "#4B94BF",
            backgroundColor: "rgba(75, 148, 191, 0.7)",
      fill: true
    }, {
      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,1900,1900,1900,7000],
      borderColor: "rgba(210 ,214, 223, 1)",
      borderWidth: "1px",
      backgroundColor: "rgba(210 ,214, 223, 0.7)",
      pointRadius: 0,

      fill: true
    }]
  },
  options: {
    legend: {display: false}
  }
});
</script>

