<?php
// templates/orders_table.php
$orders = [
    ['name' => 'Tesco Market', 'type' => 'Shopping', 'date' => '13 Dec 2020', 'total' => '$75.67'],
    ['name' => 'ElectroMen Market', 'type' => 'Shopping', 'date' => '14 Dec 2020', 'total' => '$250.00'],
    ['name' => 'Fiorgio Restaurant', 'type' => 'Food', 'date' => '07 Dec 2020', 'total' => '$19.50'],
    ['name' => 'John Mathew Kayne', 'type' => 'Sport', 'date' => '06 Dec 2020', 'total' => '$350'],
    ['name' => 'Ann Marlin', 'type' => 'Shopping', 'date' => '31 Nov 2020', 'total' => '$430'],
    ['name' => 'Ann Marlin', 'type' => 'Shopping', 'date' => '31 Nov 2020', 'total' => '$430'],
    ['name' => 'Ann Marlin', 'type' => 'Shopping', 'date' => '31 Nov 2020', 'total' => '$430']
];
?>
<div class="orders-section">
    <h2 class="section-title">Ordini eseguiti</h2>
    
    <div class="orders-table-container">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Pomerimo</th>
                    <th>Tipo</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr class="order-row">
                    <td class="order-name"><?php echo htmlspecialchars($order['name']); ?></td>
                    <td class="order-type"><?php echo htmlspecialchars($order['type']); ?></td>
                    <td class="order-date"><?php echo htmlspecialchars($order['date']); ?></td>
                    <td class="order-total"><?php echo htmlspecialchars($order['total']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>