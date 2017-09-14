SELECT
	p.id,
	p.name,
-- s.*,
	IFNULL(SUM(s.id_quantity), 0) AS total_id_quantity,
	IFNULL(SUM(s.sum_od_quantity), 0) AS total_od_quantity,
	(IFNULL(SUM(s.id_quantity), 0) - IFNULL(SUM(s.sum_od_quantity), 0)) AS stock
FROM products AS p
LEFT JOIN (
	SELECT
		i.id AS i_id,
		i.locations_id AS i_locations_id,
		i.created_at AS i_created_at,
		id.id AS id_id,
		id.products_id AS id_products_id,
		id.quantity AS id_quantity,
	--	p.name AS p_name,
		od.id AS od_id,
	--	od.input_details_id AS od_input_details_id,
	--	od.quantity AS od_quantity,
		SUM(IFNULL(od.quantity, 0)) AS sum_od_quantity,
		MAX(od.created_at) AS max_od_created_at,
		o.id AS o_id,
		o.locations_id AS o_locations_id
	FROM inputs AS i
	JOIN input_details AS id ON id.inputs_id = i.id
	JOIN products AS p ON p.id = id.products_id
	LEFT JOIN output_details AS od ON od.input_details_id = id.id
	LEFT JOIN outputs AS o ON o.id = od.outputs_id
	WHERE i.`type` <> 2
	AND o.`type` <> 2
	GROUP BY id.id ASC
) AS s ON p.id = s.id_products_id
GROUP BY p.id, s.id_products_id
ORDER BY name ASC