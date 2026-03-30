<?php
try {
    $sql = $sql = "SELECT 
                e.employee_id, 
                e.first_name, 
                e.last_name, 
                f.remarks, 
                f.rating,
                jr.status_id,
                jr.updated_at
             FROM feedback f
             INNER JOIN employee e ON f.employee_id = e.employee_id
             INNER JOIN job_request jr ON f.employee_id = jr.requested_by_employee
             WHERE jr.status_id = 3
             ORDER BY jr.updated_at DESC";
    $stmt = $pdo->query($sql);
    $feedbacks = $stmt->fetchAll();
} catch (\PDOException $e) {
    die("Database error: " . $e->getMessage());
}

?>
<div class="card-header">
<h3 class="card-title">Feedback History</h3>
</div>
<div class="card-body">
<div class="direct-chat-messages">
    <?php if (count($feedbacks) > 0): ?>
        <?php foreach ($feedbacks as $row): ?>
            
            <!-- Message Start -->
            <div class="direct-chat-msg" style="margin-bottom: 20px;">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-start">
                        <?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?> 
                        <!-- <small class="text-muted">(ID: <?= htmlspecialchars($row['employee_id']) ?>)</small> -->
                    </span>
                    <span class="direct-chat-timestamp float-end">
                        <strong>Rating: <?= htmlspecialchars($row['rating']) ?></strong> | 
                            <?= date("d M g:i a", strtotime($row['updated_at'] ?? 'now')) ?>
                    </span>
                </div>
                
                <!-- Avatar (Placeholder logic) -->
                <img 
                    class="direct-chat-img" 
                    src="./assets/img/user1-128x128.jpg" 
                    alt="user image"
                />
                
                <!-- The actual feedback text -->
                <div class="direct-chat-text">
                    <?= htmlspecialchars($row['remarks']) ?>
                </div>
            </div>
            <!-- /.direct-chat-msg -->

        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-muted">No feedback submitted yet.</p>
    <?php endif; ?>
</div>
<!-- /.direct-chat-messages-->
<!-- /.direct-chat-pane -->
</div>
<!-- /.card-body -->