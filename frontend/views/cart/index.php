<?php
/** @var array $items */
?>

<div class="card">
    <div class="card-header">
        <h3>Your card items</h3>
    </div>
    <div class="card-body p-0">

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Unit price</th>
                <th>Quantity</th>
                <th>Total price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item):?>
                <tr>
                    <td><?php echo $item['name'] ?></td>
                    <td><img src="<?php echo \common\models\Product::formatImageUrl($item['image']) ?>"
                             style="width: 50px"
                             alt="<?php echo $item['name'] ?>"></td>
                    <td><?php echo $item['price'] ?></td>
                    <td><?php echo $item['quantity'] ?></td>
                    <td><?php echo $item['total_price'] ?></td>
                    <td><?php echo \yii\helpers\Html::a('Detele', ['/cart/delete', 'id' =>$item['id']],[
                            'class' => 'btn btn-outline-danger btn-sm',
                            'date-method' => 'post',
                            'data-confirm' => 'Are you sure want to remove this product from cart?'
                        ]) ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <div class="card-body text-right">
            <a href="<?php \yii\helpers\Url::to(['/cart/checkout']) ?>" class="btn btn-primary">Checkout</a>
        </div>
    </div>
</div>
