<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart || Seller Report</title>

    <link rel="icon" href="resources/company-logo.png" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logo.svg">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light">
                <div class="row mt-2 mb-1">

                    <div class="col-12 col-lg-4 bg-light">
                        <div class="row text-center">
                            <div class="col-12"><img src="resources/logo.svg" height="200px"></div>
                            <p class="fw-bold fs-4 text-black-50">Emart.pvt.ltd</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 mt-3">
                        <div class="row">
                            <div class="col-12 text-center text-lg-start">
                                <p class="fs-2 fw-bold">See Your Own Incomes ....</p>
                            </div>
                            <div class="col-12 text-center text-lg-start">
                                <p class="fs-5">Discover Your Incomes: Insightful, Transparent, Empowering. Your financial clarity starts here with us ..... </p>
                            </div>
                            <div class="col-12 d-flex justify-content-center justify-content-lg-end align-items-end mt-2 mt-lg-4">
                                <button class="btn btn-dark" onclick="window.location = 'sellerGenerateReport.php'">Download Report</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">

                    <!-- row -->
                    <div class="col-12 border-bottom">
                        <div class="row mt-2 mb-2">

                            <?php
                            require "connection.php";
                            session_start();
                            $s_nic = $_SESSION["seller"]["nic"];

                            ?>

                            <div class="col-12">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>
<script>
    var janPrice = 0;
    var FebPrice = 0;
    var MarPrice = 0;
    var AprPrice = 0;
    var MayPrice = 0;
    var JunPrice = 0;
    var JulPrice = 0;
    var AugPrice = 0;
    var SapPrice = 0;
    var OctPrice = 0;
    var NovPrice = 0;
    var DecPrice = 0;

    <?php
    $monthly_totals = array_fill(0, 12, 0);
    $monthly_qtys = array_fill(0, 12, 0);

    $invoice_rs = Database::Search(" SELECT * FROM `invoice` 
                                     INNER JOIN product ON product.id=invoice.product_id
                                     WHERE product.seller_nic='" . $s_nic . "'");

    $invoice_num = $invoice_rs->num_rows;

    for ($i = 0; $i < $invoice_num; $i++) {
        $invoice_data = $invoice_rs->fetch_assoc();
        $date_time = $invoice_data["date_time"];
        $total = $invoice_data["total"];
        $qty = $invoice_data["buy_qty"];

        $date = new DateTime($date_time);
        $month = intval($date->format('m'));

        $monthly_totals[$month - 1] += $total;
        $monthly_qtys[$month - 1] += $qty;
    }

    ?>

    var janPrice = <?php echo $monthly_totals[0]; ?>;
    var FebPrice = <?php echo $monthly_totals[1]; ?>;
    var MarPrice = <?php echo $monthly_totals[2]; ?>;
    var AprPrice = <?php echo $monthly_totals[3]; ?>;
    var MayPrice = <?php echo $monthly_totals[4]; ?>;
    var JunPrice = <?php echo $monthly_totals[5]; ?>;
    var JulPrice = <?php echo $monthly_totals[6]; ?>;
    var AugPrice = <?php echo $monthly_totals[7]; ?>;
    var SepPrice = <?php echo $monthly_totals[8]; ?>;
    var OctPrice = <?php echo $monthly_totals[9]; ?>;
    var NovPrice = <?php echo $monthly_totals[10]; ?>;
    var DecPrice = <?php echo $monthly_totals[11]; ?>;

    var janQty = <?php echo $monthly_qtys[0]; ?>;
    var FebQty = <?php echo $monthly_qtys[1]; ?>;
    var MarQty = <?php echo $monthly_qtys[2]; ?>;
    var AprQty = <?php echo $monthly_qtys[3]; ?>;
    var MayQty = <?php echo $monthly_qtys[4]; ?>;
    var JunQty = <?php echo $monthly_qtys[5]; ?>;
    var JulQty = <?php echo $monthly_qtys[6]; ?>;
    var AugQty = <?php echo $monthly_qtys[7]; ?>;
    var SepQty = <?php echo $monthly_qtys[8]; ?>;
    var OctQty = <?php echo $monthly_qtys[9]; ?>;
    var NovQty = <?php echo $monthly_qtys[10]; ?>;
    var DecQty = <?php echo $monthly_qtys[11]; ?>;

    var ctx = document.getElementById('myChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar', // Type of chart
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], // Labels for the X-axis
            datasets: [{
                    label: 'Amount', // Label for the first dataset
                    data: [janPrice, FebPrice, MarPrice, AprPrice, MayPrice, JunPrice, JulPrice, AugPrice, SepPrice, OctPrice, NovPrice, DecPrice], // Data for the first dataset
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Background color for the first dataset bars
                    borderColor: 'rgba(255, 99, 132, 1)', // Border color for the first dataset bars
                    borderWidth: 1 // Border width for the first dataset bars
                },
                {
                    label: 'Quentity', // Label for the second dataset
                    data: [janQty, FebQty, MarQty, AprQty, MayQty, JunQty, JulQty, AugQty, SepQty, OctQty, NovQty, DecQty], // Data for the second dataset
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Background color for the second dataset bars
                    borderColor: 'rgba(54, 162, 235, 1)', // Border color for the second dataset bars
                    borderWidth: 1 // Border width for the second dataset bars
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Ensure the Y-axis starts at zero
                }
            }
        }
    });
</script>

</html>