SELECT
	s.*,
	(s.sum_id_quantity - sum_od_quantity) AS stock
FROM (
	SELECT
		i.id AS i_id,
		i.locations_id AS i_locations_id,
		id.id AS id_id,
		id.products_id AS id_products_id,
		p.name AS p_name,
	--	id.quantity AS id_quantity,
		SUM(IFNULL(id.quantity, 0)) AS sum_id_quantity,
		o.id AS o_id,
		o.locations_id AS o_locations_id,
		od.id AS od_id,
		od.input_details_id AS od_inputs_details_id,
	--	od.quantity AS od_quantity,
		SUM(IFNULL(od.quantity, 0)) AS sum_od_quantity
	FROM inputs AS i
	LEFT JOIN input_details AS id ON id.inputs_id = i.id
	LEFT JOIN products AS p ON p.id = id.products_id
	LEFT JOIN output_details AS od ON od.input_details_id = id.id
	LEFT JOIN outputs AS o ON o.id = od.outputs_id
	
--	WHERE i.locations_id = 1
	
	GROUP BY id.products_id ASC
) AS s
-- GROUP BY i.id ASC, id.id ASC, o.id ASC, od.id ASC
-- GROUP BY i.id ASC, id.id ASC, o.id ASC, od.input_details_id ASC
-- GROUP BY i.locations_id ASC, i.id ASC, id.inputs_id ASC