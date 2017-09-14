SELECT
	i.id AS i_id,
	i.locations_id AS i_locations_id,
	id.id AS id_id,
	id.products_id AS id_products_id,
	id.quantity AS id_quantity,
	o.id AS o_id,
	o.locations_id AS o_locations_id,
	od.id AS od_id,
	od.input_details_id AS od_inputs_details_id,
	od.quantity AS od_quantity	
FROM inputs AS i
LEFT JOIN input_details AS id ON id.inputs_id = i.id
LEFT JOIN output_details AS od ON od.input_details_id = id.id
LEFT JOIN outputs AS o ON o.id = od.outputs_id
-- GROUP BY i.id ASC, id.id ASC, o.id ASC, od.id ASC