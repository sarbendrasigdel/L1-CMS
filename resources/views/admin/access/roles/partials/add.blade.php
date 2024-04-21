<section class="edit-dealermodal-wrapper">
    <div class="modal-wrapper light-modal-wrapper">
        <div class="modal fade" id="addModal" role="dialog"
             aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    @include('layout.common.modal-spinner')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add Role
                        </h5>
                        <button type="button" class="close modal-close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-body-sc">
                        <form id="add-role-form">
                            @csrf
                            <div class="row row-search-ht">
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Role Name <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="role_name_err"
                                                   style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder="Role Name" name="role_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-input-area">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Display Name <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-8 pl-lg-0">
                                            <small class="error-message" id="display_name_err"
                                                   style="display: none;"></small>
                                            <input type="text" class="form-control"
                                                   placeholder="Display Name" name="display_name">
                                        </div>
                                    </div>
                                </div>
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
                            <hr class="mt-0"/>
                            <div class="div-top">
                                <input type="search" placeholder="Search permissions" class="form-control mb-2">
                            </div>
                            <div class="position-relative">
                                <h6>Select Permission</h6>
                                <small class="error-message" id="permissions_err"></small>
                            </div>
                            <div class="row">
                                @forelse($permissions as $object => $controller)
                                    <div class="col-md-3 mt-2 perm-block">
                                        <strong><label class="check-in-label"><input type="checkbox" class="row-check"
                                                                                     data-perm="{{str_replace(' ', '', $object)}}"><span
                                                    class="checkmark"></span></label>{{ ucfirst($object) }} Permissions</strong>
                                        <hr class="mt-2 mb-2"/>
                                        @forelse($controller as $permission)
                                            <div class="{{str_replace(' ', '', $object)}}">
                                                    <span class="chk-wrap mr-2">
                                                        <label class="check-in-label">
                                                            <input type="checkbox" value="{{ $permission->id }}"
                                                                   name="permissions[]">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </span> <span
                                                    style="display: inline-block; vertical-align: sub;">{{ $permission->display_name }}</span>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn form-button" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn form-button btn-danger reset-role">
                            Reset Form
                        </button>
                        <button type="button" class="btn form-button btn-success add-role">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
