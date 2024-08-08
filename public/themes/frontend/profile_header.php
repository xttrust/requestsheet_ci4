<!-- Profile Header -->
<div class="profile-header">
    <!-- Profile Header Image -->
    <div class="profile-header-image">
        <img class="img-fluid img-thumbnail shadow" src="<?= uploads_url('images/headers/admin-header.jpeg'); ?>" alt="alt"/>
    </div>

    <!-- Profile Avatar -->
    <div class="profile-avatar">
        <img class="img-fluid rounded-circle" src="<?= uploads_url('images/avatars/nobody.jpg'); ?>" alt="alt"/>
    </div>

    <!-- Profile Header Buttons -->
    <div class="profile-header-buttons mt-2">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <!-- Content aligned to the left -->

                <!-- Start Anouncements Modal Button -->
                <button type="button"
                        title="Anouncements"
                        class="btn btn-dark btn-sm btn-profile"
                        data-bs-toggle="modal"
                        data-bs-target="#anouncementsModal">
                    <span class="icon-bullhorn1"></span>
                </button>

                <!-- Anouncements Modal -->
                <div class="modal fade" id="anouncementsModal" tabindex="-1" aria-labelledby="anouncementsModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark">
                                <h2 class="modal-title" id="anouncementsModalLabel">Anouncements</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body bg-white text-dark">
                                <div class="modal-body bg-white text-dark">
                                    <?php foreach ($announcements as $ann): ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $ann['content']; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Anouncements Modal -->

                <!-- Start Tips Modal Button -->
                <button type="button"
                        title="Tips"
                        class="btn btn-dark btn-sm btn-profile"
                        data-bs-toggle="modal"
                        data-bs-target="#tipsModal">
                    <span class="icon-money"></span>
                </button>

                <!-- Tips Modal -->
                <div class="modal fade" id="tipsModal" tabindex="-1" aria-labelledby="tipsModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark">
                                <h2 class="modal-title" id="tipsModalLabel">Tips title here</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body bg-white text-black">
                                Tips list here
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tips Modal -->

                <!-- Start Socials Modal Button -->
                <button type="button"
                        title="Social Networks"
                        class="btn btn-dark btn-sm btn-profile"
                        data-bs-toggle="modal"
                        data-bs-target="#socialsModal">
                    <span class="icon-share-square-o"></span>
                </button>

                <!-- Socials Modal -->
                <div class="modal fade" id="socialsModal" tabindex="-1" aria-labelledby="socialsModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark">
                                <h2 class="modal-title" id="socialsModalLabel">Socials title here</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body bg-white text-black">
                                Socials list here
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Socials Modal -->
            </div>
            <div class="align-self-end">
                <!-- Content aligned to the right -->
                <button type="button"
                        title="Clear all requests"
                        class="btn btn-dark btn-sm btn-profile">
                    <span class="icon-remove"></span>
                </button>
                <button type="button"
                        title="Settings"
                        class="btn btn-dark btn-sm btn-profile">
                    <span class="icon-settings"></span>
                </button>
                <button type="button"
                        title="Disable requests"
                        class="btn btn-dark btn-sm btn-profile">
                    <span class="icon-lock1"></span>
                </button>
            </div>
        </div>

    </div>
    <!-- end Profile Header Buttons -->

</div>
<!-- end Profile Header -->