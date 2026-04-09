<?php
require_once __DIR__ . "/../../db.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $response = ['success' => false, 'message' => ''];
    $action = $_POST['action'];

    try {
        if ($action === 'add') {
            $sql = "INSERT INTO item (created_by_employee, device_id, status_id, article, property_num, serial_num, quantity, date_acquired) 
                    VALUES (:created_by, :device_id, :status_id, :article, :property_num, :serial_num, :quantity, :date_acquired)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':created_by' => $_SESSION['employee_id'] ?? 1, // Fallback to 1 if not logged in for testing
                ':device_id' => $_POST['device_id'],
                ':status_id' => $_POST['status_id'],
                ':article' => $_POST['article'],
                ':property_num' => $_POST['property_num'],
                ':serial_num' => $_POST['serial_num'],
                ':quantity' => $_POST['quantity'],
                ':date_acquired' => $_POST['date_acquired'] ?: null
            ]);
            $response = ['success' => true, 'message' => 'Item added successfully'];
        } elseif ($action === 'edit') {
            $item_id = $_POST['item_id'];
            
            // Fetch current status to verify edit permission
            $checkSql = "SELECT status_id FROM item WHERE item_id = :id";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute([':id' => $item_id]);
            $item = $checkStmt->fetch();

            if ($item && in_array($item['status_id'], [1, 3, 4])) {
                $sql = "UPDATE item SET 
                            device_id = :device_id, 
                            status_id = :status_id, 
                            article = :article, 
                            property_num = :property_num, 
                            serial_num = :serial_num, 
                            quantity = :quantity, 
                            date_acquired = :date_acquired 
                        WHERE item_id = :item_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':device_id' => $_POST['device_id'],
                    ':status_id' => $_POST['status_id'],
                    ':article' => $_POST['article'],
                    ':property_num' => $_POST['property_num'],
                    ':serial_num' => $_POST['serial_num'],
                    ':quantity' => $_POST['quantity'],
                    ':date_acquired' => $_POST['date_acquired'] ?: null,
                    ':item_id' => $item_id
                ]);
                $response = ['success' => true, 'message' => 'Item updated successfully'];
            } else {
                $response = ['success' => false, 'message' => 'Edit not allowed for this item status.'];
            }
        } elseif ($action === 'delete') {
            $item_id = $_POST['item_id'];
            
            // Verify delete permission (status_id must be 4)
            $checkSql = "SELECT status_id FROM item WHERE item_id = :id";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute([':id' => $item_id]);
            $item = $checkStmt->fetch();

            if ($item && $item['status_id'] == 4) {
                $sql = "DELETE FROM item WHERE item_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':id' => $item_id]);
                $response = ['success' => true, 'message' => 'Item deleted successfully'];
            } else {
                $response = ['success' => false, 'message' => 'Deletion only allowed if status is "For Disposal".'];
            }
        }
    } catch (PDOException $e) {
        $response = ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

try {
    // Fetch all items
    $sql = "SELECT 
                i.*,
                d.device_name
            FROM item i
            JOIN device d ON i.device_id = d.device_id
            ORDER BY d.device_name ASC, i.article ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $allItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch Devices for dropdowns
    $deviceStmt = $pdo->query("SELECT device_id, device_name FROM device ORDER BY device_name ASC");
    $devices = $deviceStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch Item Statuses for dropdowns
    $statusStmt = $pdo->query("SELECT status_id, status_name FROM item_status ORDER BY status_id ASC");
    $itemStat = $statusStmt->fetchAll(PDO::FETCH_ASSOC);
    $itemStatuses = [];
    # error_log(print_r($itemStat,true));
    foreach($itemStat as $i =>$itemStatus){
        $itemStatuses[$itemStatus['status_id']] = $itemStatus['status_name'];
    }
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
    $devices = [];
    $itemStatuses = [];
}