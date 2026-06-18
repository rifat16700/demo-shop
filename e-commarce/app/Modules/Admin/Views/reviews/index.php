

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><?= esc($title) ?></h4>
            </div>
            <div class="card-body">
                
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Reviewer Name</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item) : ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= esc($item['name']) ?> <br><small>User ID: <?= $item['user_id'] ?></small></td>
                                    <td>
                                        <span style="color: #fbbf24; font-size: 16px;">
                                            <?= str_repeat('★', $item['rating']) . str_repeat('☆', 5 - $item['rating']) ?>
                                        </span>
                                    </td>
                                    <td style="max-width: 300px; white-space: normal;"><?= esc($item['comment']) ?></td>
                                    <td><?= date('d M Y', strtotime($item['created_at'])) ?></td>
                                    <td>
                                        <?php if ($item['status'] == 1) : ?>
                                            <span class="badge badge-success">Approved</span>
                                        <?php else : ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($item['status'] == 0) : ?>
                                            <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='<?= admin_url('reviews?id=' . $item['id'] . '&status=1') ?>'"><i class="fas fa-check"></i></button>
                                        <?php else : ?>
                                            <button type="button" class="btn btn-sm btn-warning" onclick="window.location.href='<?= admin_url('reviews?id=' . $item['id'] . '&status=0') ?>'"><i class="fas fa-times"></i></button>
                                        <?php endif; ?>
                                        
                                        <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure?')) window.location.href='<?= admin_url('reviews?delete=' . $item['id']) ?>'"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($items)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">No reviews found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
