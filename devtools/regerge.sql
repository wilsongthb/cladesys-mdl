SELECT
	p.*	
FROM products AS p;
SELECT
	p.id AS p_id,
	p.name AS p_name,
	i.id AS i_id,
	i.locations_id AS i_locations_id,
	i.outputs_id AS i_outputs_id,
	id.id AS id_id,
	id.quantity AS id_quantity,
	od.id AS od_id,
	od.input_details_id AS od_input_details_id,
	od.quantity AS od_quantity
FROM products AS p
LEFT JOIN input_details AS id ON id.products_id = p.id
LEFT JOIN inputs AS i ON i.id = id.inputs_id
LEFT JOIN output_details AS od ON od.input_details_id = id.id
-- GROUP BY od.id;
