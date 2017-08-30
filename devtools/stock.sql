# STOCK TOTAL
SELECT
	p.*,
	SUM(IFNULL(id.quantity, 0)) AS total_inputs,
	SUM(IFNULL(od.quantity, 0)) AS total_outputs,
	SUM(IFNULL(id.quantity, 0)) - SUM(IFNULL(od.quantity, 0)) AS stock
FROM products AS p
LEFT JOIN input_details AS id ON id.products_id = p.id
LEFT JOIN inputs AS i ON i.id = id.inputs_id
LEFT JOIN output_details AS od ON od.input_details_id = id.id
-- WHERE i.locations_id = 1
GROUP BY p.id