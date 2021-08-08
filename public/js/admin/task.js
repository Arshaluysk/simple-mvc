$(document).ready(function() {

	let data = {page: 1,sort: 'id', action: 0};

	$(document).on('click','.page-link', function(e){

		e.preventDefault();

		$(this).parents('.pagination').find('li').removeClass('active');
		$(this).parent().addClass('active');

		data.page = $('.pagination').find('.active').attr('data-id');

		$('.next').removeClass('disabled');
		$('.previous').removeClass('disabled');

		if(data.page == 1) {
			$('.previous').addClass('disabled');
		}	

		if($(this).parent().hasClass('last_page')) {
			$('.next').addClass('disabled');
		}

		getList(data)

	})

	$('.fa-sort').click(function() {

		data.sort = $(this).parent().attr('data-sort');
		data.action = $(this).parent().attr('data-action');

		if (data.action == 0) {
			$(this).parent().attr('data-action',1);
		} else {
			$(this).parent().attr('data-action',0);
		}

		getList(data)

	})

	$(document).on('change','.switch_status',function() {

		let id = $(this).attr('data-id');
		let _this = this;

		$.ajax({
			url: 'http://localhost/mvc/task-edit',
			type: 'POST',
			data: {id: id},
			dataType: "json",
			success: function (res) { 
				
				let bager = $(_this).parent().find('.badge');

				if(res.status == 0) {

					$(bager).removeClass('badge-danger');
					$(bager).addClass('badge-success');
					$(bager).text('to do');
				} else {
					$(bager).removeClass('badge-success');
					$(bager).addClass('badge-danger');
					$(bager).text('done');
				}

				let html = `<div class="alert alert-${res.type} alert-dismissible">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  		${res.message} 
							</div>`;
				$('.notes').prepend($(html));			
			}
		})
	})


function getList(data) {
	$.ajax({
		url: 'http://localhost/mvc/task-list',
		type: 'POST',
		data: data,
		dataType: "json",
		success: function (res) { 

			if(res.status) {

				let html = null;

				$.each(res.data, function( index, value ) {
					html += `<tr>
							<td>${value.id}</td>
							<td>${value.name}</td>
							<td>${value.email}</td>
							<td>${value.description}</td>
							<td>
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input switch_status" id="switch${(value.id)}" data-id="${(value.id)}">
									<label class="custom-control-label" for="switch${(value.id)}">
										<span class="badge ${(value.status == 0) ? 'badge-success' : 'badge-danger'}">${(value.status == 0) ? 'To Do' : 'Done'}</span>
								    </label>
								</div>
							</td>
						</tr>`
					});
				$('.tast-list tbody').empty();
				$('.tast-list tbody').append(html);
			}
		}
	})
}

})
