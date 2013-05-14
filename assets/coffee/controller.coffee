class @Controller
	constructor: (@elem)->
		@elem = $('body')	if not @elem?
		@_config_elem()

	_config_elem: ()->
		is_event = /^.* [a-z]{4,}$/
		controller = @

		for method of controller
			if is_event.test method
				tmp = method.split(' ')
				$(tmp[0]).bind(tmp[1], controller[method])

		controller