<?php
require_once __DIR__ . "/../../db.php"; 

try {
    // We join 'item' with 'device' to get the category names
    // 'status_id' here refers to the item condition (New, Used, Broken, etc.)
    $sql = "SELECT 
                i.item_id,
                i.article,
                i.property_num,
                i.serial_num,
                i.quantity,
                i.date_acquired,
                i.status_id,
                d.device_name
            FROM item i
            JOIN device d ON i.device_id = d.device_id
            ORDER BY d.device_name ASC, i.article ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $allItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Grouping items by Device Type
    $inventoryData = [];
    foreach ($allItems as $row) {
        $category = $row['device_name'];
        if (!isset($inventoryData[$category])) {
            $inventoryData[$category] = [];
        }
        $inventoryData[$category][] = $row;
    }

} catch (PDOException $e) {
    error_log("Inventory Management Fetch Error: " . $e->getMessage());
    $inventoryData = [];
}