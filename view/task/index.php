<?php include_once __DIR__."./../layouts/header.php"; ?>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card">
					<div class="card-header d-flex ">
						Task List
						<a href="<?= App::route('task-create') ?>" class="btn btn-outline-primary ml-4">Create</a>
					</div>
					<div class="card-body row">
						<table class="table table-striped tast-list">
							<thead>
								<tr>
									<th data-sort="id" data-action="0">Id <i class="fa fa-fw fa-sort"></i></th>
									<th data-sort="name" data-action="0">Firstname <i class="fa fa-fw fa-sort"></i></th>
									<th data-sort="email" data-action="0">Email <i class="fa fa-fw fa-sort"></i></th>
									<th data-sort="description" data-action="0">Description <i class="fa fa-fw fa-sort"></i></th>
									<th data-sort="status" data-action="0">Status <i class="fa fa-fw fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($data['tasks'] as $task): ?>
								<tr>
									<td><?= $task['id']; ?></td>
									<td><?= $task['name']; ?></td>
									<td><?= $task['email']; ?></td>
									<td><?= $task['description']; ?></td>
									<td>
										<?php if($task['status'] == 0): ?>
										<span class="badge badge-success">To Do</span>
										<?php else: ?>
											<span class="badge badge-danger">Done</span>
										<?php endif ?>
									</td>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
						<ul class="pagination">

							<li class="page-item previous<?= ($data['page_count'] == 1)? 'disabled' : '' ?>"><a class="page-link" href="#">Previous</a></li>

							<?php for($i=1; $i <= $data['page_count']; $i++): ?>
								<?php if ($i == 1):?>
								  <li class="page-item active" data-id="<?= $i ?>">
								<?php elseif ($data['page_count'] == $i): ?>
							  		<li class="page-item last_page" data-id="<?= $i ?>">
								<?php endif ?>			
							  	<a class="page-link" href="#"><?= $i ?></a>
							  </li>

							<?php endfor ?>

							<li class="page-item next <?= ($data['page_count'] == 1)? 'disabled' : '' ?>"><a class="page-link" href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="auth" value="<?= $auth->type ?>">
	<script src="./public/js/task.js"></script>

<?php include_once __DIR__.'./../layouts/footer.php'; ?>
