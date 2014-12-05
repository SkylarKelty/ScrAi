$(function() {
	var cell = 0;

	$("td").on('click', function() {
		cell = $(this);
		$("#cellvalue").val($(this).html());
		$("#cellinput").fadeIn();
	});

	$(".btn-save").on('click', function() {
		var val = $('#cellvalue').val();

		var rackid = cell.attr('data-rackid');
		var row = cell.attr('data-row');
		var column = cell.attr('data-column');

		if (typeof rackid != 'undefined') {
			$.ajax({
				url: "ajax/setrack.php",
				type: "GET",
				data: {
					rackid: rackid,
					value: val
				}
			});
		} else {
			$.ajax({
				url: "ajax/setcell.php",
				type: "GET",
				data: {
					row: row,
					column: column,
					value: val
				}
			});
		}

		cell.html(val);

		$("#cellvalue").val("");
		$("#cellinput").fadeOut();
	});

	$("#suggest").on('click', function() {
		$.getJSON("ajax/suggest.php", function(data) {
			$.each(data, function(row) {
				$.each(data[row], function(column) {
					$("td[data-row=" + row + "][data-column=" + column + "]")
						.addClass("suggest")
							.html(data[row][column]);
				});
			});
		});
	});
})