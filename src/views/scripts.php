<div class="modal" id="jrconfirmAcceptModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-body text-center p-4">
                <i class="bi bi-exclamation-circle text-warning mb-3" style="font-size: 3rem;"></i>
                <h4 class="fw-bold">Confirm Acceptance</h4>
                <p class="text-muted">Are you sure you want to accept this job request? You can only handle one task at a time.</p>
                
                <div class="d-flex justify-content-center gap-2 mt-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="jrConfirmBtn" class="btn btn-success px-4">Yes, Accept it</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="jrFinishModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Job Completion Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="jrRemarks" class="form-label">Remarks</label>
                <textarea class="form-control" id="jrRemarks" rows="4" placeholder="Describe what was done..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="submitFinishBtn" class="btn btn-success">Submit & Finish</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="irconfirmAcceptModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-body text-center p-4">
                <i class="bi bi-exclamation-circle text-warning mb-3" style="font-size: 3rem;"></i>
                <h4 class="fw-bold">Confirm Acceptance</h4>
                <p class="text-muted">Are you sure you want to accept this invetory request? You can only handle one task at a time.</p>
                
                <div class="d-flex justify-content-center gap-2 mt-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="irConfirmBtn" class="btn btn-success px-4">Yes, Accept it</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-start" id="modalBodyText">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="finalSubmitBtn" class="btn btn-primary">Yes, Submit</button>
                </div>
            </div>
        </div>
    </div>



<script>
// Variables to store the selected IDs
let selectedJobId = null;
let selectedInvId = null;


// Initialize Modals
const jrModal = new bootstrap.Modal(document.getElementById('jrconfirmAcceptModal'));
const jrFinishModal = new bootstrap.Modal(document.getElementById('jrFinishModal'));

const irModal = new bootstrap.Modal(document.getElementById('irconfirmAcceptModal'));


// --- JOB REQUEST LOGIC ---
function acceptJob(ticketId) {
    selectedJobId = ticketId;
    jrModal.show();
}

document.getElementById('jrConfirmBtn').addEventListener('click', function() {
    if (!selectedJobId) return;
    processAcceptance(this, 'data/accept_job_request.php', selectedJobId, jrModal);
});

if(document.getElementById('jrFinishRequest')) {
    document.getElementById('jrFinishRequest').addEventListener('click', function() {
        jrFinishModal.show();
    });
}

// --- INVENTORY REQUEST LOGIC ---
function acceptInventory(ticketId) {
    selectedInvId = ticketId;
    irModal.show();
}

document.getElementById('submitFinishBtn').addEventListener('click', function() {
    const remarks = document.getElementById('jrRemarks').value.trim();
    const btn = this;

    // DEBUG: Check values in console (F12)
    console.log("Attempting to finish job...");
    console.log("Ticket ID:", currentActiveJobTicketId);
    console.log("Remarks:", remarks);

    if (!currentActiveJobTicketId) {
        alert("Error: No active ticket ID found. Please refresh the page.");
        return;
    }

    if (!remarks) {
        alert("Please enter remarks.");
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Saving...';

    fetch('data/finish_job_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `ticket_id=${encodeURIComponent(currentActiveJobTicketId)}&remarks=${encodeURIComponent(remarks)}`
    })
    .then(response => {
        // If PHP crashes, this helps you see the "messy" error
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
            btn.disabled = false;
            btn.innerText = "Submit & Finish";
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        alert("Connection error. Check console for details.");
        btn.disabled = false;
        btn.innerText = "Submit & Finish";
    });
});

document.getElementById('irConfirmBtn').addEventListener('click', function() {
    if (!selectedInvId) return;
    processAcceptance(this, '../src/handlers/accept_inv_request.php', selectedInvId, irModal);
});


function processAcceptance(btn, handlerPath, id, modalObj) {
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Processing...';

    fetch(handlerPath, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'ticket_id=' + id
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            alert("Error: " + data.message);
            btn.disabled = false;
            btn.innerText = 'Yes, Accept it';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        modalObj.hide();
        alert("A connection error occurred.");
    });
}


</script>




<script>
    function submitFeedback() {
    const form = document.getElementById('feedbackForm');
    const formData = new FormData(form);

    if (!formData.get('rating')) {
        alert('Please select a star rating.'); 
        return;
    }

    fetch('data/servreq_process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message); // Standard alert
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting feedback.');
    });
}
</script>

<script>
    <?php
            $noDisplay = true;
    include(dirname(__DIR__,2) . "/public/data/service_req_data.php");
    ?>
    if (typeof articleMap === 'undefined') {
        var articleMap = <?= json_encode($articleMap,true) ?>;
    } else {
        articleMap = <?= json_encode($articleMap,true) ?>;
    }
    let activeFormId = '';
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));

    function updateArticles() {
        const deviceSelect = document.getElementById('deviceSelect');
        const articleSelect = document.getElementById('articleSelect');
        const selectedId = deviceSelect.value;

        articleSelect.innerHTML = '';
        
        if (selectedId && articleMap[selectedId]) {
            articleSelect.disabled = false;
            articleSelect.add(new Option("Select an article...", "", true, true));

            // Get the data (it might be an object or an array)
            const articles = articleMap[selectedId];

            // Convert to array if it's an object, then iterate
            Object.values(articles).forEach(article => {
                articleSelect.add(new Option(article, article));
            });
        } else {
            articleSelect.disabled = true;
            articleSelect.add(new Option("No articles available", ""));
        }
    }

    function confirmSubmission(requestType) {
        activeFormId = (requestType === 'job') ? 'jobRequestForm' : 'inventoryRequestForm';
        const form = document.getElementById(activeFormId);
        
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const modalBody = document.getElementById('modalBodyText');
        const submitBtn = document.getElementById('finalSubmitBtn');

        modalBody.innerText = "Confirm submitting this " + requestType + " request?";
        submitBtn.className = (requestType === 'job') ? "btn btn-primary" : "btn btn-success";
        
        confirmModal.show();
    }

    document.getElementById('finalSubmitBtn').addEventListener('click', function() {
        const form = document.getElementById(activeFormId);
        const formData = new FormData(form);
        const submitBtn = this;

        submitBtn.disabled = true;
        const originalText = submitBtn.innerText;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';

        fetch('data/servreq_process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            confirmModal.hide();
            showAlert(data.status === 'success' ? 'success' : 'danger', data.message);
    
            if (data.status === 'success') {
                form.reset();
            }
        })
        .catch(error => {
            confirmModal.hide();
            // This logs the technical error to the console for you to debug
            console.error('Fetch Error:', error);
            showAlert('danger', 'System Error: Could not connect to the processing script.');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerText = 'Yes, Submit';
        });
    });

    function showAlert(type, message) {
        const alertBox = document.getElementById('responseAlert');
        alertBox.className = "alert alert-" + type + " alert-dismissible fade show mb-4";
        alertBox.innerHTML = message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        alertBox.classList.remove('d-none');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>