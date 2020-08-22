<div class="modal fade" id="member-details{{ $member->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $member->full_name }}'s Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-2 pl-3 pr-3">
                <div class="row">
                    <span>
                        Other Names
                    </span>
                </div>
                <div class="row font-weight-bold text-muted">
                    {{ $member->other_names ?? 'N/A' }}
                </div>

                <div class="row mt-2">
                    <span>
                        Alternative Number
                    </span>
                </div>
                <div class="row mb-2 font-weight-bold text-muted">
                    {{ $member->alt_phone ?? 'N/A' }}
                </div>

                <div class="row" mt-2>
                    <span>
                        Gender
                    </span>
                </div>
                <div class="row font-weight-bold text-muted mb-2">
                    {{ $member->gender ?? 'N/A' }}
                </div>

                <div class="row" mt-2>
                    <span>
                        Address
                    </span>
                </div>
                <div class="row font-weight-bold text-muted mb-2">
                    {{ $member->residential_address ?? 'N/A' }}
                </div>

                <div class="row" mt-2>
                    <span>
                        Digital Address
                    </span>
                </div>
                <div class="row font-weight-bold text-muted mb-2">
                    {{ $member->digital_address ?? 'N/A' }}
                </div>

                <div class="row" mt-2>
                    <span>
                        School
                    </span>
                </div>
                <div class="row font-weight-bold text-muted mb-2">
                    {{ $member->school?? 'N/A' }}
                </div>

                <div class="row" mt-2>
                    <span>
                        Place of Work
                    </span>
                </div>
                <div class="row font-weight-bold text-muted mb-2">
                    {{ $member->work ?? 'N/A' }}
                </div>

                <div class="row" mt-2>
                    <span>
                        Fellowship
                    </span>
                </div>
                <div class="row font-weight-bold text-muted mb-2">
                    {{ $member->fellowship_name ?? 'N/A' }}
                </div>

                <div class="row" mt-2>
                    <span>
                        Department
                    </span>
                </div>
                <div class="row font-weight-bold text-muted mb-2">
                    {{ $member->department->name ?? 'N/A' }}
                </div>

            </div>
        </div>
    </div>
</div>
