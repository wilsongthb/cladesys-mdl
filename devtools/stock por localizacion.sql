SELECT
    p.id AS p_id,
    p.name AS p_name,
    c.value AS p_categorie,
    SUM(IFNULL(s.id_quantity, 0)) AS sum_id_quantity,
    SUM(IFNULL(s.sum_od_quantity, 0)) AS sum_od_quantity,
    SUM(IFNULL(s.id_quantity, 0)) - SUM(IFNULL(s.sum_od_quantity, 0)) AS stock
FROM products AS p
LEFT JOIN (
    SELECT
        i.id AS i_id,
        i.locations_id AS i_locations_id,
        i.`type` AS i_type,
        id.id AS id_id,
        id.products_id AS id_products_id,
    --	p.name AS p_name,
        id.quantity AS id_quantity,
    --	o.id AS o_id,
    --	o.locations_id AS o_locations_id,
    --	o.`type` AS o_type,
    --	od.id AS od_id,
    --	od.quantity AS od_quantity
        SUM(od.quantity) AS sum_od_quantity
    FROM inputs AS i
    JOIN input_details AS id ON id.inputs_id = i.id
    JOIN products AS p ON p.id = id.products_id
    LEFT JOIN output_details AS od ON od.input_details_id = id.id
    LEFT JOIN outputs AS o ON o.id = od.outputs_id
    WHERE i.locations_id = '${locations_id}'
    GROUP BY i.id ASC, id.id ASC
) AS s ON s.id_products_id = p.id
JOIN categories AS c ON p.categories_id = c.id
GROUP BY p.id
ORDER BY stock DESC