<div class="order">
    <div class="order-query"><?= $order->query ?></div>
    <div class="order-info"><?= get_type($order->type) . " • " . get_date($order->request_date) ?></div>
</div>