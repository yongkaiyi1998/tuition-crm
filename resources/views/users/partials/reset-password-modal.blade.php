<div class="modal fade" id="passwordModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="passwordForm">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Reset Password
                    </h5>
                </div>

                <div class="modal-body">
                    <div id="errorBox" class="alert alert-danger d-none"></div>
                    
                    <p>
                        Reset password for
                        <strong id="userName"></strong>
                    </p>

                    <div class="mb-3">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                        Cancel
                    </button>

                    <button class="btn btn-primary">
                        Reset Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>