<section class="edit-dealermodal-wrapper">
    <div class="modal-wrapper light-modal-wrapper">
        <div class="modal fade" id="viewModal" role="dialog"
             aria-labelledby="viewModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    @include('layout.common.modal-spinner')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            View User
                        </h5>
                        <button type="button" class="close modal-close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-user-form" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id">
                            <div class="container-fluid">
                                @can('edit.user')
                                    <div class="text-right">
                                        <div class="link-btn-wrapper">
                                            <a href="#" class="btn link-btn btn-edit">
                                                Edit
                                                <span class="fa fa-pencil-alt edit-bg"></span>
                                            </a>
                                        </div>
                                    </div>
                                @endcan
                                <hr class="mt-1"/>
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
                                                <small class="error-message" id="email_err"
                                                       style="display: none;"></small>
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
                                                <small class="error-message" id="phone_err"
                                                       style="display: none;"></small>
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

                                    <div class="col-lg-6 form-input-area collapse" id="change-pass">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                New Password <sup class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="new_password_err"
                                                       style="display: none;"></small>
                                                <input type="password" class="form-control"
                                                       placeholder="New Password" name="new_password" disabled>
                                                <div class="pw-show-hide pw-show-hide-js">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                Confirm Password <sup class="text-danger">*</sup></label>
                                            <div class="col-sm-8 pl-lg-0">
                                                <small class="error-message" id="confirm_password_err"
                                                       style="display: none;"></small>
                                                <input type="password" class="form-control"
                                                       placeholder="Confirm Password" name="confirm_password" disabled>
                                                <div class="pw-show-hide pw-show-hide-js">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-input-area">
                                    <div class="row">
                                        <div class="col-sm-2 col-form-label">
                                        </div>
                                        <div class="col-sm-10 p-0 mt-2">
                                            <hr class="mt-0"/>
                                            <div class="form-group">
                                                <input type="search" placeholder="Search permissions"
                                                       class="form-control mb-2">
                                                <small class="error-message" id="permissions_err"
                                                       style="display: none;"></small>
                                            </div>
                                            <h6>Assigned Permissions</h6>
                                            <div class="row" id="assigned-perm">
                                            </div>
                                            <a class="btn form-button mb-2 mt-3" data-toggle="collapse"
                                               href="#edit-role" role="button" aria-expanded="false"
                                               aria-controls="collapseExample" style="display:none;">Assign More
                                                Permissions</a>
                                            <a class="btn form-button mb-2 mt-3 change-password" data-toggle="collapse"
                                               href="#change-pass" role="button" aria-expanded="false"
                                               aria-controls="collapseExample" style="display:none;">Change Password</a>
                                            <div class="collapse mt-2" id="edit-role">
                                                <h6>Select Permissions</h6>
                                                <div class="row" id="more-perm">
                                                </div>
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
                                                    <input type="checkbox" id="event-fee-switch1" name="active_status"
                                                           value="1">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0"/>
                            <div class="form-input-area">
                                <div class="row user-data">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn form-button" data-dismiss="modal">
                            Close
                        </button>
                        {{--<button type="button" class="btn form-button btn-danger reset-edit-user-form">--}}
                        {{--Reset Form--}}
                        {{--</button>--}}
                        <button type="button" class="btn form-button btn-success update-user">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
