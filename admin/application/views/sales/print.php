<html>
<head>
    <meta charset="ISO-8859-1">
    <style>

        html, body {
            width: 23cm; /* was 907px */
            height: 13.5cm; /* was 529px */
            display: block;
            font-family: "Consolas";
            margin:0;
            /*font-size: auto; NOT A VALID PROPERTY */
        }
        table{
            width:%;
            display:inline;
            font-size:13px;
        }
        .box-body{
            padding:10px;
            font-size:13px;
        }
        @media print {
            html, body {
                width: 23cm; /* was 8.5in */
                height: 13.5cm; /* was 5.5in */
                display: block;
                font-family: "Consolas";
                padding:0 10px;
                margin:0;
                /*font-size: auto; NOT A VALID PROPERTY */
            }
            table{
                width:100%;
                display:inline;
                font-size:13px;
            }
            .box-body{
                padding:10px;
                font-size:13px;
            }

            @page {
                size: 24cm 14cm /* . Random dot? */;
            }
        }
    </style>
</head>
<body>
    <div class="box-body">
        <table style="display:inline;">
            <thead>
                <tr>
                    <td style="width:350px;">Customer</td>
                     <td style="width:350px;">User: <?php echo $details[0]->user;?></td>
                    <td style="width:200px;">Transaction Code</td>
                    <td style="width:200px;">: <?php echo $details[0]->id;?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $details[0]->customer_name;?></td>
                    <td>Date of Purchase</td>
                    <td>: <?php echo date("d-m-Y H:i:s",strtotime($details[0]->date));?></td>
                </tr>
                <tr>
                    <td><?php echo $details[0]->customer_address;?> </td>
                    <td valign="top">Payment</td>
                    <td valign="top">: <?php echo $details[0]->is_cash == 1 ? "Cash" : "Credit";?></td>
                </tr>
                <tr>
                    <td>Phone: <?php echo $details[0]->customer_phone;?></td>
                    <td valign="top">Due date</td>
                    <td valign="top">: <?php echo $details[0]->is_cash == 1 ? "-" : $details[0]->pay_deadline_date;?></td>
                </tr>
            </tbody>
        </table>
        <br />
        <?php $line = "==================================================================================================================";?>
        <?php echo $line;?>
        <table>
            <thead>
            <tr>
                <td style="width:160px;">Name</td>
                <td style="width:100px;">Category</td>
                <td style="width:100px;">Quantity</td>
                <td style="width:200px;">Price/item</td>
                <td style="width:100px;text-align: right;">Subtotal</td>
            </tr>
            </thead>
        </table>
        <?php echo $line;?>
        <table>
            <thead  style="height:270px;">
            <?php if(isset($details) && is_array($details)){ ?>
                <?php foreach($details as $key => $transaction){?>
                    <tr valign="top" style="height:10px;font-size:14px;">
                        <td style="width:160px;"><?php echo $transaction->product_name;?></td>
                        <td style="width:100px; text-align: left;"><?php echo $transaction->category_name;?></td>
                        <td style="width:100px; text-align: left;"><?php echo $transaction->quantity;?></td>
                        <td style="width:200px; text-align: left;">₱<?php echo number_format($transaction->price_item);?></td>
                        <td style="width:100px; text-align: right;">₱<?php echo number_format($transaction->subtotal);?></td>
                    </tr>
                <?php } ?>
                <?php $total = 10 - ($key + 1);
                for($a =1; $a <= $total; $a++){ ?>
                    <tr style="height:10px;font-size:14px;">
                        <td style="width:160px;">&nbsp;</td>
                        <td style="width:100px;"></td>
                        <td style="width:100px;"></td>
                        <td style="width:200px;"></td>
                        <td style="width:100px;"></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </thead>
        </table>
        <?php echo $line;?>
        <table>
            <thead>
            <tr>
                <td style="width:160px;"></td>
                <td style="width:100px;"></td>
                <td style="width:100px;"></td>
                <td style="width:200px;">Total</td>
                <td style="width:100px;text-align: right;">₱<?php echo number_format($transaction->total_price);?></td>
            </tr>
            </thead>
        </table>
        <?php echo $line;?>
        <br />
        <table>
            <thead>
            <tr>
           
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td style="width:150px;text-align: center;">&nbsp;</td>
                <td style="width:342px;text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="width:342px;text-align: center;">&nbsp; </td>
            </tr>
            <tr>
              
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>