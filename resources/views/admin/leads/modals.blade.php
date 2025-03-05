<div class="modal fade" id="leadModal"  data-lead-id="" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeader"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="leadDetails" class="mb-3">
                    <!-- Lead details will be populated here dynamically -->
                </div>
                <form id="leadForm">
                    <div class="mb-3">
                        <label for="statusDropdown" class="form-label">Status</label>
                        <select class="form-select" id="statusDropdown" name="status">
                            <!-- Options will be appended dynamically -->
                        </select>
                    </div>
                </form>
                <h5>Conversation Logs:</h5>
                <div id="conversationLogsContainer">
                    <!-- Conversation logs will be populated here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary bg_126C9B " id="saveLeadStatus">Save Changes</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addLogModal" tabindex="-1" aria-labelledby="addLogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLogModalLabel">Add Log to Lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea id="logText" class="form-control" rows="4" placeholder="Add any lead notes here"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="saveLogButton" class="btn btn-primary bg_126C9B ">Save</button>
            </div>
        </div>
    </div>
</div>