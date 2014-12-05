$(function() {
	var cell = 0;

	$("td").on('click', function() {
		cell = $(this);
		$("#cellvalue").val($(this).html());
		$("#cellinput").fadeIn();
	});

	$(".btn-save").on('click', function() {
		var val = $('#cellvalue').val();
		var row = cell.attr('data-row');
		var column = cell.attr('data-column');

		cell.html(val);

		$("#cellvalue").val("");
		$("#cellinput").fadeOut();

		$.ajax({
			url: "ajax/setcell.php",
			type: "GET",
			data: {
				row: row,
				column: column,
				value: val
			}
		});
	});
})