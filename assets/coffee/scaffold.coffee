class @Scaffold_Controller extends Controller
	'[data-confirm] click': (e)->
		
		href = $(this).attr('href')
		msg = $(this).attr('data-confirm')

		result = confirm msg

		e.preventDefault() if not result