<div class="modal fade" id="roles-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $user->fullname }}'s Roles
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="user-roles-table table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ROLES</th>
                                <th>DATE ASSIGNED</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->roles as $role)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $role->name }}
                                    </td>
                                    <td>
                                        {{ $role->created_at->format('d-M-Y g:i A') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
