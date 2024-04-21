<section class="edit-dealermodal-wrapper">
    <div class="modal-wrapper light-modal-wrapper">
        <div class="modal fade" id="addModal" role="dialog"
             aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    @include('layout.common.modal-spinner')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add User
                        </h5>
                        <button type="button" class="close modal-close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="add-user-form" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input id="real-password" type="password" autocomplete="new-password" style="display: none;">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Full name <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="full_name_err"
                                                   style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder="Full name" name="full_name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            User Name <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="username_err"
                                                   style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder="User Name" name="username" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Password <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="password_err"
                                                   style="display: none;"></small>
                                            <input type="password" class="form-control"
                                                   placeholder="Password" name="password" autocomplete="off">
                                            <div class="pw-show-hide pw-show-hide-js">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Confirm Password <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="confirm_password_err"
                                                   style="display: none;"></small>
                                            <input type="password" class="form-control"
                                                   placeholder="Confirm Password" name="confirm_password"
                                                   autocomplete="off">
                                            <div class="pw-show-hide pw-show-hide-js">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Designation <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="designation_err"
                                                   style="display: none;"></small>
                                            <select name="designation" class="form-control">
                                                <option value="">Select Designation</option>
                                                @forelse($designations as $designation)
                                                    <option
                                                        value="{{$designation->id}}">{{$designation->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Email <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="email_err" style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder="Email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Phone <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="phone_err" style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder="Phone" name="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Address</label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <input type="text" class="form-control"
                                                   placeholder="Address" name="address">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 form-input-area">
                                    <div class="row form-group">
                                        <label class="col-sm-4 col-form-label">
                                            Role <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="role_err" style="display: none;"></small>
                                            <select class="form-control" name="role">
                                                <option value="">Select Role</option>
                                                @forelse($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->display_name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-input-area" style="display: none;">
                                    <div class="row form-group">
                                        <div class="col-sm-2 col-form-label">
                                        </div>
                                        <div class="col-sm-10 p-0 mt-2">
                                            <hr class="mt-0"/>
                                            <input type="search" placeholder="Search permissions"
                                                   class="form-control mb-2">
                                            <small class="error-message" id="permissions_err"
                                                   style="display: none;"></small>
                                            <h6>Assigned Permissions</h6>

                                            <div class="row" id="role-perm"></div>
                                            <a class="btn form-button mb-2 mt-3" data-toggle="collapse"
                                               href="#collapseExample" role="button" aria-expanded="false"
                                               aria-controls="collapseExample">Assign More Permissions</a>
                                            <div class="collapse mt-2" id="collapseExample">
                                                <h6>Select Permissions</h6>
                                                <div class="row" id="more-perm"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-input-area">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label">
                                                Status </label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <label class="switch">
                                                    <input type="checkbox" id="event-fee-switch" name="active_status"
                                                           value="1">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn form-button" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn form-button btn-danger reset-user">
                            Reset Form
                        </button>
                        <button type="button" class="btn form-button btn-success add-user">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
