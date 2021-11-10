<?php

/**
 * @var common\models\Order $order
 */
$orderAddress = $order->orderAddress;
?>

<script
        src="https://www.paypal.com/sdk/js?client-id=AZBjBBlEBymUdALPi0p6GFURgbmuoycbBE64LAqWErlPfaXCJdL1AaEhm9ySdH-6ePSD0oKWuyCrzpXP">
</script>
<h3>Order summary: #<?php echo $order->id ?></h3>
<hr>
<div class="row">
    <div class="col">
        <h4>Account Information</h4>
        <table class="table table-sm">
            <tr>
                <th>Firstname</th>
                <td><?php echo $order->firstname ?></td>
            </tr>
            <tr>
                <th>Lastname</th>
                <td><?php echo $order->lastname ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $order->email ?></td>
            </tr>
        </table>

        <h4>Address information</h4>
        <table class="table table-sm">
            <tr>
                <th>Address</th>
                <td><?php echo $orderAddress->address ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo $orderAddress->city ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?php echo $orderAddress->state ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo $orderAddress->country ?></td>
            </tr>
            <tr>
                <th>Zipcode</th>
                <td><?php echo $orderAddress->zipcode ?></td>
            </tr>
        </table>
    </div>
    <div class="col">
        <h4>Products</h4>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($order->orderItems as $item): ?>
                <tr>
                    <td>
                        <img src="<?php echo $item->product->getImageUrl() ?>" alt="" style="width:50px">
                    </td>
                    <td><?php echo $item->product_name ?></td>
                    <td><?php echo $item->quantity ?></td>
                    <td><?php echo Yii::$app->formatter->asCurrency($item->quantity * $item->unit_price) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <table class="table">
            <tr>
                <th>Total Items</th>
                <td><?php echo $order->getItemsQuantity() ?></td>
            </tr>
            <tr>
                <th>Total Price</th>
                <td><?php echo Yii::$app->formatter->asCurrency($order->total_price) ?></td>
            </tr>
        </table>

        <div id="paypal-button-container"></div>

    </div>
</div>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?php echo $order->total_price ?>
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                const $form = $('#checkout-form');
                const data = $form.serializeArray();
                data.push({
                    name: 'transactionId',
                    value: details.id
                });
                data.push({
                    name: 'status',
                    value: details.status
                });
                $.ajax({
                    method: 'post',
                    url: '<?php echo \yii\helpers\Url::to(['/cart/submit-payment', 'orderId' => $order->id]) ?>',
                    data: data,
                    success: function (res) {
                        // This function shows a transaction success message to your buyer.
                        alert('Thanks for your business');
                        window.location.href = '';
                    }
                });
            });
        }
    }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
</script>
