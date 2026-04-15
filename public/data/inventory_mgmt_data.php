<?php
require_once __DIR__ . "/../../config/bootstrap.php";

// Handle POST actions (add/edit/delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');

    Security::requireAuth();
    Security::requireRole([1, 2]); // Admin + Technical
    Security::requireCsrf();

    $response = ['success' => false, 'message' => ''];
    $action = $_POST['action'];

    try {
        if ($action === 'add') {
            $sql = "INSERT INTO item (created_by_employee, device_id, status_id, article, property_num, serial_num, date_acquired)
                    VALUES (:created_by, :device_id, :status_id, :article, :property_num, :serial_num, :date_acquired)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':created_by' => $_SESSION['employee_id'],
                ':device_id' => (int)$_POST['device_id'],
                ':status_id' => (int)$_POST['status_id'],
                ':article' => trim($_POST['article'] ?? ''),
                ':property_num' => trim($_POST['property_num'] ?? ''),
                ':serial_num' => trim($_POST['serial_num'] ?? ''),
                ':date_acquired' => $_POST['date_acquired'] ?: null
            ]);
            $response = ['success' => true, 'message' => 'Item added successfully'];

        } elseif ($action === 'edit') {
            $item_id = (int)($_POST['item_id'] ?? 0);

            $checkStmt = $pdo->prepare("SELECT status_id FROM item WHERE item_id = :id");
            $checkStmt->execute([':id' => $item_id]);
            $item = $checkStmt->fetch();

            if ($item && in_array((int)$item['status_id'], [1, 3, 4], true)) {
                $sql = "UPDATE item SET
                            device_id = :device_id,
                            status_id = :status_id,
                            article = :article,
                            property_num = :property_num,
                            serial_num = :serial_num,
                            date_acquired = :date_acquired
                        WHERE item_id = :item_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':device_id' => (int)$_POST['device_id'],
                    ':status_id' => (int)$_POST['status_id'],
                    ':article' => trim($_POST['article'] ?? ''),
                    ':property_num' => trim($_POST['property_num'] ?? ''),
                    ':serial_num' => trim($_POST['serial_num'] ?? ''),
                    ':date_acquired' => $_POST['date_acquired'] ?: null,
                    ':item_id' => $item_id
                ]);
                $response = ['success' => true, 'message' => 'Item updated successfully'];
            } else {
                $response = ['success' => false, 'message' => 'Edit not allowed for this item status.'];
            }

        } elseif ($action === 'delete') {
            $item_id = (int)($_POST['item_id'] ?? 0);

            $checkStmt = $pdo->prepare("SELECT status_id FROM item WHERE item_id = :id");
            $checkStmt->execute([':id' => $item_id]);
            $item = $checkStmt->fetch();

            if ($item && (int)$item['status_id'] === 4) {
                $stmt = $pdo->prepare("DELETE FROM item WHERE item_id = :id");
                $stmt->execute([':id' => $item_id]);
                $response = ['success' => true, 'message' => 'Item deleted successfully'];
            } else {
                $response = ['success' => false, 'message' => 'Deletion only allowed if status is "For Disposal".'];
            }
        }
    } catch (PDOException $e) {
        error_log('Inventory Mgmt Error: ' . $e->getMessage());
        $response = ['success' => false, 'message' => 'A database error occurred.'];
    }

    echo json_encode($response);
    exit;
}

// GET: Fetch inventory data for the view
try {
    $sql = "SELECT
                i.*,
                d.device_name
            FROM item i
            JOIN device d ON i.device_id = d.device_id
            ORDER BY d.device_name ASC, i.article ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $allItems = $stmt->fetchAll();

    $deviceStmt = $pdo->query("SELECT device_id, device_name FROM device ORDER BY device_name ASC");
    $devices = $deviceStmt->fetchAll();

    $statusStmt = $pdo->query("SELECT status_id, status_name FROM item_status ORDER BY status_id ASC");
    $itemStat = $statusStmt->fetchAll();
    $itemStatuses = [];
    foreach ($itemStat as $itemStatus) {
        $itemStatuses[$itemStatus['status_id']] = $itemStatus['status_name'];
    }

    $inventoryData = [];
    foreach ($allItems as $row) {
        $category = $row['device_name'];
        $inventoryData[$category][] = $row;
    }

} catch (PDOException $e) {
    error_log("Inventory Management Fetch Error: " . $e->getMessage());
    $inventoryData = [];
    $devices = [];
    $itemStatuses = [];
}
