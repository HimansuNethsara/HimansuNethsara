<!DOCTYPE html>
<html lang="eng">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Trendy_tech | Invoice</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/logo.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="css/flex-slider.min.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/invoice-style.css">
    <link rel="stylesheet" href="css/responsive.css">

	
	
</head>

<body>
  <div id="invoiceholder">
  <div id="invoice" class="effect2">
    
    <div id="invoice-top">
      <div class="logo"><img src="images/logo/logo.png" alt="Logo" /></div>
      <div class="title">
        <h1>Invoice #<span class="invoiceVal invoice_num">tst-inv-11-06</span></h1>
        <p>Invoice Date: <span id="invoice_date">11 Jun 2024</span><br>
        </p>
      </div><!--End Title-->
    </div><!--End InvoiceTop-->


    
    <div id="invoice-mid">   
      <div id="message">
        <h2>Hello Himansu Ranasinghe,</h2>
        <p>Thank you for your recent purchase from Trendy_tech. We are delighted to confirm that you have successfully bought [Product Name : Apple iphone 11] from our shop. 
            Your order is being processed, and we will notify you once it has been shipped. We appreciate your business and look forward to serving you again in the future.</p>
        <p>If you have any questions or need further assistance, please do not hesitate to contact our customer support team.</p>
        
    </div>
        <div class="clearfix">
            <div class="col-left">
                <div class="clientlogo"><img src="https://cdn3.iconfinder.com/data/icons/daily-sales/512/Sale-card-address-512.png" alt="Sup" /></div>
                <div class="clientinfo">
                    <h2 id="supplier">himansunethsara.</h2>
                    <p><span id="address">4B-26R, </span><br><span>National Housing Scheem,</span><br><span id="city">Raddolugama</span> - <span id="zip">11400</span><br><span id="tax_num">+94 683 3512</span><br></p>
                </div>
            </div>
            <div class="col-right">
                <table class="table">
                    <tbody>
                        <tr><td><span>Currency</span><label id="currency">Rs .</label></td> </tr>
                        <tr><td colspan="2"><span>Note</span>#<label id="note">Purchased Items can be returned before 7 days of Delivery</label></td></tr>
                        <tr><td colspan="2"><label>Invoice was create on a computer and is valid without the Signature and the Seal</label></td></tr>
                    </tbody>
                </table>
            </div>
        </div>       
    </div><!--End Invoice Mid-->
    
    <div id="invoice-bot">
      
      <div id="table">
        <table class="table-main">
          <thead>    
              <tr class="tabletitle">
                <th>No</th>
                <th>Title</th>
                <th>Category Type</th>
                <th>Brand Type</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
              </tr>
          </thead>
          <tr class="list-item">
            <td data-label="Type" class="tableitem">1</td>
            <td data-label="Description" class="tableitem">Asus</td>
            <td data-label="Category" class="tableitem">Laptop</td>
            <td data-label="Brand" class="tableitem">Asus</td>
            <td data-label="Quantity" class="tableitem">46</td>
            <td data-label="Unit Price" class="tableitem">Rs 100,000 .00</td>>
            <td data-label="Total" class="tableitem">Rs 4600,000 .00</td>
          </tr>
          <tr class="list-item total-row">
            <th colspan="7" class="tableitem">Sub Total</th>
            <td data-label="Grand Total" class="tableitem">Rs 4600,000 .00</td>
           </tr>
           <tr class="list-item total-row">
            <th colspan="7" class="tableitem">Delivery Fee</th>
            <td data-label="Grand Total" class="tableitem">1000</td>
           </tr>
            <tr class="list-item total-row">
                <th colspan="7" class="tableitem">Grand Total</th>
                <td data-label="Grand Total" class="tableitem">Rs 4646,000 .00</td>
            </tr>
        </table>
      </div><!--End Table-->
      <div class="cta-group">
        <a href="javascript:void(0);" class="btn-primary" ><i class="bi bi-printer-fill"></i> Print</a>
        <a href="javascript:void(0);" class="btn-default"><i class="bi bi-filetype-pdf"></i> Export as PDF</a>
    </div> 
      
    </div><!--End InvoiceBot-->
  </div><!--End Invoice-->
</div><!-- End Invoice Holder-->
  

<script src="js/script.js"></script>
</body>
</html>